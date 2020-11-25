<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_model extends MY_Model{
    function getData(){
        $sql = "SELECT permissionId, name FROM tpermission";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }
}
/**
 * Created by PhpStorm.
 * User: subki
 * Date: 03/01/2018
 * Time: 10:45
 */