<?php
Class Member extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getmax($region){
        $ci = & get_instance();
        $safeRegion = $ci->db->escape_str($region);

        // Cari initial resmi dari tabel regions (mendukung pencarian via initial maupun nama lengkap)
        $regQuery = $ci->db->query("SELECT initial FROM regions WHERE UPPER(initial) = UPPER('".$safeRegion."') OR UPPER(name) = UPPER('".$safeRegion."') LIMIT 1");
        $regRow = $regQuery ? $regQuery->row() : null;
        $regCode = ($regRow && !empty($regRow->initial)) ? $regRow->initial : $region;
        $safeRegCode = $ci->db->escape_str($regCode);

        $sql = "select substring(m,4,2)hah, case when date_format(now(),'%y')=substring(m,4,2) then cast(substring(m,4,length(m)) as unsigned)+1 else concat(date_format(now(),'%y'),'0001') end m from (";
        $sql.= "select max(juleha_id)m from members ";
        $sql.= "where UPPER(region)=UPPER('".$safeRegCode."') OR UPPER(region)=UPPER('".$safeRegion."')) ";
        $sql.= "Z ";
        
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que ? $que->result() : [],
            'cnt'=>$que ? $que->num_rows() : 0,
            'initial'=>$regCode
        );
    }
    function gets(){
        $sql = 'select a.id,juleha_id,region,a.nickname,a.firstname,a.middlename,a.address,a.lastname,a.position,birthdate,count(b.id)certificate,count(c.id)portofolio,count(d.id)training,case mstatus when "1" then "aktif" else "Tidak Aktif" end mstatus  from members a ';
        $sql.= 'left outer join certificates b on b.member_id=a.id ';
        $sql.= 'left outer join portofolio c on c.member_id=a.id ';
        $sql.= 'left outer join trainings d on d.member_id=a.id ';
        $sql.= 'group by  a.id,juleha_id,region,a.nickname,a.firstname,a.middlename,a.address,a.lastname,a.position,birthdate ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
        );
    }
    function get($juleha_id){
        $sql = 'select a.id,juleha_id,region,a.nickname,a.firstname,a.middlename,a.address,a.lastname,a.position,birthdate,count(b.id)certificate,count(c.id)portofolio,count(d.id)training,case mstatus when "1" then "aktif" else "Tidak Aktif" end mstatus,substring(juleha_id,1,3)city   from members a ';
        $sql.= 'left outer join certificates b on b.member_id=a.id ';
        $sql.= 'left outer join portofolio c on c.member_id=a.id ';
        $sql.= 'left outer join trainings d on d.member_id=a.id ';
        $sql.= 'where juleha_id="'.$juleha_id.'" ';
        $sql.= 'group by  a.id,juleha_id,region,a.nickname,a.firstname,a.middlename,a.address,a.lastname,a.position,birthdate ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        if($que->num_rows()>0){
        return array(
            'res'=>$result[0],
            'cnt'=>$que->num_rows()
        );
        }else{
            return false;
        }
    }
    function save($params){

        $keys = array();$vals = array();
        $sql = 'insert into  ' . $params['tableName'];
        foreach($params['columns'] as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql.= '('.implode(",",$keys).")";
        $sql.= ' values ';
        $sql.= '("'.implode('","',$vals).'")';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'id'=>$ci->db->insert_id(),
            'sql'=>$sql
        );
    }
    function update($params){
        $ci = & get_instance();
        $txt = array();
        $sql = 'update ' . $params['tableName'] . ' ';
        $sql.= 'set ';
        $whereClause = '';

        if (!empty($params['columns']['id'])) {
            $whereClause = ' where id = "' . (int)$params['columns']['id'] . '" ';
        } else if (!empty($params['columns']['juleha_id'])) {
            $whereClause = ' where juleha_id = "' . $ci->db->escape_str($params['columns']['juleha_id']) . '" ';
        }

        foreach($params['columns'] as $key=>$val){
            // Skip primary key from update columns if it's the id
            if ($key === 'id' && !empty($whereClause)) {
                continue;
            }
            array_push($txt, $key . '="' . $ci->db->escape_str($val) . '"');
        }
        $sql.= ' ' . implode(",", $txt) . ' ';
        $sql.= $whereClause;
        $que = $ci->db->query($sql);
        return array(
            'sql'=>$sql
        );
    }
    function getpassword($juleha_id){
        $sql = 'select id,password,memberlevel from members ';
        $sql.= 'where juleha_id = "' . $juleha_id . '" ';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        $result = $que->result();
        if($que->num_rows()>0){
            return array(
                'sql'=>$sql,
                'password'=>$result[0]->password,
                'id'=>$result[0]->id,
                'memberlevel'=>$result[0]->memberlevel
            );
        }else{
            return array(
                'sql'=>$sql,
                'password'=>'tik ketemu'    
            );
        }
    }

    function delete_member($id, $juleha_id = null){
        $ci = & get_instance();
        $id = (int)$id;
        if ($id <= 0) {
            return array('status' => false, 'message' => 'ID anggota tidak valid.');
        }

        // Hapus relasi sertifikat, portofolio, dan pelatihan
        $ci->db->where('member_id', $id)->delete('certificates');
        $ci->db->where('member_id', $id)->delete('portofolio');
        $ci->db->where('member_id', $id)->delete('trainings');

        // Hapus file foto KTA jika ada
        if (!empty($juleha_id)) {
            $cleanJulehaId = preg_replace('/[^A-Za-z0-9_\-]/', '_', $juleha_id);
            $photoPathJpg = './images/' . $cleanJulehaId . '.jpg';
            $photoPathPng = './images/' . $cleanJulehaId . '.png';
            if (file_exists($photoPathJpg)) {
                @unlink($photoPathJpg);
            }
            if (file_exists($photoPathPng)) {
                @unlink($photoPathPng);
            }
        }

        // Hapus data anggota dari tabel members
        $ci->db->where('id', $id)->delete('members');

        return array(
            'status' => true,
            'message' => 'Data anggota berhasil dihapus permanen dari sistem.'
        );
    }

    function get_analytics_data(){
        $ci = & get_instance();

        // 1. Ringkasan Status Keanggotaan
        $sqlSummary = "SELECT 
            COUNT(*) as total_members,
            SUM(CASE WHEN LOWER(TRIM(mstatus)) = '1' OR LOWER(TRIM(mstatus)) = 'aktif' THEN 1 ELSE 0 END) as total_active,
            SUM(CASE WHEN LOWER(TRIM(mstatus)) != '1' AND LOWER(TRIM(mstatus)) != 'aktif' THEN 1 ELSE 0 END) as total_inactive
        FROM members";
        $summaryRes = $ci->db->query($sqlSummary)->row_array();

        $totalMembers = (int)($summaryRes['total_members'] ?? 0);
        $totalActive = (int)($summaryRes['total_active'] ?? 0);
        $totalInactive = (int)($summaryRes['total_inactive'] ?? 0);

        $pctActive = $totalMembers > 0 ? round(($totalActive / $totalMembers) * 100, 1) : 0;
        $pctInactive = $totalMembers > 0 ? round(($totalInactive / $totalMembers) * 100, 1) : 0;

        // 2. Ringkasan Kompetensi (Sertifikat, Portofolio, Pelatihan)
        $certCount = (int)$ci->db->count_all('certificates');
        $portoCount = (int)$ci->db->count_all('portofolio');
        $trainCount = (int)$ci->db->count_all('trainings');

        // 3. Rekapitulasi per Daerah / Wilayah (dengan Nama Daerah Resmi dari tabel regions)
        $sqlRegions = "SELECT 
            UPPER(TRIM(COALESCE(m.region, 'LAIN'))) as region_code,
            COALESCE(r.name, m.region, 'Wilayah Lainnya') as region_name,
            COUNT(m.id) as total,
            SUM(CASE WHEN LOWER(TRIM(m.mstatus)) = '1' OR LOWER(TRIM(m.mstatus)) = 'aktif' THEN 1 ELSE 0 END) as active_count,
            SUM(CASE WHEN LOWER(TRIM(m.mstatus)) != '1' AND LOWER(TRIM(m.mstatus)) != 'aktif' THEN 1 ELSE 0 END) as inactive_count
        FROM members m
        LEFT JOIN regions r ON UPPER(TRIM(m.region)) = UPPER(TRIM(r.initial))
        GROUP BY region_code, region_name
        ORDER BY total DESC";
        $allRegions = $ci->db->query($sqlRegions)->result_array();

        // 4. Top 10 Daerah dengan Anggota Terbanyak
        $topRegions = array_slice($allRegions, 0, 10);

        return array(
            'summary' => array(
                'total' => $totalMembers,
                'active' => $totalActive,
                'inactive' => $totalInactive,
                'pct_active' => $pctActive,
                'pct_inactive' => $pctInactive,
                'certificates' => $certCount,
                'portofolio' => $portoCount,
                'trainings' => $trainCount
            ),
            'top_regions' => $topRegions,
            'all_regions' => $allRegions
        );
    }
}
