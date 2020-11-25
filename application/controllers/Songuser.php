<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songuser extends Artist_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->halaman = 'songuser';
    }

    public function index(){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songuser/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songuser/index');
        }

        $config['total_rows'] = $this->songuser->countDataSongUser($this->session->userdata('artistId'), $keyword);
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
            $awal  = $this->input->post('tanggalsonguser')."-01";
            $waktu = strtotime($this->input->post('tanggalsonguser')."-01");
            $akhir = date('Y-m-d', strtotime('+1 month', $waktu));
        } else {
            $awal   = date('Y-m-01');
            $now    = strtotime(date("Y-m-01"));
            $akhir  = date('Y-m-d', strtotime('+1 month', $now));
        }
        $dataSongUser  = $this->songuser->getAllDataSongUser($this->session->userdata('artistId'), $awal, $akhir, $offset, $dataPerPage, $keyword);
        $totalUser  = $this->songuser->getAllUser();
        

        $mainview   = 'artist/songuser/songuser';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongUser','total_data','awal','akhir','totalUser'));
    }

    public function grafik(){
        $halaman        = $this->halaman;
        $mainview       = 'artist/songuser/grafik';
        $artistId       = $this->session->userdata('artistId');
        $songId         = $this->uri->segment(3);

        //periksa songId punya artist atau bukan
        $cekLagu = $this->songuser->cekSong($this->session->userdata('artistId'),$songId);

        if($cekLagu == false){
            redirect(base_url('songuser'));
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

        $informasiSong       = $this->songuser->getDataSong($artistId, $songId);
        $infoGrafikRecorder  = $this->songuser->getGrafikRecorder($songId, $tanggal_awal, $tanggal_akhir);
        $infoGrafikLike      = $this->songuser->getGrafikLike($songId, $tanggal_awal, $tanggal_akhir);
        $infoGrafikView      = $this->songuser->getGrafikView($songId, $tanggal_awal, $tanggal_akhir);

        $this->load->view('template', compact('halaman', 'mainview', 'informasiSong','infoGrafikRecorder','infoGrafikLike','infoGrafikView'));
    }

    public function tambah()
    {
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songuser/tambah').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songuser/tambah');
        }

        $config['total_rows'] = $this->songuser->countDataSongUserToAdd($this->session->userdata('nameArtist'), $keyword);
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

        $dataSongUserToAdd = $this->songuser->getDataSongUserToAdd($this->session->userdata('nameArtist'), $offset, $dataPerPage, $keyword);

        $mainview   = 'artist/songuser/tambah';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongUserToAdd','total_data'));
    }

    function aksitambah()
    {
        $artistId = $this->uri->segment(3);
        $songId = $this->uri->segment(4);

        $aksi = $this->songuser->simpansonguser($artistId, $songId);
        
        if($aksi == true){
            $this->session->set_flashdata('sukses_aksi_tambahsonguser', '<div class="alert alert-success" role="alert">Successfully added song data, the next step is to wait for approval from the LMK</div>');

            redirect('songuser/tambah');
        }
        else{
            $this->session->set_flashdata('error_aksi_tambahsonguser', '<div class="alert alert-danger" role="alert">Song data failed to add</div>');

            redirect('songuser/tambah');

        }
    }
}

/**
 * Created by PhpStorm.
 * User: subki
 * Date: 27/11/2017
 * Time: 10:50
 */