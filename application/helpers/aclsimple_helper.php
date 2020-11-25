<?php

function getACL($roleId, $permission){
    $ci =& get_instance();
    $table = "tacl";
        $user = $ci->db->where('roleId', $roleId)
            ->where('permissionId', $permission)
            ->limit(1)
            ->get($table)
            ->row();

        if(count($user)){
            return $user;
        }
        else{
            return $user;
        }
    }
