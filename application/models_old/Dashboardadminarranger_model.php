<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardadminarranger_model extends MY_Model{

    public function totaluser(){
        $sql = "SELECT  COUNT(*) as jumlah FROM tuser";
        return $this->db->query($sql)->row();
    }

    public function totalLagu(){
        $sql = "SELECT  COUNT(*) as jumlah FROM tsong";
        return $this->db->query($sql)->row();
    }

    public function totalAdmin(){
        $sql = "SELECT  COUNT(*) as jumlah FROM tadmin";
        return $this->db->query($sql)->row();
    }

    public function totalArranger(){
        $sql = "SELECT COUNT(*) as jumlah FROM tarranger";
        return $this->db->query($sql)->row();
    }
}
