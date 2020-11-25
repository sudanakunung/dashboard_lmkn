<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardadmin extends Admin_Controller {
    function __construct(){
        parent::__construct();
        $this->halaman = "dashboardadmin";
    }

    function index(){
        $totalUser      = $this->dashboardadmin->totaluser();
        $totalLagu      = $this->dashboardadmin->totalLagu();
        $totalLabel     = $this->dashboardadmin->totalLabel();
        $totalAdmin     = $this->dashboardadmin->totalAdmin();
        $totalArtist    = $this->dashboardadmin->totalArtist();
        $totalComposer  = $this->dashboardadmin->totalComposer();
        $totalArranger  = $this->dashboardadmin->totalArranger();
        $halaman        = $this->halaman;
        $mainview       = 'admin/dashboard/dashboard';
        $this->load->view('template', compact('halaman','mainview','totalUser','totalLagu','totalLabel','totalAdmin','totalArtist','totalComposer','totalArranger'));
    }
}