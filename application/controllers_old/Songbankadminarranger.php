<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songbankadminarranger extends AdminArranger_Controller{
    function __construct()
    {
        parent::__construct();
        $this->halaman = 'songbankadminarranger';
    }

    function index()
    {
        // librari untuk pagination
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        //cek apakah ada request penacrian
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songbankadminarranger/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songbankadminarranger/index');
        }

        $config['total_rows'] = $this->songbankadminarranger->countDataSongbank($keyword);
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
        $totalUser  = $this->songbankadminarranger->getAllUser();

        $dataSongbank  = $this->songbankadminarranger->getAllDataSongbank($awal, $akhir, $offset, $dataPerPage, $keyword);

        $mainview   = 'adminarranger/songbank/songbank';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongbank','total_data', 'totalUser','awal','akhir'));
    }

    function grafik(){
        $halaman        = $this->halaman;
        $mainview       = 'adminarranger/songbank/grafik';
        $songId         = $this->uri->segment(3);

        if ($_POST) {
            $tanggal_awal   = $this->input->post('tanggalsonguser')."-01";
            $waktu          = strtotime($this->input->post('tanggalsonguser')."-01");
            $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $waktu));
        }
        else {
            $tanggal_awal       = $this->uri->segment(4);
            if($tanggal_awal  == NULL){
                $tanggal_awal   = date('Y-m-01');
            }

            $tanggal_akhir      = $this->uri->segment(5);
            if($tanggal_akhir == NULL){
                $now            = strtotime(date("Y-m-01"));
                $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $now));
            }
        }

        $informasiSong       = $this->songbankadminarranger->getDataSong($songId);
        $infoGrafikRecorder  = $this->songbankadminarranger->getGrafikRecorder($songId, $tanggal_awal, $tanggal_akhir);
        $infoGrafikLike      = $this->songbankadminarranger->getGrafikLike($songId, $tanggal_awal, $tanggal_akhir);
        $infoGrafikView      = $this->songbankadminarranger->getGrafikView($songId, $tanggal_awal, $tanggal_akhir);

        $this->load->view('template', compact('halaman', 'mainview', 'informasiSong','infoGrafikRecorder','infoGrafikLike','infoGrafikView'));
    }

    function tambah()
    {
        $halaman        = $this->halaman;
        $mainview       = 'adminarranger/songbank/tambah';
        $getSongData    = $this->songbankadminarranger->getSongData();
        $getArrangerData  = $this->songbankadminarranger->getArrangerData();

        $this->load->view('template', compact('halaman', 'mainview', 'getSongData', 'getArrangerData'));
    }

    function aksitambah()
    {
        $aksi = $this->songbankadminarranger->simpansongrequest();
        
        if($aksi){
            $this->session->set_flashdata('sukses_aksi_tambahsonguser', '<div class="alert alert-success" role="alert">Successfully added song data to song bank</div>');
        } else {
            $this->session->set_flashdata('error_aksi_tambahsonguser', '<div class="alert alert-danger" role="alert">Song data failed to add</div>');
        }      
        
        redirect('songbankadminarranger');
    }
}

/**
 * Created by PhpStorm.
 * User: subki
 * Date: 27/11/2017
 * Time: 10:50
 */