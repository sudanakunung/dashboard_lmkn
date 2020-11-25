<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Viewer extends Admin_Controller {
    public function __construct(){
        parent::__construct();
		    $this->halaman = "viewer";
    }

    public function index(){
		    $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('viewer/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('viewer/index');
        }

        $config['total_rows'] = $this->viewer->countDataView($keyword);
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

        $dataViewer  = $this->viewer->getAllDataViewer($offset, $dataPerPage, $keyword);

        $total_data = $config['total_rows'];

        $mainview = "admin/viewer/default";
        $halaman  = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataViewer','total_data'));
    }

    // public function jsondatatables()
    // {
    //     $jsonDataViewer  = $this->viewer->getJsonDataViewer();

    //     return $jsonDataViewer;
    // }
}