<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardadmincomposer extends AdminComposer_Controller {
    function __construct(){
        parent::__construct();
        $this->halaman = "dashboardadmincomposer";
    }

    function index(){
        $totalUser      = $this->dashboardadmincomposer->totaluser();
        $totalLagu      = $this->dashboardadmincomposer->totalLagu();
        $totalAdmin     = $this->dashboardadmincomposer->totalAdmin();
        $totalComposer    = $this->dashboardadmincomposer->totalComposer();
        $halaman        = $this->halaman;
        $mainview       = 'admincomposer/dashboard/dashboard';
        $this->load->view('template', compact('halaman','mainview','totalUser','totalLagu','totalAdmin','totalComposer'));
    }
}