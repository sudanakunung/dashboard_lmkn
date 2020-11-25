<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {
    function __construct()
    {
        parent::__construct();
        $this->halaman = "MainScreen";

    }

    function index(){
        $this->load->view('template');
    }
}