<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prakteks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->ensure_session_started();
        $this->load->model('praktek');
        $this->load->model('member');
    }

    private function ensure_session_started() {
        if (session_status() === PHP_SESSION_NONE) {
            @session_start();
        }
    }

    private function get_session_data($key) {
        $this->ensure_session_started();
        if (!empty($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        if (isset($this->session) && is_object($this->session)) {
            $val = $this->session->userdata($key);
            if (!empty($val)) {
                return $val;
            }
        }
        return null;
    }

    private function is_logged_in() {
        return !empty($this->get_session_data('juleha_id'));
    }

    private function is_admin() {
        $level = $this->get_session_data('memberlevel');
        return ($level !== null && (int)$level < 2);
    }

    /**
     * Dashboard Riwayat & Rekapitulasi Seluruh Praktik (Admin)
     */
    public function index() {
        if (!$this->is_logged_in()) {
            redirect('/members/login');
            return;
        }

        // Jika anggota biasa, arahkan ke riwayat praktiknya sendiri
        if (!$this->is_admin()) {
            redirect('/prakteks/my_history');
            return;
        }

        $filters = array(
            'role'        => $this->input->get('role'),
            'animal_type' => $this->input->get('animal_type'),
            'rph_id'      => $this->input->get('rph_id'),
            'year'        => $this->input->get('year'),
            'month'       => $this->input->get('month'),
            'search'      => $this->input->get('search')
        );

        $data = array(
            'title'       => 'Rekapitulasi Presensi & Praktik - Juleha Jawa Timur',
            'stats'       => $this->praktek->get_statistics(),
            'records'     => $this->praktek->get_all_records($filters),
            'rphs'        => $this->praktek->get_rphs(),
            'filters'     => $filters,
            'active'      => array('list' => '', 'profile' => '', 'praktek' => 'active', 'praktek_index' => 'active')
        );

        $this->load->view('prakteks/index', $data);
    }

    /**
     * Halaman Scan QR KTA & Input Presensi Praktik
     */
    public function scan() {
        if (!$this->is_logged_in()) {
            redirect('/members/login');
            return;
        }

        $prefill_id = $this->uri->segment(3) ?: $this->input->get('id');

        $data = array(
            'title'       => 'Scan Presensi Praktik KTA - Juleha Jawa Timur',
            'rphs'        => $this->praktek->get_rphs(),
            'prefill_id'  => $prefill_id,
            'is_admin'    => $this->is_admin(),
            'active'      => array('list' => '', 'profile' => '', 'praktek' => 'active', 'praktek_scan' => 'active')
        );

        $this->load->view('prakteks/scan', $data);
    }

    /**
     * Halaman Rekapitulasi per Anggota (Leaderboard / Counter Sesi Praktik & Instruktur)
     */
    public function rekap_anggota() {
        if (!$this->is_logged_in()) {
            redirect('/members/login');
            return;
        }

        if (!$this->is_admin()) {
            redirect('/prakteks/my_history');
            return;
        }

        $data = array(
            'title'       => 'Rekap Praktik per Anggota - Juleha Jawa Timur',
            'stats'       => $this->praktek->get_statistics(),
            'members'     => $this->praktek->get_member_rekap(),
            'active'      => array('list' => '', 'profile' => '', 'praktek' => 'active', 'praktek_rekap' => 'active')
        );

        $this->load->view('prakteks/rekap_anggota', $data);
    }

    /**
     * Riwayat Praktik Saya (Khusus Anggota Biasa & Admin)
     */
    public function my_history() {
        if (!$this->is_logged_in()) {
            redirect('/members/login');
            return;
        }

        $target_juleha_id = $this->uri->segment(3);
        if (empty($target_juleha_id) || !$this->is_admin()) {
            $target_juleha_id = $this->get_session_data('juleha_id');
        }

        $member_info = $this->member->get($target_juleha_id);
        $practice_info = $this->praktek->get_by_member($target_juleha_id);

        $data = array(
            'title'         => 'Riwayat Praktik Penyembelihan - ' . $target_juleha_id,
            'juleha_id'     => $target_juleha_id,
            'member'        => $member_info['res'] ?? null,
            'practice_info' => $practice_info,
            'is_self'       => ($target_juleha_id === $this->get_session_data('juleha_id')),
            'active'        => array('list' => '', 'profile' => '', 'praktek' => 'active', 'praktek_my' => 'active')
        );

        $this->load->view('prakteks/my_history', $data);
    }

    /**
     * AJAX: Ambil data ringkas anggota berdasarkan Juleha ID (untuk preview saat QR KTA di-scan)
     */
    public function get_member_ajax($juleha_id = null) {
        if (!$this->is_logged_in()) {
            echo json_encode(array('status' => false, 'message' => 'Silakan login terlebih dahulu.'));
            return;
        }

        if (empty($juleha_id)) {
            $juleha_id = $this->input->get('juleha_id') ?: $this->input->post('juleha_id');
        }

        $clean_id = strtoupper(trim($juleha_id));
        // Bersihkan jika QR Code berisi URL lengkap, e.g. https://members.julehajatim.com/members/show/SBY220006
        if (preg_match('/([A-Z]{3}[0-9]{6})/i', $clean_id, $matches)) {
            $clean_id = strtoupper($matches[1]);
        }

        $res = $this->member->get($clean_id);
        if (!empty($res['res'])) {
            $m = $res['res'];
            $full_name = trim($m->firstname . ' ' . $m->lastname);
            if (empty($full_name)) {
                $full_name = $m->nickname;
            }

            // Ambil juga ringkasan total praktik anggota ini
            $prac_summary = $this->praktek->get_by_member($clean_id);

            echo json_encode(array(
                'status'           => true,
                'juleha_id'        => $clean_id,
                'name'             => $full_name,
                'nickname'         => $m->nickname,
                'region'           => $m->region,
                'position'         => $m->position ?? 'Anggota',
                'mstatus'          => $m->mstatus,
                'photo_url'        => '/images/' . $clean_id . '.jpg',
                'total_praktikan'  => $prac_summary['count_praktikan'],
                'total_instruktur' => $prac_summary['count_instruktur']
            ));
        } else {
            echo json_encode(array(
                'status'  => false,
                'message' => 'Anggota dengan ID ' . htmlspecialchars($clean_id) . ' tidak ditemukan di database.'
            ));
        }
    }

    /**
     * AJAX: Pencarian anggota (untuk auto-complete dropdown instruktur atau praktikan)
     */
    public function search_members_ajax() {
        if (!$this->is_logged_in()) {
            echo json_encode(array());
            return;
        }

        $q = trim($this->input->get('q') ?: $this->input->post('q'));
        $this->db->select("juleha_id, nickname, firstname, lastname, region, position");
        $this->db->from('members');
        if (!empty($q)) {
            $this->db->group_start();
            $this->db->like('juleha_id', $q);
            $this->db->or_like('nickname', $q);
            $this->db->or_like('firstname', $q);
            $this->db->or_like('lastname', $q);
            $this->db->group_end();
        }
        $this->db->limit(30);
        $members = $this->db->get()->result();

        $results = array();
        foreach ($members as $m) {
            $full_name = trim($m->firstname . ' ' . $m->lastname);
            if (empty($full_name)) {
                $full_name = $m->nickname;
            }
            $results[] = array(
                'id'       => $m->juleha_id,
                'text'     => $m->juleha_id . ' - ' . $full_name . ' (' . ($m->region ?? 'Jatim') . ')',
                'nickname' => $m->nickname,
                'fullname' => $full_name,
                'region'   => $m->region
            );
        }

        echo json_encode($results);
    }

    /**
     * AJAX: Simpan presensi / absensi praktik
     */
    public function save_attendance_ajax() {
        if (!$this->is_logged_in()) {
            echo json_encode(array('status' => false, 'message' => 'Sesi login telah habis. Silakan refresh dan login ulang.'));
            return;
        }

        $juleha_id = strtoupper(trim($this->input->post('juleha_id')));
        // Bersihkan format jika user paste atau scan URL lengkap
        if (preg_match('/([A-Z]{3}[0-9]{6})/i', $juleha_id, $matches)) {
            $juleha_id = strtoupper($matches[1]);
        }

        if (empty($juleha_id)) {
            echo json_encode(array('status' => false, 'message' => 'ID Juleha anggota wajib diisi atau di-scan.'));
            return;
        }

        // Validasi keberadaan anggota
        $m_check = $this->member->get($juleha_id);
        if (empty($m_check['res'])) {
            echo json_encode(array('status' => false, 'message' => 'ID Juleha ' . $juleha_id . ' tidak terdaftar dalam database.'));
            return;
        }

        $role = strtolower(trim($this->input->post('role') ?: 'praktikan'));
        $instructor_id = strtoupper(trim($this->input->post('instructor_id')));
        if (preg_match('/([A-Z]{3}[0-9]{6})/i', $instructor_id, $matches)) {
            $instructor_id = strtoupper($matches[1]);
        }

        $rph_id = $this->input->post('rph_id');
        $location_name = trim($this->input->post('location_name'));
        $animal_type = trim($this->input->post('animal_type') ?: 'Sapi');
        
        $praktekdate = trim($this->input->post('praktekdate'));
        if (empty($praktekdate)) {
            $praktekdate = date('Y-m-d H:i:s');
        } elseif (strlen($praktekdate) === 16) { // Format: YYYY-MM-DDTHH:MM
            $praktekdate = str_replace('T', ' ', $praktekdate) . ':00';
        }

        $description = trim($this->input->post('description'));
        $logged_user = $this->get_session_data('juleha_id') ?: 'system';

        $data = array(
            'id'            => $this->input->post('id'),
            'juleha_id'     => $juleha_id,
            'role'          => $role,
            'instructor_id' => !empty($instructor_id) ? $instructor_id : NULL,
            'rph_id'        => !empty($rph_id) ? (int)$rph_id : NULL,
            'location_name' => !empty($location_name) ? $location_name : NULL,
            'animal_type'   => $animal_type,
            'praktekdate'   => $praktekdate,
            'description'   => !empty($description) ? $description : NULL,
            'created_by'    => $logged_user
        );

        $result = $this->praktek->save_attendance($data);
        if ($result['status']) {
            $member_name = trim($m_check['res']->firstname . ' ' . $m_check['res']->lastname);
            if (empty($member_name)) {
                $member_name = $m_check['res']->nickname;
            }

            $role_label = ($role === 'instruktur') ? 'Instruktur' : 'Praktikan';

            echo json_encode(array(
                'status'  => true,
                'message' => 'Alhamdulillah! Presensi praktik untuk ' . $member_name . ' (' . $juleha_id . ') sebagai ' . $role_label . ' berhasil disimpan!',
                'id'      => $result['id'],
                'action'  => $result['action']
            ));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Gagal menyimpan presensi ke database. Silakan coba lagi.'));
        }
    }

    /**
     * AJAX: Hapus record praktik (Khusus Admin)
     */
    public function delete_ajax() {
        if (!$this->is_logged_in() || !$this->is_admin()) {
            echo json_encode(array('status' => false, 'message' => 'Akses ditolak. Hanya Admin yang berhak menghapus data presensi praktik.'));
            return;
        }

        $id = (int)$this->input->post('id');
        if ($id <= 0) {
            echo json_encode(array('status' => false, 'message' => 'ID data tidak valid.'));
            return;
        }

        $res = $this->praktek->delete_by_id($id);
        if ($res) {
            echo json_encode(array('status' => true, 'message' => 'Data riwayat praktik berhasil dihapus.'));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Gagal menghapus data dari database.'));
        }
    }

    /* =========================================================================
     * BACKWARD-COMPATIBLE LEGACY METHODS (UNTUK APK / INTEGRASI LAMA)
     * ========================================================================= */
    public function save() {
        $params = array(
            'rph_id'      => $this->uri->segment(3),
            'juleha_id'   => $this->uri->segment(4),
            'praktekdate' => $this->uri->segment(5)
        );
        echo json_encode(array('res' => $this->praktek->save($params)));
    }

    public function gets() {
        $rph_id = $this->uri->segment(3);
        $praktekdate = $this->uri->segment(4);
        echo json_encode($this->praktek->gets(array('rph_id' => $rph_id, 'praktekdate' => $praktekdate)));
    }

    public function delete() {
        $rph_id = $this->uri->segment(3);
        $juleha_id = $this->uri->segment(4);
        $praktekdate = $this->uri->segment(5);
        echo json_encode($this->praktek->delete(array('rph_id' => $rph_id, 'juleha_id' => $juleha_id, 'praktekdate' => $praktekdate)));
    }
}
