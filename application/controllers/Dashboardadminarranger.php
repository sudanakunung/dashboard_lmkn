<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardadminarranger extends AdminArranger_Controller {
    function __construct(){
        parent::__construct();
        $this->halaman = "dashboardadminarranger";
    }

    function index(){
        $totalUser      = $this->dashboardadminarranger->totaluser();
        $totalLagu      = $this->dashboardadminarranger->totalLagu();
        $totalAdmin     = $this->dashboardadminarranger->totalAdmin();
        $totalArranger    = $this->dashboardadminarranger->totalArranger();
        $halaman        = $this->halaman;
        $mainview       = 'adminarranger/dashboard/dashboard';
        $this->load->view('template', compact('halaman','mainview','totalUser','totalLagu','totalAdmin','totalArranger'));
    }
}