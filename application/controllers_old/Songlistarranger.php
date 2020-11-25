<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songlistarranger extends Arranger_Controller{
    
    function __construct()
    {
        parent::__construct();
        $this->halaman = "songlistarranger";
    }

    function index(){
        $this->load->library('pagination');

        $url = base_url('songlistarranger/index');

        $config['total_rows'] = $this->songlistarranger->countDataSongList($this->session->userdata('arrangerId'));
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

        $dataSongList  = $this->songlistarranger->getAllDataSongList($this->session->userdata('arrangerId'),$offset, $dataPerPage);

        $mainview = "arranger/songlistarranger/songlistarranger";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongList','total_data'));
    }

}