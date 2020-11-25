<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardadminartist extends AdminArtist_Controller {
    function __construct(){
        parent::__construct();
        $this->halaman = "dashboardadminartist";
    }

    function index(){
        $totalUser      = $this->dashboardadminartist->totaluser();
        $totalLagu      = $this->dashboardadminartist->totalLagu();
        $totalAdmin     = $this->dashboardadminartist->totalAdmin();
        $totalArtist    = $this->dashboardadminartist->totalArtist();
        $halaman        = $this->halaman;
        $mainview       = 'adminartist/dashboard/dashboard';
        $this->load->view('template', compact('halaman','mainview','totalUser','totalLagu','totalAdmin','totalArtist'));
    }
}