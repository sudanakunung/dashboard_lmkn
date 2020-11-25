<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlabel_model extends MY_Model{
    function getArtist($labelId){
        $sql = "SELECT DISTINCT tsongartist.artistId as artistIds, tartist.`name`,
                (SELECT COUNT(tsongartist.songId) FROM tsongartist INNER JOIN trecordlabelsong ON tsongartist.songId = trecordlabelsong.songId WHERE trecordlabelsong.recordLabelId = ? AND tsongartist.artistId = artistIds ) as jumlahlagu,
                trecordlabel.recordLabel,
                (SELECT tadmin.username FROM tadmin WHERE tadmin.artistId = artistIds) as usernames,
                (SELECT tadmin.adminId FROM tadmin WHERE tadmin.artistId = artistIds) as adminIds FROM tartist
                 INNER JOIN tsongartist ON tartist.artistId = tsongartist.artistId
                 INNER JOIN trecordlabelsong ON tsongartist.songId = trecordlabelsong.songId
                 INNER JOIN trecordlabel ON trecordlabel.recordLabelId = trecordlabelsong.recordLabelId
                 WHERE trecordlabel.recordLabelId = ? ORDER BY adminIds DESC";
        $data = $this->db->query($sql, array($labelId, $labelId))->result();
        return $data;;

    }

}