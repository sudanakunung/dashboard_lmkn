<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songlistlabel_model extends MY_Model {
    
    public function getAllDataSongList($id, $offset, $dataPerPage)
    {
        $sql = "SELECT tsong.songId, tsong.title, tsong.coverImage FROM tsong INNER JOIN trecordlabelsong ON trecordlabelsong.songId = tsong.songId WHERE trecordlabelsong.recordLabelId = ? ORDER BY tsong.songId DESC LIMIT $offset, $dataPerPage";
        $data = $this->db->query($sql, array($id))->result();

        return $data;
    }

    public function countDataSongList($id)
    {

        $query = "SELECT tsong.songId, tsong.title, tsong.coverImage FROM tsong INNER JOIN trecordlabelsong ON trecordlabelsong.songId = tsong.songId WHERE trecordlabelsong.recordLabelId = ?";
        $data = $this->db->query($query, array($id))->num_rows();

        return $data;
    }
}