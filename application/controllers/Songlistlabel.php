<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songlistlabel extends label_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->halaman = "songlistlabel";
    }

    function index(){
        $this->load->library('pagination');

        $url = base_url('songlistlabel/index');

        $config['total_rows'] = $this->songlistlabel->countDataSongList($this->session->userdata('recordLabelId'));
        $config['enable_query_strings'] = true;
        $config['page_query_string'] = true;
        $config['query_string_segment'] = 'offset';
        $config['base_url'] = $url;
        $config['per_page'] = 10;

        $this->pagination->initialize($config);
        //End Pagination

        $start = $this->input->get('offset', true);

        if($start){
            $offset = $start;
        } else {
            $offset = 0;
        }
    
        $dataPerPage = $config['per_page'];
        $total_data = $config['total_rows'];

        $dataSongList  = $this->songlistlabel->getAllDataSongList($this->session->userdata('recordLabelId'),$offset, $dataPerPage);

        $mainview = "label/songlistlabel/songlistlabel";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongList','total_data'));
    }

}