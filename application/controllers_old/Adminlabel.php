<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//controller untuk halaman artist
class Adminlabel extends Label_Controller {
    function __construct()
    {
        parent::__construct();
        $this->halaman = "adminlabel";
    }

    function index(){
        $data     = $this->adminlabel->getArtist($this->session->userdata('recordLabelId'));
        $mainview = "label/artist/artist";
        $halaman = $this->halaman;
        $this->load->view('template',compact('halaman','mainview','data'));
    }
}