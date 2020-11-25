<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//controller untuk halaman artist
class Mainscreen extends Artist_Controller {
    function __construct()
    {
        parent::__construct();
        $this->halaman = "mainscreen";
    }

    function index(){
        $totalUserMydio     = $this->mainscreen->totalUserMYDIO();
        $jumlahSong         = $this->mainscreen->jumlahSong($this->session->userdata('artistId'));
        $statistikRecorder  = $this->mainscreen->statistikRecorder($this->session->userdata('artistId'));
        $statistikLiker     = $this->mainscreen->statistikLiker($this->session->userdata('artistId'));
        $statistikViewer    = $this->mainscreen->statistikViewer($this->session->userdata('artistId'));
        $mainview = "artist/mainscreen/mainscreen";
        $halaman = $this->halaman;
        $this->load->view('template',compact('halaman','mainview','totalUserMydio','jumlahSong','statistikRecorder','statistikLiker','statistikViewer'));
    }
}