<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songuserlabel extends label_Controller{
    function __construct()
    {
        parent::__construct();
        $this->halaman = 'songuserlabel';
    }

    function index(){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songuserlabel/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songuserlabel/index');
        }

        $config['total_rows'] = $this->songuserlabel->countDataSongUser($this->session->userdata('recordLabelId'), $keyword);
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

        if ($_POST) {
            $awal  = $this->input->post('tanggalsonguserlabel')."-01";
            $waktu = strtotime($this->input->post('tanggalsonguserlabel')."-01");
            $akhir = date('Y-m-d', strtotime('+1 month', $waktu));
        } else {
            $awal   = date('Y-m-01');
            $now    = strtotime(date("Y-m-01"));
            $akhir  = date('Y-m-d', strtotime('+1 month', $now));
        }
        $dataSongUser  = $this->songuserlabel->getAllDataSongUser($this->session->userdata('recordLabelId'), $awal, $akhir, $offset, $dataPerPage, $keyword);
        $totalUser  = $this->songuserlabel->getAllUser();
        

        $mainview   = 'label/songuserlabel/songuserlabel';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongUser','total_data','awal','akhir','totalUser'));
    }

    function grafik(){
        $halaman        = $this->halaman;
        $mainview       = 'label/songuserlabel/grafik';
        $recordLabelId     = $this->session->userdata('recordLabelId');
        $songId         = $this->uri->segment(3);

        //periksa songId punya label atau bukan
        $cekLagu = $this->songuserlabel->cekSong($this->session->userdata('recordLabelId'),$songId);

        if($cekLagu == false){
            redirect(base_url('songuserlabel'));
        }

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

        $informasiSong       = $this->songuserlabel->getDataSong($recordLabelId, $songId);
        $infoGrafikRecorder  = $this->songuserlabel->getGrafikRecorder($songId, $tanggal_awal, $tanggal_akhir);
        $infoGrafikLike      = $this->songuserlabel->getGrafikLike($songId, $tanggal_awal, $tanggal_akhir);
        $infoGrafikView      = $this->songuserlabel->getGrafikView($songId, $tanggal_awal, $tanggal_akhir);

        $this->load->view('template', compact('halaman', 'mainview', 'informasiSong','infoGrafikRecorder','infoGrafikLike','infoGrafikView'));
    }

    public function tambah()
    {
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songuserlabel/tambah').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songuserlabel/tambah');
        }

        $config['total_rows'] = $this->songuserlabel->countDataSongUserToAdd($this->session->userdata('recordLabelId'), $keyword);
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

        $dataSongUserToAdd = $this->songuserlabel->getDataSongUserToAdd($this->session->userdata('recordLabelId'), $offset, $dataPerPage, $keyword);

        $mainview   = 'label/songuserlabel/tambah';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongUserToAdd','total_data'));
    }

    function aksitambah()
    {
        $recordLabelId = $this->uri->segment(3);
        $songId = $this->uri->segment(4);

        $aksi = $this->songuserlabel->simpansonguser($recordLabelId, $songId);
        
        if($aksi == true){
            $this->session->set_flashdata('sukses_aksi_tambahsonguser', '<div class="alert alert-success" role="alert">Successfully added song data, the next step is to wait for approval from the LMK</div>');
        }
        else{
            $this->session->set_flashdata('error_aksi_tambahsonguser', '<div class="alert alert-danger" role="alert">Song data failed to add</div>');
        }

        redirect('songuserlabel/tambah');

    }
}