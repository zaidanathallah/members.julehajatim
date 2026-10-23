<?php
Class Crud {
    function create($tableName,$cols){
        $keys = array();$vals = array();
        foreach($cols as $key=>$val){
            array_push($keys,$key);
            array_push($vals,$val);
        }
        $sql = 'insert into ' . $tableName . ' ';
        $sql.= '('.implode(',',$keys).') values ';
        $sql.= '("'.implode('","',$vals).'")';
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return $ci->db->insert_id();
    }
    function gets($tableName,$cols,$conditions){
        $keys = array();$conds = array();
        foreach($cols as $key){
            array_push($keys,$key);
        }
        foreach($conditions as $key=>$val){
            array_push($conds,$key .'="'. $val . '"');
        }
        $sql = 'select '.implode(',',$keys).' from ' . $tableName . ' ';
        if(count($conditions)>0){
            $sql.= 'where '.implode(' and ',$conds).' ';
        }
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'res'=>$que->result(),'cnt'=>$que->num_rows()
        );
    }
    function delete($tableName,$condition){
        $arrcondition = array();
        foreach($condition as $key=>$val){
            array_push($arrcondition,"".$key."='".$val."'");
        }
        $sql = "delete from " . $tableName . " ";
        $sql.= "where " . implode(" and ",$arrcondition);
        $ci = & get_instance();
        $que = $ci->db->query($sql);
        return array(
            'sql'=>$sql
        );
    }
}