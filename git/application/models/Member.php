<?php
Class Member extends CI_Model{
    function __construct(){
        parent::__construct();
    }
    function getmax($region){
        $sql = "select substring(m,4,2)hah,case when date_format(now(),'%y')=substring(m,4,2) then cast(substring(m,4,length(m)) as int)+1 else concat(date_format(now(),'%y'),'0001') end m from (";
        $sql.= "select max(juleha_id)m from members ";
        $sql.= "where region='".$region."') ";
        $sql.= "Z ";
        
        
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),
            'cnt'=>$que->num_rows()
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
        $txt = array();
        $sql = 'update  ' . $params['tableName'] . ' ';
        $sql.= 'set ';
        foreach($params['columns'] as $key=>$val){
            array_push($txt,$key.'="'.$val.'"');
        }
        $sql.= ' '.implode(",",$txt)." ";
        $sql.= ' where juleha_id = "' . $params['columns']['juleha_id'] . '" ';
        $ci = & get_instance();
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
