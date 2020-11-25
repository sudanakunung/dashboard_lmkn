<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardadminlabel extends AdminLabel_Controller {
    function __construct(){
        parent::__construct();
        $this->halaman = "dashboardadminlabel";
    }

    function index(){
        $totalUser      = $this->dashboardadminlabel->totaluser();
        $totalLagu      = $this->dashboardadminlabel->totalLagu();
        $totalAdmin     = $this->dashboardadminlabel->totalAdmin();
        $totalLabel    = $this->dashboardadminlabel->totalLabel();
        $halaman        = $this->halaman;
        $mainview       = 'adminlabel/dashboard/dashboard';
        $this->load->view('template', compact('halaman','mainview','totalUser','totalLagu','totalAdmin','totalLabel'));
    }
}