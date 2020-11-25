<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songbankadmin extends Admin_Controller{
    function __construct()
    {
        parent::__construct();
        $this->halaman = 'Songbankadmin';
    }

    function index(){
        // librari untuk pagination
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        //cek apakah ada request penacrian
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songbankadmin/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songbankadmin/index');
        }

        $config['total_rows'] = $this->songbankadmin->countDataSongbank($keyword);
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

        if ($_POST) {
            $awal  = $this->input->post('tanggalsonguser')."-01";
            $waktu = strtotime($this->input->post('tanggalsonguser')."-01");
            $akhir = date('Y-m-d', strtotime('+1 month', $waktu));
        } else {
            $awal   = date('Y-m-01');
            $now    = strtotime(date("Y-m-01"));
            $akhir  = date('Y-m-d', strtotime('+1 month', $now));
        }

        $total_data = $config['total_rows'];
        $totalUser  = $this->songbankadmin->getAllUser();

        $dataSongbank  = $this->songbankadmin->getAllDataSongbank($awal, $akhir, $offset, $dataPerPage, $keyword);

        $mainview   = "admin/songbank/songbank";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongbank','total_data', 'totalUser','awal','akhir'));
    }

    function edit($songId)
    {
        $getDataEdit = $this->songbankadmin->getDataEdit($songId);
        if($getDataEdit == NULL){
            redirect(base_url('admin/songbank/index'));
        }
        $getArtist           = $this->songbankadmin->getAtist();
        $getLabel            = $this->songbankadmin->getLabel();
        $getComposer         = $this->songbankadmin->getComposer();
        $getArranger         = $this->songbankadmin->getArranger();
        $halaman             = $this->halaman;
        $mainview            = 'admin/songbank/edit';
        $this->load->view('template', compact('halaman','mainview','getDataEdit','getArtist','getLabel','getComposer','getArranger'));
    }

    function aksiedit()
    {
        $this->songbankadmin->ubahDataSongBank();

        $this->session->set_flashdata('sukses_aksi_editsongbank', '<div class="alert alert-success" role="alert">Song bank data has been successfully updated</div>');
        
        redirect('songbankadmin/edit/'. $this->input->post('id', true));
    }
}

/**
 * Created by PhpStorm.
 * User: subki
 * Date: 27/11/2017
 * Time: 10:50
 */