<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banneradminarranger extends AdminArranger_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->halaman = "banneradminarranger";
    }

    function index(){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('banneradminarranger/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('banneradminarranger/index');
        }

        $config['total_rows'] = $this->banneradminarranger->countDataBanner($keyword);
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

        $dataBanner  = $this->banneradminarranger->getDataBanner($offset, $dataPerPage, $keyword);

        $mainview   = 'adminarranger/banner/default';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataBanner','total_data'));
    }
}
/**
 * Created by PhpStorm.
 * User: subki
 * Date: 15/02/2018
 * Time: 12:36
 */