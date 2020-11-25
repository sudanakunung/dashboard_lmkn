<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mainscreencomposer extends Composer_Controller {
   	function __construct()
    {
        parent::__construct();
        $this->halaman = "mainscreencomposer";
    }

    function index(){
        $totalUserMydio     = $this->mainscreencomposer->totalUserMYDIO();
        $jumlahSong         = $this->mainscreencomposer->jumlahSong($this->session->userdata('composerId'));
        $statistikRecorder  = $this->mainscreencomposer->statistikRecorder($this->session->userdata('composerId'));
        $statistikLiker     = $this->mainscreencomposer->statistikLiker($this->session->userdata('composerId'));
        $statistikViewer    = $this->mainscreencomposer->statistikViewer($this->session->userdata('composerId'));
        $mainview = "composer/mainscreen/mainscreen";
        $halaman = $this->halaman;
        $this->load->view('template',compact('halaman','mainview','totalUserMydio','jumlahSong','statistikRecorder','statistikLiker','statistikViewer'));
    }
}