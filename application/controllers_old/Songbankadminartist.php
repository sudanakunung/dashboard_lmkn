
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Songbankadminartist extends AdminArtist_Controller{
    function __construct()
    {
        parent::__construct();
        $this->halaman = 'songbankadminartist';
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
            $url = base_url('songbankadminartist/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songbankadminartist/index');
        }

        $config['total_rows'] = $this->songbankadminartist->countDataSongbank($keyword);
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
        $totalUser  = $this->songbankadminartist->getAllUser();

        $dataSongbank  = $this->songbankadminartist->getAllDataSongbank($awal, $akhir, $offset, $dataPerPage, $keyword);

        $mainview   = 'adminartist/songbank/songbank';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongbank','total_data', 'totalUser','awal','akhir'));
    }

    function grafik(){
        $halaman        = $this->halaman;
        $mainview       = 'adminartist/songbank/grafik';
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

        $informasiSong       = $this->songbankadminartist->getDataSong($songId);
        $infoGrafikRecorder  = $this->songbankadminartist->getGrafikRecorder($songId, $tanggal_awal, $tanggal_akhir);
        $infoGrafikLike      = $this->songbankadminartist->getGrafikLike($songId, $tanggal_awal, $tanggal_akhir);
        $infoGrafikView      = $this->songbankadminartist->getGrafikView($songId, $tanggal_awal, $tanggal_akhir);

        $this->load->view('template', compact('halaman', 'mainview', 'informasiSong','infoGrafikRecorder','infoGrafikLike','infoGrafikView'));
    }

    function tambah()
    {
        $halaman        = $this->halaman;
        $mainview       = 'adminartist/songbank/tambah';
        $getArtistData  = $this->songbankadminartist->getArtistData();
        $this->load->view('template', compact('halaman', 'mainview', 'getArtistData'));
    }

    function getDataSongArtist(){
        $artistId = $this->input->post('artistId');
        $songsdata = $this->songbankadminartist->getSongArtist($artistId);
        
        $html = ''.buka_tabel_datatable(array("Select", "ID", "Name", "Artist"), $no_action = false).'';
        $no = 1;

        foreach ($songsdata as $lagu){
            $html .= ''.isi_tabel_admin($no, array('<input type="checkbox" class="song_checkbox" value="'.$lagu->songId.'" name="song_checkbox[]">',$lagu->songId,$lagu->title, $lagu->artistName), "", "", $lagu->songId, false, false).'';
            $no++;
        }

        $html .= ''.tutup_tabel().'';

        $html .='<script type="text/javascript">
                    $(document).ready(function(){
                        $(".table-data").dataTable();
                    });
                </script>';

        echo $html;
    }

    function aksitambah()
    {
        $aksi = $this->songbankadminartist->simpansongrequest();
        if($aksi == true){
            // $this->session->set_flashdata('sukses_aksi_tambahsonguser', '<div class="alert alert-success" role="alert">Successfully added song data, the next step is to wait for approval from the admin</div>');

            $this->session->set_flashdata('sukses_aksi_tambahsonguser', '<div class="alert alert-success" role="alert">Successfully added song data to song bank</div>');

            redirect('songbankadminartist');
        }
        else{
            $this->session->set_flashdata('error_aksi_tambahsonguser', '<div class="alert alert-danger" role="alert">Song data failed to add</div>');
            ?>
            <script type="text/javascript">
                window.history.back();
            </script>

            <?php
        }
    }
}

/**
 * Created by PhpStorm.
 * User: subki
 * Date: 27/11/2017
 * Time: 10:50
 */