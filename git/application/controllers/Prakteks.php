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

    private function is_instructor($juleha_id = null) {
        if (empty($juleha_id)) {
            $juleha_id = $this->get_session_data('juleha_id');
        }
        return $this->is_admin() || $this->praktek->is_instructor($juleha_id);
    }

    /**
     * Dashboard Riwayat & Rekapitulasi Seluruh Praktik (Admin / Instruktur)
     */
    public function index() {
        if (!$this->is_logged_in()) {
            redirect('/members/login');
            return;
        }

        // Jika anggota biasa yang bukan admin dan bukan instruktur, arahkan ke riwayat praktiknya sendiri
        if (!$this->is_admin() && !$this->is_instructor()) {
            redirect('/prakteks/my_history');
            return;
        }

        $period = $this->input->get('period');
        $date = $this->input->get('date');
        $month = $this->input->get('month');
        $year = $this->input->get('year');

        if ($period === 'today') {
            $date = date('Y-m-d');
        } elseif ($period === 'this_month') {
            $month = date('n');
            $year = date('Y');
        } elseif ($period === 'this_year') {
            $year = date('Y');
        }

        $filters = array(
            'period'            => $period,
            'date'              => $date,
            'role'              => $this->input->get('role'),
            'animal_type'       => $this->input->get('animal_type'),
            'rph_id'            => $this->input->get('rph_id'),
            'evaluation_status' => $this->input->get('evaluation_status'),
            'year'              => $year,
            'month'             => $month,
            'juleha_id'         => $this->input->get('juleha_id'),
            'search'            => $this->input->get('search')
        );

        $data = array(
            'title'             => 'Rekapitulasi Presensi & Praktik - Juleha Jawa Timur',
            'stats'             => $this->praktek->get_statistics(),
            'records'           => $this->praktek->get_all_records($filters),
            'rphs'              => $this->praktek->get_rphs(),
            'practiced_members' => $this->praktek->get_distinct_practiced_members(),
            'filters'           => $filters,
            'is_admin'          => $this->is_admin(),
            'is_instructor'     => $this->is_instructor(),
            'logged_id'         => $this->get_session_data('juleha_id'),
            'active'            => array('list' => '', 'profile' => '', 'praktek' => 'active', 'praktek_index' => 'active')
        );

        $this->load->view('prakteks/index', $data);
    }

    /**
     * Halaman Scan QR KTA & Input Presensi Praktik
     * Bisa diakses langsung saat scan QR KTA fisik tanpa harus login.
     * Otomatis mendeteksi jika yang membuka adalah Instruktur Resmi untuk membuka antrean evaluasi realtime.
     */
    public function scan() {
        $this->ensure_session_started();
        $is_logged = $this->is_logged_in();
        $logged_id = $is_logged ? $this->get_session_data('juleha_id') : null;
        $logged_name = '';

        if (!empty($logged_id)) {
            $logged_member = $this->member->get($logged_id);
            if (!empty($logged_member['res'])) {
                $m = $logged_member['res'];
                $logged_name = trim(($m->firstname ?? '') . ' ' . ($m->lastname ?? ''));
                if (empty($logged_name)) {
                    $logged_name = $m->nickname ?? $logged_id;
                }
            }
        }

        $prefill_id = $this->uri->segment(3) ?: $this->input->get('id');
        $clean_prefill = '';
        if (!empty($prefill_id) && preg_match('/([A-Z]{3}[0-9]{6})/i', $prefill_id, $matches)) {
            $clean_prefill = strtoupper($matches[1]);
        }

        $is_admin = $is_logged ? $this->is_admin() : false;
        $is_logged_instructor = !empty($logged_id) ? $this->is_instructor($logged_id) : false;
        $is_prefill_instructor = !empty($clean_prefill) ? $this->is_instructor($clean_prefill) : false;

        $is_instructor = ($is_logged_instructor || $is_prefill_instructor);
        $can_evaluate = ($is_admin || $is_instructor);

        // Instruktur aktif yang sedang membuka/bertugas di halaman ini
        $active_instructor_id = $is_logged_instructor ? $logged_id : ($is_prefill_instructor ? $clean_prefill : null);
        $active_instructor_name = '';
        if (!empty($active_instructor_id)) {
            $inst_mem = $this->member->get($active_instructor_id);
            if (!empty($inst_mem['res'])) {
                $im = $inst_mem['res'];
                $active_instructor_name = trim(($im->firstname ?? '') . ' ' . ($im->lastname ?? ''));
                if (empty($active_instructor_name)) {
                    $active_instructor_name = $im->nickname ?? $active_instructor_id;
                }
            }
        }

        // Ambil daftar instruktur resmi aktif untuk tombol cepat pilihan peserta
        $official_instructors = $this->praktek->get_instructors();

        $data = array(
            'title'                  => 'Scan Presensi Praktik KTA - Juleha Jawa Timur',
            'rphs'                   => $this->praktek->get_rphs(),
            'prefill_id'             => $clean_prefill,
            'is_logged_in'           => $is_logged,
            'is_admin'               => $is_admin,
            'is_instructor'          => $is_instructor,
            'is_prefill_instructor'  => $is_prefill_instructor,
            'active_instructor_id'   => $active_instructor_id,
            'active_instructor_name' => $active_instructor_name,
            'official_instructors'   => $official_instructors,
            'logged_id'              => $logged_id,
            'logged_name'            => $logged_name,
            'can_evaluate'           => $can_evaluate,
            'active'                 => array('list' => '', 'profile' => '', 'praktek' => 'active', 'praktek_scan' => 'active')
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

        if (!$this->is_admin() && !$this->is_instructor()) {
            redirect('/prakteks/my_history');
            return;
        }

        $data = array(
            'title'         => 'Rekap Praktik per Anggota - Juleha Jawa Timur',
            'stats'         => $this->praktek->get_statistics(),
            'members'       => $this->praktek->get_member_rekap(),
            'is_admin'      => $this->is_admin(),
            'is_instructor' => $this->is_instructor(),
            'active'        => array('list' => '', 'profile' => '', 'praktek' => 'active', 'praktek_rekap' => 'active')
        );

        $this->load->view('prakteks/rekap_anggota', $data);
    }

    /**
     * Halaman Kelola Daftar Instruktur (Khusus Admin / Developer)
     */
    public function instruktur() {
        if (!$this->is_logged_in() || !$this->is_admin()) {
            redirect('/prakteks/index');
            return;
        }

        $data = array(
            'title'         => 'Kelola Daftar Instruktur Resmi - Juleha Jawa Timur',
            'instructors'   => $this->praktek->get_instructors(),
            'is_admin'      => $this->is_admin(),
            'is_instructor' => $this->is_instructor(),
            'active'        => array('list' => '', 'profile' => '', 'praktek' => 'active', 'praktek_instruktur' => 'active')
        );

        $this->load->view('prakteks/instruktur', $data);
    }

    /**
     * AJAX: Tambah Instruktur Resmi
     */
    public function add_instructor_ajax() {
        if (!$this->is_logged_in() || !$this->is_admin()) {
            echo json_encode(array('status' => false, 'message' => 'Hanya Admin yang berwenang mengelola daftar instruktur.'));
            return;
        }

        $juleha_id = strtoupper(trim($this->input->post('juleha_id')));
        if (preg_match('/([A-Z]{3}[0-9]{6})/i', $juleha_id, $matches)) {
            $juleha_id = strtoupper($matches[1]);
        }

        if (empty($juleha_id)) {
            echo json_encode(array('status' => false, 'message' => 'ID Juleha wajib diisi.'));
            return;
        }

        $m = $this->member->get($juleha_id);
        if (empty($m['res'])) {
            echo json_encode(array('status' => false, 'message' => 'Anggota dengan ID ' . $juleha_id . ' tidak ditemukan di database.'));
            return;
        }

        $notes = trim($this->input->post('notes') ?: 'Instruktur Resmi Juleha Jatim');
        $logged_id = $this->get_session_data('juleha_id');

        $res = $this->praktek->add_instructor($juleha_id, $notes, $logged_id);
        if ($res) {
            $name = trim($m['res']->firstname . ' ' . $m['res']->lastname) ?: $m['res']->nickname;
            echo json_encode(array(
                'status'  => true,
                'message' => 'Alhamdulillah, ' . $name . ' (' . $juleha_id . ') berhasil ditetapkan sebagai Instruktur Resmi Juleha Jatim!'
            ));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Gagal menambahkan instruktur.'));
        }
    }

    /**
     * AJAX: Hapus Instruktur Resmi
     */
    public function delete_instructor_ajax() {
        if (!$this->is_logged_in() || !$this->is_admin()) {
            echo json_encode(array('status' => false, 'message' => 'Hanya Admin yang berwenang mengelola daftar instruktur.'));
            return;
        }

        $juleha_id = strtoupper(trim($this->input->post('juleha_id')));
        if (empty($juleha_id)) {
            echo json_encode(array('status' => false, 'message' => 'ID Instruktur tidak valid.'));
            return;
        }

        $res = $this->praktek->delete_instructor($juleha_id);
        if ($res) {
            echo json_encode(array('status' => true, 'message' => 'Instruktur (' . $juleha_id . ') berhasil dihapus dari daftar instruktur aktif.'));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Gagal menghapus instruktur.'));
        }
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
            'is_admin'      => $this->is_admin(),
            'active'        => array('list' => '', 'profile' => '', 'praktek' => 'active', 'praktek_my' => 'active')
        );

        $this->load->view('prakteks/my_history', $data);
    }

    /**
     * AJAX: Ambil data ringkas anggota berdasarkan Juleha ID (untuk preview saat QR KTA di-scan)
     * Dapat diakses baik saat login maupun saat scan mandiri via QR KTA
     */
    public function get_member_ajax($juleha_id = null) {
        header('Content-Type: application/json; charset=utf-8');
        $this->ensure_session_started();

        if (empty($juleha_id)) {
            $juleha_id = $this->input->get('juleha_id') ?: $this->input->post('juleha_id');
        }

        $clean_id = strtoupper(trim($juleha_id ?? ''));
        if (preg_match('/([A-Z]{3}[0-9]{6})/i', $clean_id, $matches)) {
            $clean_id = strtoupper($matches[1]);
        }

        if (empty($clean_id)) {
            echo json_encode(array(
                'status'  => false,
                'message' => 'ID Juleha tidak boleh kosong.'
            ));
            return;
        }

        $res = $this->member->get($clean_id);
        if (!empty($res['res'])) {
            $m = $res['res'];
            $full_name = trim(($m->firstname ?? '') . ' ' . ($m->lastname ?? ''));
            if (empty($full_name)) {
                $full_name = $m->nickname ?? $clean_id;
            }

            // Hitung sesi praktik secara efisien dan aman
            $count_praktikan = $this->db->where('juleha_id', $clean_id)
                ->where('(role = "praktikan" OR role IS NULL OR role = "")')
                ->from('prakteks')
                ->count_all_results();

            $count_instruktur = $this->db->group_start()
                ->where('instructor_id', $clean_id)
                ->or_where('(juleha_id = "' . $clean_id . '" AND role = "instruktur")')
                ->group_end()
                ->from('prakteks')
                ->count_all_results();

            $is_inst = $this->praktek->is_instructor($clean_id);

            // Cek status admin secara aman tanpa PHP notice
            $is_adm = false;
            $mb = $this->db->select('memberlevel')->where('juleha_id', $clean_id)->get('members')->row();
            if (!empty($mb) && $mb->memberlevel !== null && (int)$mb->memberlevel < 2) {
                $is_adm = true;
            }

            echo json_encode(array(
                'status'           => true,
                'juleha_id'        => $clean_id,
                'name'             => $full_name,
                'nickname'         => $m->nickname ?? '',
                'firstname'        => $m->firstname ?? '',
                'lastname'         => $m->lastname ?? '',
                'region'           => $m->region ?? 'Jatim',
                'position'         => $m->position ?? 'Anggota',
                'mstatus'          => $m->mstatus ?? 'aktif',
                'photo_url'        => '/images/' . $clean_id . '.jpg',
                'total_praktikan'  => (int)$count_praktikan,
                'total_instruktur' => (int)$count_instruktur,
                'is_instructor'    => $is_inst,
                'is_admin'         => $is_adm
            ));
        } else {
            echo json_encode(array(
                'status'  => false,
                'message' => 'Anggota dengan ID ' . htmlspecialchars($clean_id) . ' tidak ditemukan di database.'
            ));
        }
    }

    /**
     * AJAX: Pencarian anggota berdasarkan nama (panggilan, depan, belakang, full) atau ID
     * Case-insensitive, multi-kata, dan responsif untuk live autocomplete
     */
    public function search_members_ajax() {
        header('Content-Type: application/json; charset=utf-8');
        $this->ensure_session_started();

        $q = trim($this->input->get('q') ?: $this->input->post('q'));
        $this->db->select("juleha_id, nickname, firstname, lastname, region, position");
        $this->db->from('members');

        if (!empty($q)) {
            // Support multi-kata (contoh: "Moch Maftuchin" atau "Zaidan Athallah")
            $words = preg_split('/\s+/', $q);
            foreach ($words as $w) {
                $w = trim($w);
                if ($w === '') continue;
                $clean_w = $this->db->escape_like_str(strtolower($w));
                $this->db->where("(
                    LOWER(juleha_id) LIKE '%{$clean_w}%' OR
                    LOWER(nickname) LIKE '%{$clean_w}%' OR
                    LOWER(firstname) LIKE '%{$clean_w}%' OR
                    LOWER(lastname) LIKE '%{$clean_w}%' OR
                    LOWER(CONCAT_WS(' ', firstname, lastname)) LIKE '%{$clean_w}%' OR
                    LOWER(CONCAT_WS(' ', nickname, firstname, lastname)) LIKE '%{$clean_w}%'
                )", NULL, FALSE);
            }
        }

        $this->db->order_by('firstname', 'ASC');
        $this->db->order_by('nickname', 'ASC');
        $this->db->limit(25);
        $members = $this->db->get()->result();

        $results = array();
        foreach ($members as $m) {
            $full_name = trim(($m->firstname ?? '') . ' ' . ($m->lastname ?? ''));
            if (empty($full_name)) {
                $full_name = $m->nickname ?? $m->juleha_id;
            }
            $results[] = array(
                'id'        => $m->juleha_id,
                'text'      => $m->juleha_id . ' - ' . $full_name . ' (' . ($m->region ?? 'Jatim') . ')',
                'nickname'  => $m->nickname ?? '',
                'firstname' => $m->firstname ?? '',
                'lastname'  => $m->lastname ?? '',
                'fullname'  => $full_name,
                'region'    => $m->region ?? 'Jatim',
                'position'  => $m->position ?? 'Anggota',
                'photo_url' => '/images/' . $m->juleha_id . '.jpg'
            );
        }

        echo json_encode($results);
    }

    /**
     * AJAX: Ambil daftar instruktur resmi atau pencarian instruktur berdasarkan nama/ID
     * Digunakan oleh peserta untuk memilih instruktur pembimbing di RPH
     */
    public function get_instructors_ajax() {
        header('Content-Type: application/json; charset=utf-8');
        $this->ensure_session_started();

        $q = trim($this->input->get('q') ?: $this->input->post('q') ?: '');
        $instructors = $this->praktek->get_instructors();

        $results = array();
        foreach ($instructors as $inst) {
            if (($inst->instructor_status ?? 'active') !== 'active') {
                continue;
            }
            $full_name = trim(($inst->firstname ?? '') . ' ' . ($inst->lastname ?? ''));
            if (empty($full_name)) {
                $full_name = $inst->nickname ?? $inst->juleha_id;
            }

            // Filter jika ada query pencarian nama / ID
            if (!empty($q)) {
                $haystack = strtolower($inst->juleha_id . ' ' . $full_name . ' ' . ($inst->nickname ?? '') . ' ' . ($inst->region ?? ''));
                $needle = strtolower($q);
                if (strpos($haystack, $needle) === false) {
                    continue;
                }
            }

            $results[] = array(
                'id'             => $inst->juleha_id,
                'fullname'       => $full_name,
                'nickname'       => $inst->nickname ?? '',
                'firstname'      => $inst->firstname ?? '',
                'lastname'       => $inst->lastname ?? '',
                'region'         => $inst->region ?? 'Jatim',
                'position'       => $inst->position ?? 'Instruktur',
                'notes'          => $inst->instructor_notes ?? 'Instruktur Resmi Juleha Jatim',
                'photo_url'      => '/images/' . $inst->juleha_id . '.jpg',
                'total_evaluasi' => (int)($inst->total_evaluasi ?? 0),
                'total_tugas'    => (int)($inst->total_tugas ?? 0)
            );
        }

        echo json_encode($results);
    }

    /**
     * AJAX: Ambil antrean peserta praktik real-time yang menunggu evaluasi instruktur
     */
    public function get_pending_evaluations_ajax() {
        header('Content-Type: application/json; charset=utf-8');
        $this->ensure_session_started();

        $instructor_id = strtoupper(trim($this->input->get('instructor_id') ?: $this->input->post('instructor_id') ?: ''));
        if (preg_match('/([A-Z]{3}[0-9]{6})/i', $instructor_id, $matches)) {
            $instructor_id = strtoupper($matches[1]);
        }

        $this->db->select("
            p.id as praktek_id,
            p.juleha_id,
            p.praktekdate,
            p.rph_id,
            COALESCE(NULLIF(p.location_name, ''), r.name, 'RPH TOW') as location_name,
            p.animal_type,
            p.evaluation_status,
            p.description,
            p.created_by,
            m.firstname,
            m.lastname,
            m.nickname,
            m.region,
            m.position
        ");
        $this->db->from('prakteks p');
        $this->db->join('members m', 'm.juleha_id = p.juleha_id', 'inner');
        $this->db->join('rphs r', 'r.id = p.rph_id', 'left');

        if (!empty($instructor_id)) {
            $this->db->where('p.instructor_id', $instructor_id);
        }
        $this->db->where_in('p.evaluation_status', array('Menunggu Evaluasi', 'Dalam Pembimbingan'));
        $this->db->where('(p.role = "praktikan" OR p.role IS NULL OR p.role = "")');
        $this->db->order_by('p.praktekdate', 'DESC');
        $this->db->order_by('p.id', 'DESC');
        $this->db->limit(30);

        $query = $this->db->get();
        $rows = $query->result();

        $results = array();
        foreach ($rows as $row) {
            $full_name = trim(($row->firstname ?? '') . ' ' . ($row->lastname ?? ''));
            if (empty($full_name)) {
                $full_name = $row->nickname ?? $row->juleha_id;
            }

            $results[] = array(
                'praktek_id'        => (int)$row->praktek_id,
                'juleha_id'         => $row->juleha_id,
                'fullname'          => $full_name,
                'nickname'          => $row->nickname ?? '',
                'region'            => $row->region ?? 'Jatim',
                'animal_type'       => $row->animal_type ?? 'Sapi',
                'location_name'     => $row->location_name,
                'rph_id'            => (int)$row->rph_id,
                'praktekdate'       => $row->praktekdate,
                'formatted_time'    => date('d/m/Y H:i', strtotime($row->praktekdate)),
                'evaluation_status' => $row->evaluation_status ?? 'Menunggu Evaluasi',
                'description'       => $row->description ?? '',
                'photo_url'         => '/images/' . $row->juleha_id . '.jpg'
            );
        }

        echo json_encode(array(
            'status' => true,
            'count'  => count($results),
            'data'   => $results
        ));
    }

    /**
     * AJAX: Simpan presensi / absensi praktik
     * Mendukung presensi mandiri saat scan KTA maupun penilaian langsung oleh instruktur
     */
    public function save_attendance_ajax() {
        header('Content-Type: application/json; charset=utf-8');
        $this->ensure_session_started();

        $is_logged = $this->is_logged_in();
        $logged_id = $is_logged ? $this->get_session_data('juleha_id') : null;
        $is_admin = $is_logged ? $this->is_admin() : false;
        $is_logged_instructor = !empty($logged_id) ? $this->is_instructor($logged_id) : false;

        $evaluator_id = strtoupper(trim($this->input->post('evaluator_id') ?: $logged_id ?: ''));
        if (preg_match('/([A-Z]{3}[0-9]{6})/i', $evaluator_id, $matches)) {
            $evaluator_id = strtoupper($matches[1]);
        }
        $is_evaluator_instructor = (!empty($evaluator_id) && $this->is_instructor($evaluator_id));

        $can_evaluate = ($is_admin || $is_logged_instructor || $is_evaluator_instructor);

        $juleha_id = strtoupper(trim($this->input->post('juleha_id')));
        if (preg_match('/([A-Z]{3}[0-9]{6})/i', $juleha_id, $matches)) {
            $juleha_id = strtoupper($matches[1]);
        }

        if (empty($juleha_id)) {
            echo json_encode(array('status' => false, 'message' => 'ID Juleha anggota wajib diisi atau di-scan.'));
            return;
        }

        $m_check = $this->member->get($juleha_id);
        if (empty($m_check['res'])) {
            echo json_encode(array('status' => false, 'message' => 'ID Juleha ' . $juleha_id . ' tidak terdaftar dalam database.'));
            return;
        }

        $role = strtolower(trim($this->input->post('role') ?: 'praktikan'));
        
        // RPH: HANYA RPH TOW (1) dan RPH Kedurus (2)
        $rph_id = ((int)$this->input->post('rph_id') === 2) ? 2 : 1;
        $animal_type = trim($this->input->post('animal_type') ?: 'Sapi');
        
        $praktekdate = trim($this->input->post('praktekdate'));
        if (empty($praktekdate)) {
            $praktekdate = date('Y-m-d H:i:s');
        } elseif (strlen($praktekdate) === 16) {
            $praktekdate = str_replace('T', ' ', $praktekdate) . ':00';
        }

        // Ambil ID Instruktur Pembimbing yang dipilih
        $instructor_id = strtoupper(trim($this->input->post('instructor_id')));
        if (preg_match('/([A-Z]{3}[0-9]{6})/i', $instructor_id, $matches)) {
            $instructor_id = strtoupper($matches[1]);
        }

        $praktek_id = (int)$this->input->post('id');

        if ($role === 'praktikan') {
            if ($can_evaluate) {
                // Instruktur resmi / Admin sedang mengevaluasi peserta
                $eval_status = trim($this->input->post('evaluation_status') ?: 'Lulus Praktik');
                $description = trim($this->input->post('description'));
                $evaluated_by = !empty($evaluator_id) ? $evaluator_id : ($logged_id ?: $instructor_id);
                $evaluated_at = date('Y-m-d H:i:s');
                if (empty($instructor_id) && !empty($evaluated_by)) {
                    $instructor_id = $evaluated_by;
                }
            } else {
                // Peserta biasa check-in mandiri -> Tidak bisa mengisi evaluasi sendiri
                $eval_status = 'Menunggu Evaluasi';
                $description = 'Presensi mandiri via Scan QR KTA di RPH. Menunggu evaluasi instruktur pembimbing.';
                $evaluated_by = NULL;
                $evaluated_at = NULL;
            }
        } else {
            // Peran Instruktur bertugas
            $eval_status = 'Bertugas';
            $description = trim($this->input->post('description') ?: 'Penugasan Instruktur Pembimbing Praktik di RPH');
            $evaluated_by = !empty($evaluator_id) ? $evaluator_id : ($logged_id ?: $juleha_id);
            $evaluated_at = date('Y-m-d H:i:s');
            $instructor_id = $juleha_id;
        }

        $data = array(
            'id'                => $praktek_id > 0 ? $praktek_id : NULL,
            'juleha_id'         => $juleha_id,
            'role'              => $role,
            'instructor_id'     => !empty($instructor_id) ? $instructor_id : NULL,
            'rph_id'            => $rph_id,
            'location_name'     => ($rph_id === 2) ? 'RPH Kedurus' : 'RPH TOW (Tambak Osowilangun)',
            'animal_type'       => $animal_type,
            'evaluation_status' => $eval_status,
            'praktekdate'       => $praktekdate,
            'description'       => $description,
            'created_by'        => !empty($logged_id) ? $logged_id : $juleha_id,
            'evaluated_by'      => $evaluated_by,
            'evaluated_at'      => $evaluated_at
        );

        $result = $this->praktek->save_attendance($data);
        if ($result['status']) {
            $member_name = trim($m_check['res']->firstname . ' ' . $m_check['res']->lastname);
            if (empty($member_name)) {
                $member_name = $m_check['res']->nickname;
            }

            $rph_nama = ($rph_id === 2) ? 'RPH Kedurus' : 'RPH TOW';
            $role_label = ($role === 'instruktur') ? 'Penugasan Instruktur' : 'Praktikan';

            if ($can_evaluate && $role === 'praktikan') {
                $msg = 'Alhamdulillah! Evaluasi untuk ' . $member_name . ' (' . $juleha_id . ') berhasil disimpan dengan status: "' . $eval_status . '"!';
            } else {
                $msg = 'Alhamdulillah! Presensi ' . $member_name . ' (' . $juleha_id . ') di ' . $rph_nama . ' sebagai ' . $role_label . ' berhasil disimpan!';
            }

            echo json_encode(array(
                'status'  => true,
                'message' => $msg,
                'id'      => $result['id'],
                'action'  => $result['action']
            ));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Gagal menyimpan presensi ke database. Silakan coba lagi.'));
        }
    }

    /**
     * AJAX: Instruktur / Admin menginput atau memperbarui catatan evaluasi peserta
     */
    public function save_evaluation_ajax() {
        if (!$this->is_logged_in()) {
            echo json_encode(array('status' => false, 'message' => 'Sesi login telah habis.'));
            return;
        }

        $id = (int)$this->input->post('id');
        $eval_status = trim($this->input->post('evaluation_status') ?: 'Lulus Praktik');
        $notes = trim($this->input->post('description'));
        $evaluator_id = $this->get_session_data('juleha_id');

        if ($id <= 0) {
            echo json_encode(array('status' => false, 'message' => 'ID data praktik tidak valid.'));
            return;
        }

        if (empty($notes)) {
            echo json_encode(array('status' => false, 'message' => 'Catatan evaluasi wajib diisi oleh Instruktur.'));
            return;
        }

        $res = $this->praktek->update_evaluation($id, $eval_status, $notes, $evaluator_id);
        if ($res) {
            echo json_encode(array(
                'status'  => true,
                'message' => 'Alhamdulillah, catatan evaluasi instruktur berhasil disimpan dan ditautkan ke profil peserta!'
            ));
        } else {
            echo json_encode(array('status' => false, 'message' => 'Gagal memperbarui catatan evaluasi.'));
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
