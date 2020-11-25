<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainscreenlabel extends Label_Controller {
    function __construct()
    {
        parent::__construct();
        $this->halaman = "mainscreenlabel";
    }

    function index(){
        $totalUserMydio     = $this->mainscreenlabel->totalUserMYDIO();
        $jumlahSong         = $this->mainscreenlabel->jumlahSong($this->session->userdata('recordLabelId'));
        $statistikRecorder  = $this->mainscreenlabel->statistikRecorder($this->session->userdata('recordLabelId'));
        $statistikLiker     = $this->mainscreenlabel->statistikLiker($this->session->userdata('recordLabelId'));
        $statistikViewer    = $this->mainscreenlabel->statistikViewer($this->session->userdata('recordLabelId'));
        $mainview = "label/mainscreen/mainscreen";
        $halaman = $this->halaman;
        $this->load->view('template',compact('halaman','mainview','totalUserMydio','jumlahSong','statistikRecorder','statistikLiker','statistikViewer'));
    }

    // function index(){
    //     $halaman        = $this->halaman;
    //     $mainview       = 'label/dashboard/dashboard';
    //     $totalLagu      = $this->mainscreenlabel->getTotalSong($this->session->userdata('recordLabelId'));
    //     $totalArtist    = $this->mainscreenlabel->getTotalArtist($this->session->userdata('recordLabelId'));
    //     $labelId        = $this->session->userdata('recordLabelId');
    //     $tanggal_awal   = date('Y-m-01');
    //     $now            = strtotime(date("Y-m-01"));
    //     $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $now));
    //     $topSong        = $this->mainscreenlabel->getTopSong($tanggal_awal, $tanggal_akhir, $labelId);
    //     $this->load->view('template', compact('halaman','mainview','totalLagu','totalArtist','topSong'));
    // }
}