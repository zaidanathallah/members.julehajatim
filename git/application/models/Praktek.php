<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Praktek extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('crud');
        $this->ensure_schema();
    }

    /**
     * Pastikan skema tabel prakteks dan rphs selalu up-to-date tanpa error di lokal maupun hosting cPanel
     */
    public function ensure_schema() {
        if (!$this->db->table_exists('prakteks')) {
            return;
        }

        // 1. Pastikan RPH hanya RPH TOW dan RPH Kedurus
        if ($this->db->table_exists('rphs')) {
            $this->db->query("UPDATE `rphs` SET `name` = 'RPH TOW (Tambak Osowilangun)' WHERE `id` = 1");
            $this->db->query("UPDATE `rphs` SET `name` = 'RPH Kedurus' WHERE `id` = 2");
        }

        // 2. Pastikan tabel daftar instruktur resmi tersedia
        if (!$this->db->table_exists('praktek_instructors')) {
            $this->db->query("CREATE TABLE IF NOT EXISTS `praktek_instructors` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `juleha_id` VARCHAR(30) NOT NULL UNIQUE,
                `status` VARCHAR(20) NOT NULL DEFAULT 'active',
                `sk_number` VARCHAR(100) NULL,
                `notes` TEXT NULL,
                `created_by` VARCHAR(30) NULL,
                `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
                KEY `idx_juleha_id` (`juleha_id`),
                KEY `idx_status` (`status`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

            // Masukkan instruktur awal terdaftar
            $default_instructors = array('SBY220006', 'SBY220033');
            foreach ($default_instructors as $inst_id) {
                $this->db->query("INSERT IGNORE INTO `praktek_instructors` (`juleha_id`, `status`, `notes`, `created_by`, `created_at`) VALUES (" . $this->db->escape($inst_id) . ", 'active', 'Instruktur Resmi Juleha Jatim', 'SYSTEM', NOW())");
            }
        }

        // 2. Pastikan kolom-kolom prakteks lengkap
        $fields = $this->db->list_fields('prakteks');
        $need_migration = !in_array('role', $fields) 
                       || !in_array('instructor_id', $fields) 
                       || !in_array('animal_type', $fields) 
                       || !in_array('evaluation_status', $fields)
                       || !in_array('location_name', $fields) 
                       || !in_array('created_by', $fields)
                       || !in_array('evaluated_by', $fields)
                       || !in_array('evaluated_at', $fields);

        if ($need_migration) {
            $this->db->query("SET SESSION sql_mode = ''");
            // Bersihkan tanggal 0000-00-00 jika ada agar ALTER TABLE tidak error
            $this->db->query("UPDATE `prakteks` SET `praktekdate` = `createdate` WHERE CAST(`praktekdate` AS CHAR) LIKE '0000-00-00%' OR `praktekdate` IS NULL");

            if (!in_array('role', $fields)) {
                $this->db->query("ALTER TABLE `prakteks` ADD COLUMN `role` VARCHAR(50) NOT NULL DEFAULT 'praktikan' AFTER `juleha_id`");
            }
            if (!in_array('instructor_id', $fields)) {
                $this->db->query("ALTER TABLE `prakteks` ADD COLUMN `instructor_id` VARCHAR(20) NULL DEFAULT NULL AFTER `role`");
            }
            if (!in_array('animal_type', $fields)) {
                $this->db->query("ALTER TABLE `prakteks` ADD COLUMN `animal_type` VARCHAR(50) NOT NULL DEFAULT 'Sapi' AFTER `instructor_id`");
            }
            if (!in_array('evaluation_status', $fields)) {
                $this->db->query("ALTER TABLE `prakteks` ADD COLUMN `evaluation_status` VARCHAR(50) NOT NULL DEFAULT 'Lulus Praktik' AFTER `animal_type`");
            }
            if (!in_array('location_name', $fields)) {
                $this->db->query("ALTER TABLE `prakteks` ADD COLUMN `location_name` VARCHAR(150) NULL DEFAULT NULL AFTER `rph_id`");
            }
            if (!in_array('created_by', $fields)) {
                $this->db->query("ALTER TABLE `prakteks` ADD COLUMN `created_by` VARCHAR(50) NULL DEFAULT NULL AFTER `description`");
            }
            if (!in_array('evaluated_by', $fields)) {
                $this->db->query("ALTER TABLE `prakteks` ADD COLUMN `evaluated_by` VARCHAR(20) NULL DEFAULT NULL AFTER `created_by`");
            }
            if (!in_array('evaluated_at', $fields)) {
                $this->db->query("ALTER TABLE `prakteks` ADD COLUMN `evaluated_at` DATETIME NULL DEFAULT NULL AFTER `evaluated_by`");
            }
        }
    }

    /**
     * Backward-compatible save method
     */
    public function save($params) {
        return $this->crud->create('prakteks', $params);
    }

    /**
     * Backward-compatible gets method
     */
    public function gets($params) {
        return $this->crud->gets(
            'prakteks',
            array('id', 'juleha_id'),
            array('rph_id' => $params['rph_id'], 'praktekdate' => $params['praktekdate'])
        );
    }

    /**
     * Backward-compatible delete method
     */
    public function delete($params) {
        return $this->crud->delete('prakteks', $params);
    }

    /**
     * Simpan atau update data praktik lengkap
     */
    public function save_attendance($data) {
        $praktekdate = !empty($data['praktekdate']) ? $data['praktekdate'] : date('Y-m-d H:i:s');
        if (strlen($praktekdate) === 10) {
            $praktekdate .= ' ' . date('H:i:s');
        }

        // RPH dibatasi khusus RPH TOW (1) dan RPH Kedurus (2)
        $rph_id = (!empty($data['rph_id']) && (int)$data['rph_id'] === 2) ? 2 : 1;
        $loc_name = ($rph_id === 2) ? 'RPH Kedurus' : 'RPH TOW (Tambak Osowilangun)';

        $insert_data = array(
            'juleha_id'         => strtoupper(trim($data['juleha_id'] ?? '')),
            'role'              => !empty($data['role']) ? strtolower(trim($data['role'])) : 'praktikan',
            'instructor_id'     => !empty($data['instructor_id']) ? strtoupper(trim($data['instructor_id'])) : NULL,
            'rph_id'            => $rph_id,
            'location_name'     => $loc_name,
            'animal_type'       => !empty($data['animal_type']) ? trim($data['animal_type']) : 'Sapi',
            'evaluation_status' => !empty($data['evaluation_status']) ? trim($data['evaluation_status']) : 'Lulus Praktik',
            'praktekdate'       => $praktekdate,
            'description'       => !empty($data['description']) ? trim($data['description']) : NULL,
            'created_by'        => !empty($data['created_by']) ? trim($data['created_by']) : NULL,
            'evaluated_by'      => !empty($data['evaluated_by']) ? trim($data['evaluated_by']) : NULL,
            'evaluated_at'      => !empty($data['evaluated_at']) ? $data['evaluated_at'] : NULL
        );

        if (!empty($data['id'])) {
            $this->db->where('id', (int)$data['id']);
            $res = $this->db->update('prakteks', $insert_data);
            return array('status' => $res, 'id' => $data['id'], 'action' => 'update');
        } else {
            $res = $this->db->insert('prakteks', $insert_data);
            $new_id = $this->db->insert_id();
            return array('status' => $res, 'id' => $new_id, 'action' => 'insert');
        }
    }

    /**
     * Khusus Instruktur / Admin: Update Catatan Evaluasi & Status Kelulusan Peserta
     */
    public function update_evaluation($id, $eval_status, $notes, $evaluator_id) {
        $data = array(
            'evaluation_status' => trim($eval_status),
            'description'       => trim($notes),
            'evaluated_by'      => strtoupper(trim($evaluator_id)),
            'evaluated_at'      => date('Y-m-d H:i:s')
        );
        $this->db->where('id', (int)$id);
        return $this->db->update('prakteks', $data);
    }

    /**
     * Hapus record presensi praktik berdasarkan ID
     */
    public function delete_by_id($id) {
        return $this->db->where('id', (int)$id)->delete('prakteks');
    }

    /**
     * Ambil record tunggal berdasarkan ID
     */
    public function get_by_id($id) {
        $this->db->select("
            p.*,
            m.nickname as member_nickname,
            m.firstname as member_firstname,
            m.lastname as member_lastname,
            m.region as member_region,
            inst.nickname as instructor_nickname,
            inst.firstname as instructor_firstname,
            inst.lastname as instructor_lastname,
            eval.nickname as evaluator_nickname,
            eval.firstname as evaluator_firstname,
            eval.lastname as evaluator_lastname,
            r.name as rph_name,
            COALESCE(NULLIF(p.location_name, ''), r.name, 'RPH TOW (Tambak Osowilangun)') as effective_location
        ");
        $this->db->from('prakteks p');
        $this->db->join('members m', 'm.juleha_id = p.juleha_id', 'left');
        $this->db->join('members inst', 'inst.juleha_id = p.instructor_id', 'left');
        $this->db->join('members eval', 'eval.juleha_id = p.evaluated_by', 'left');
        $this->db->join('rphs r', 'r.id = p.rph_id', 'left');
        $this->db->where('p.id', (int)$id);
        return $this->db->get()->row();
    }

    /**
     * Ambil seluruh riwayat praktik dengan join data anggota & instruktur & RPH
     */
    public function get_all_records($filters = array(), $limit = 0, $offset = 0) {
        $this->db->select("
            p.*,
            m.nickname as member_nickname,
            m.firstname as member_firstname,
            m.lastname as member_lastname,
            m.region as member_region,
            inst.nickname as instructor_nickname,
            inst.firstname as instructor_firstname,
            inst.lastname as instructor_lastname,
            eval.nickname as evaluator_nickname,
            eval.firstname as evaluator_firstname,
            eval.lastname as evaluator_lastname,
            r.name as rph_name,
            COALESCE(NULLIF(p.location_name, ''), r.name, 'RPH TOW (Tambak Osowilangun)') as effective_location
        ");
        $this->db->from('prakteks p');
        $this->db->join('members m', 'm.juleha_id = p.juleha_id', 'left');
        $this->db->join('members inst', 'inst.juleha_id = p.instructor_id', 'left');
        $this->db->join('members eval', 'eval.juleha_id = p.evaluated_by', 'left');
        $this->db->join('rphs r', 'r.id = p.rph_id', 'left');

        if (!empty($filters['juleha_id'])) {
            $this->db->group_start();
            $this->db->where('p.juleha_id', $filters['juleha_id']);
            $this->db->or_where('p.instructor_id', $filters['juleha_id']);
            $this->db->group_end();
        }

        if (!empty($filters['role'])) {
            $this->db->where('p.role', $filters['role']);
        }

        if (!empty($filters['rph_id'])) {
            $this->db->where('p.rph_id', (int)$filters['rph_id']);
        }

        if (!empty($filters['animal_type'])) {
            $this->db->where('p.animal_type', $filters['animal_type']);
        }

        if (!empty($filters['evaluation_status'])) {
            $this->db->where('p.evaluation_status', $filters['evaluation_status']);
        }

        if (!empty($filters['year'])) {
            $this->db->where("YEAR(p.praktekdate) = ", (int)$filters['year']);
        }

        if (!empty($filters['month'])) {
            $this->db->where("MONTH(p.praktekdate) = ", (int)$filters['month']);
        }

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $this->db->group_start();
            $this->db->like('p.juleha_id', $search);
            $this->db->or_like('m.nickname', $search);
            $this->db->or_like('m.firstname', $search);
            $this->db->or_like('m.lastname', $search);
            $this->db->or_like('p.description', $search);
            $this->db->group_end();
        }

        $this->db->order_by('p.praktekdate', 'DESC');
        $this->db->order_by('p.id', 'DESC');

        if ($limit > 0) {
            $this->db->limit($limit, $offset);
        }

        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Ambil data praktik per anggota (baik sebagai praktikan maupun instruktur)
     */
    public function get_by_member($juleha_id) {
        $clean_id = trim($juleha_id);

        // 1. Riwayat sebagai praktikan
        $this->db->select("
            p.*,
            inst.nickname as instructor_nickname,
            inst.firstname as instructor_firstname,
            inst.lastname as instructor_lastname,
            eval.nickname as evaluator_nickname,
            eval.firstname as evaluator_firstname,
            eval.lastname as evaluator_lastname,
            r.name as rph_name,
            COALESCE(NULLIF(p.location_name, ''), r.name, 'RPH TOW (Tambak Osowilangun)') as effective_location
        ");
        $this->db->from('prakteks p');
        $this->db->join('members inst', 'inst.juleha_id = p.instructor_id', 'left');
        $this->db->join('members eval', 'eval.juleha_id = p.evaluated_by', 'left');
        $this->db->join('rphs r', 'r.id = p.rph_id', 'left');
        $this->db->where('p.juleha_id', $clean_id);
        $this->db->where('(p.role = "praktikan" OR p.role IS NULL OR p.role = "")');
        $this->db->order_by('p.praktekdate', 'DESC');
        $as_praktikan = $this->db->get()->result();

        // 2. Riwayat sebagai instruktur
        $this->db->select("
            p.*,
            m.nickname as member_nickname,
            m.firstname as member_firstname,
            m.lastname as member_lastname,
            eval.nickname as evaluator_nickname,
            eval.firstname as evaluator_firstname,
            eval.lastname as evaluator_lastname,
            r.name as rph_name,
            COALESCE(NULLIF(p.location_name, ''), r.name, 'RPH TOW (Tambak Osowilangun)') as effective_location
        ");
        $this->db->from('prakteks p');
        $this->db->join('members m', 'm.juleha_id = p.juleha_id', 'left');
        $this->db->join('members eval', 'eval.juleha_id = p.evaluated_by', 'left');
        $this->db->join('rphs r', 'r.id = p.rph_id', 'left');
        $this->db->group_start();
        $this->db->where('p.instructor_id', $clean_id);
        $this->db->or_where('(p.juleha_id = "' . $clean_id . '" AND p.role = "instruktur")');
        $this->db->group_end();
        $this->db->order_by('p.praktekdate', 'DESC');
        $as_instruktur = $this->db->get()->result();

        // 3. Gabungkan semua sesi
        $all_sessions = array_merge($as_praktikan, $as_instruktur);
        usort($all_sessions, function($a, $b) {
            return strtotime($b->praktekdate ?? 0) - strtotime($a->praktekdate ?? 0);
        });

        return array(
            'total_count'      => count($as_praktikan) + count($as_instruktur),
            'count_praktikan'  => count($as_praktikan),
            'count_instruktur' => count($as_instruktur),
            'as_praktikan'     => $as_praktikan,
            'as_instruktur'    => $as_instruktur,
            'all'              => $all_sessions
        );
    }

    /**
     * Rekapitulasi per anggota (Leaderboard / Jumlah Praktik & Instruktur)
     */
    public function get_member_rekap() {
        $sql = "
            SELECT 
                m.id as member_id,
                m.juleha_id,
                m.nickname,
                m.firstname,
                m.lastname,
                m.region,
                COALESCE(p_count.cnt_praktikan, 0) as total_praktikan,
                COALESCE(i_count.cnt_instruktur, 0) as total_instruktur,
                (COALESCE(p_count.cnt_praktikan, 0) + COALESCE(i_count.cnt_instruktur, 0)) as total_aktivitas,
                latest.last_date
            FROM members m
            LEFT JOIN (
                SELECT juleha_id, COUNT(id) as cnt_praktikan 
                FROM prakteks 
                WHERE (role = 'praktikan' OR role IS NULL OR role = '') 
                GROUP BY juleha_id
            ) p_count ON p_count.juleha_id = m.juleha_id
            LEFT JOIN (
                SELECT instructor_id as inst_id, COUNT(id) as cnt_instruktur 
                FROM prakteks 
                WHERE instructor_id IS NOT NULL AND instructor_id != ''
                GROUP BY instructor_id
            ) i_count ON i_count.inst_id = m.juleha_id
            LEFT JOIN (
                SELECT juleha_id, MAX(praktekdate) as last_date 
                FROM prakteks 
                GROUP BY juleha_id
            ) latest ON latest.juleha_id = m.juleha_id
            WHERE (COALESCE(p_count.cnt_praktikan, 0) > 0 OR COALESCE(i_count.cnt_instruktur, 0) > 0)
            ORDER BY total_aktivitas DESC, m.nickname ASC
        ";
        return $this->db->query($sql)->result();
    }

    /**
     * Summary statistik dashboard praktik
     */
    public function get_statistics() {
        $total_records = $this->db->count_all('prakteks');
        
        $total_praktikan = $this->db->where('(role = "praktikan" OR role IS NULL OR role = "")')->from('prakteks')->count_all_results();
        $total_instruktur = $this->db->where('role', 'instruktur')->from('prakteks')->count_all_results();
        
        $unique_members = $this->db->query("SELECT COUNT(DISTINCT juleha_id) as cnt FROM prakteks")->row()->cnt ?? 0;
        $unique_instructors = $this->db->query("SELECT COUNT(DISTINCT instructor_id) as cnt FROM prakteks WHERE instructor_id IS NOT NULL AND instructor_id != ''")->row()->cnt ?? 0;

        return array(
            'total_records'      => (int)$total_records,
            'total_praktikan'    => (int)$total_praktikan,
            'total_instruktur'   => (int)$total_instruktur,
            'unique_members'     => (int)$unique_members,
            'unique_instructors' => (int)$unique_instructors
        );
    }

    /**
     * Cek apakah suatu ID Juleha terdaftar resmi sebagai Instruktur
     */
    public function is_instructor($juleha_id) {
        if (empty($juleha_id)) {
            return false;
        }
        $clean_id = strtoupper(trim($juleha_id));

        // 1. Cek di tabel praktek_instructors
        if ($this->db->table_exists('praktek_instructors')) {
            $row = $this->db->where('juleha_id', $clean_id)
                            ->where('status', 'active')
                            ->get('praktek_instructors')
                            ->row();
            if (!empty($row)) {
                return true;
            }
        }

        // 2. Cek apakah level admin / developer di tabel members
        $m = $this->db->select('memberlevel')->where('juleha_id', $clean_id)->get('members')->row();
        if (!empty($m) && $m->memberlevel !== null && (int)$m->memberlevel < 2) {
            return true;
        }

        return false;
    }

    /**
     * Ambil seluruh daftar instruktur resmi dengan detail nama dan statistik membimbing
     */
    public function get_instructors() {
        if (!$this->db->table_exists('praktek_instructors')) {
            return array();
        }

        $sql = "
            SELECT 
                pi.id as instructor_record_id,
                pi.juleha_id,
                pi.status as instructor_status,
                pi.sk_number,
                pi.notes as instructor_notes,
                pi.created_at as appointed_at,
                m.firstname,
                m.lastname,
                m.nickname,
                m.region,
                m.position,
                m.phone,
                m.mstatus,
                COALESCE(eval_cnt.total_evaluasi, 0) as total_evaluasi,
                COALESCE(duty_cnt.total_tugas, 0) as total_tugas
            FROM praktek_instructors pi
            LEFT JOIN members m ON m.juleha_id = pi.juleha_id
            LEFT JOIN (
                SELECT instructor_id, COUNT(*) as total_evaluasi 
                FROM prakteks 
                WHERE instructor_id IS NOT NULL AND instructor_id != ''
                GROUP BY instructor_id
            ) eval_cnt ON eval_cnt.instructor_id = pi.juleha_id
            LEFT JOIN (
                SELECT juleha_id, COUNT(*) as total_tugas 
                FROM prakteks 
                WHERE role = 'instruktur'
                GROUP BY juleha_id
            ) duty_cnt ON duty_cnt.juleha_id = pi.juleha_id
            ORDER BY pi.status ASC, pi.id ASC
        ";
        return $this->db->query($sql)->result();
    }

    /**
     * Tambah instruktur baru ke daftar
     */
    public function add_instructor($juleha_id, $notes = '', $created_by = '') {
        $clean_id = strtoupper(trim($juleha_id));
        if (empty($clean_id)) {
            return false;
        }

        $exist = $this->db->where('juleha_id', $clean_id)->get('praktek_instructors')->row();
        if (!empty($exist)) {
            $this->db->where('id', $exist->id)->update('praktek_instructors', array(
                'status'     => 'active',
                'notes'      => $notes,
                'created_by' => $created_by
            ));
            return $exist->id;
        } else {
            $this->db->insert('praktek_instructors', array(
                'juleha_id'   => $clean_id,
                'status'      => 'active',
                'notes'       => $notes,
                'created_by'  => $created_by,
                'created_at'  => date('Y-m-d H:i:s')
            ));
            return $this->db->insert_id();
        }
    }

    /**
     * Hapus instruktur dari daftar
     */
    public function delete_instructor($juleha_id) {
        $clean_id = strtoupper(trim($juleha_id));
        return $this->db->where('juleha_id', $clean_id)->delete('praktek_instructors');
    }

    /**
     * Daftar RPH Resmi: Hanya RPH TOW dan RPH Kedurus
     */
    public function get_rphs() {
        return array(
            (object)array('id' => 1, 'name' => 'RPH TOW (Tambak Osowilangun)'),
            (object)array('id' => 2, 'name' => 'RPH Kedurus')
        );
    }
}
