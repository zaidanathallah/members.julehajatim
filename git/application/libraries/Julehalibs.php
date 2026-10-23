<?php
Class Julehalibs{
    function getcomboformat($objs,$key,$val){
        $out = array();
        foreach($objs as $obj){
            $out[$obj->$key] = $obj->$val;
        }
        return $out;
    }
}