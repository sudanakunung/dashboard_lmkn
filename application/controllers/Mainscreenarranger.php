<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mainscreenarranger extends Arranger_Controller {
    function __construct()
    {
        parent::__construct();
        $this->halaman = "mainscreenarranger";
    }

    function index(){
        $totalUserMydio     = $this->mainscreenarranger->totalUserMYDIO();
        $jumlahSong         = $this->mainscreenarranger->jumlahSong($this->session->userdata('arrangerId'));
        $statistikRecorder  = $this->mainscreenarranger->statistikRecorder($this->session->userdata('arrangerId'));
        $statistikLiker     = $this->mainscreenarranger->statistikLiker($this->session->userdata('arrangerId'));
        $statistikViewer    = $this->mainscreenarranger->statistikViewer($this->session->userdata('arrangerId'));
        $mainview = "arranger/mainscreen/mainscreen";
        $halaman = $this->halaman;
        $this->load->view('template',compact('halaman','mainview','totalUserMydio','jumlahSong','statistikRecorder','statistikLiker','statistikViewer'));
    }
}