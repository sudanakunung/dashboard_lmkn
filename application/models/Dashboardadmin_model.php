<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardadmin_model extends MY_Model{

    public function totaluser(){
        $sql = "SELECT  COUNT(*) as jumlah FROM tuser";
        return $this->db->query($sql)->row();
    }

    public function totalLagu(){
        $sql = "SELECT  COUNT(*) as jumlah FROM tsong";
        return $this->db->query($sql)->row();
    }

    public function totalLabel(){
        $sql = "SELECT  COUNT(*) as jumlah FROM trecordlabel";
        return $this->db->query($sql)->row();
    }

    public function totalAdmin(){
        $sql = "SELECT  COUNT(*) as jumlah FROM tadmin";
        return $this->db->query($sql)->row();
    }

    public function totalArtist(){
        $sql = "SELECT COUNT(*) as jumlah FROM tartist";
        return $this->db->query($sql)->row();
    }

    public function totalComposer(){
        $sql = "SELECT COUNT(*) as jumlah FROM tcomposer";
        return $this->db->query($sql)->row();
    }

    public function totalArranger(){
        $sql = "SELECT COUNT(*) as jumlah FROM tarranger";
        return $this->db->query($sql)->row();
    }
}
