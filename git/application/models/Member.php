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
        ;
    }
}
