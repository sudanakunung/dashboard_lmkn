<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Recordingadminlabel extends AdminLabel_Controller {
    function __construct(){
        parent::__construct();
        $this->halaman = "recordingadminlabel";
    }

    function index(){
        // Library untuk pagination
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('recordingadminlabel/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('recordingadminlabel/index');
        }

        $config['total_rows'] = $this->recordingadminlabel->countDataRecording($keyword);
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

        $dataRecording  = $this->recordingadminlabel->getAllDataRecording($offset, $dataPerPage, $keyword);

        $mainview  = 'adminlabel/recording/default';
        $halaman   = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataRecording','total_data'));
    }
}