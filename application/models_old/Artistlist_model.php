<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Artistlist_model extends MY_Model
{

    public function getDataArtist($offset, $dataPerPage, $keyword = null)
    {
        if(!empty($keyword)) {
            $where = "WHERE name LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT artistId, name, referral FROM tartist $where ORDER BY name ASC LIMIT $offset, $dataPerPage")->result();

        foreach ($query as $key => $value) {
            $allartist = array();
            $allartist['artistId'] = $value->artistId;
            $allartist['name'] = $value->name;
            $allartist['referral'] = $value->referral;

            $sql_admin = $this->db->select('adminId')
                ->get_where('tadmin', array('artistId' => $value->artistId))
                ->row();
            $adminId = ($sql_admin ? $sql_admin->adminId : '0');
            $allartist['adminId'] = $adminId;

            $data[] = (object)$allartist;
        }

        return $data;
    }

    public function countDataArtist($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE name LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT artistId FROM tartist $where")->num_rows();

        return $query;
    }
}
?>