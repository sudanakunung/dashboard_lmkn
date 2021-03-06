<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//controller untuk halaman artist
class Useradminartist extends AdminArtist_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->halaman = "useradminartist";

    }
    
    function index($page = 1){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('useradminartist/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('useradminartist/index');
        }

        $config['total_rows'] = $this->useradminartist->countDataUser($keyword);
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
        $total_data  = $config['total_rows'];

        $dataUser  = $this->useradminartist->getDataUser($offset, $dataPerPage, $keyword);

        $mainview = "adminartist/user/user";
        $halaman  = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataUser','total_data'));
    }
}
