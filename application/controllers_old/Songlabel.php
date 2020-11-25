<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//controller untuk halaman artist
class Songlabel extends Label_Controller {

    function __construct(){
        parent::__construct();
        $this->halaman = "songlabel";
    }

    function index(){
        $data       = $this->songlabel->getData($this->session->userdata('recordLabelId'));
        $mainview   = "label/song/song";
        $halaman    = $this->halaman;
        $this->load->view('template',compact('halaman','mainview','data'));
    }

    function daftarlagu($artistId){
        $recordLabelId  = $this->session->userdata('recordLabelId');
        $returnData     = self::cekArtist($recordLabelId, $artistId);
        if($returnData == false){
            redirect(base_url('songlabel/index'));
        }
        $data       = $this->songlabel->getDataLagu($artistId,$recordLabelId);
        $mainview   = "label/song/daftarlagu";
        $halaman    = $this->halaman;
        $this->load->view('template',compact('halaman','mainview','data'));
    }

    function cekArtist($recordLabelId, $artistId){
        $data   = $this->songlabel->cekArtist($recordLabelId, $artistId);
        return $data;
    }


    function content($laguId){
        $recordLabelId  = $this->session->userdata('recordLabelId');
        $returnData     = self::cekLagu($recordLabelId, $laguId);
        if($returnData == false){
            redirect(base_url('songlabel/index'));
        }
        if ($_POST) {
            $tanggal_awal  = $this->input->post('tanggalcontent')."-01";
            $waktu = strtotime($this->input->post('tanggalcontent')."-01");
            $tanggal_akhir = date('Y-m-d', strtotime('+1 month', $waktu));
        }
        else {
            $tanggal_awal   = date('Y-m-01');
            $now    = strtotime(date("Y-m-01"));
            $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $now));
        }
        $data       = $this->songlabel->getDetailLagu($laguId);
        $recorder   = $this->songlabel->recorder($laguId,$tanggal_awal,$tanggal_akhir);
        $liker      = $this->songlabel->liker($laguId,$tanggal_awal,$tanggal_akhir);
        $viewer     = $this->songlabel->viewer($laguId,$tanggal_awal,$tanggal_akhir);
        $mainview   = "label/song/content";
        $halaman    = $this->halaman;
        $this->load->view('template',compact('halaman','mainview','data','recorder','liker','viewer'));
    }

    function cekLagu($recordLabelId, $laguId){
        $data   = $this->songlabel->cekLagu($recordLabelId, $laguId);
        return $data;

    }

}