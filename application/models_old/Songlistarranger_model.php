<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songlistarranger_model extends MY_Model {
    
    public function getAllDataSongList($id, $offset, $dataPerPage)
    {
        $sql = "SELECT tsong.songId, tsong.title, tsong.coverImage FROM tsong INNER JOIN tsongarranger ON tsongarranger.songId = tsong.songId WHERE tsongarranger.arrangerId = ? ORDER BY tsong.songId DESC LIMIT $offset, $dataPerPage";
        $data = $this->db->query($sql, array($id))->result();

        return $data;
    }

    public function countDataSongList($id)
    {

        $query = "SELECT tsong.songId, tsong.title, tsong.coverImage FROM tsong INNER JOIN tsongarranger ON tsongarranger.songId = tsong.songId WHERE tsongarranger.arrangerId = ?";
        $data = $this->db->query($query, array($id))->num_rows();

        return $data;
    }
}