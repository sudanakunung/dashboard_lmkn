<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardadmininstitution extends AdminInstitution_Controller {

    function __construct(){
        parent::__construct();
        $this->halaman = "dashboardadmininstitution";
    }

    function index(){
        $totalUser      = $this->dashboardadmininstitution->totalUser();
        $totalLagu      = $this->dashboardadmininstitution->totalLagu();
        $totalArtist    = $this->dashboardadmininstitution->totalArtist();
        $totalLabel     = $this->dashboardadmininstitution->totalLabel();
        $totalComposer  = $this->dashboardadmininstitution->totalComposer();
        $halaman        = $this->halaman;
        $mainview       = 'admininstitution/dashboard/dashboard';
        $this->load->view('template', compact('halaman','mainview','totalUser','totalLagu','totalArtist', 'totalLabel', 'totalComposer'));
    }
}