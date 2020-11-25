<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artistadmin extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->halaman = "artistadmin";
    }

    function index(){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('artistadmin/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('artistadmin/index');
        }

        $config['total_rows'] = $this->artistadmin->countDataArtist($keyword);
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

        $dataArtist  = $this->artistadmin->getDataArtist($offset, $dataPerPage, $keyword);

        $mainview   = 'admin/artist/default';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataArtist','total_data'));
    }

    function edit($artistId){
        $getData        = $this->artistadmin->getDataEdit($artistId);
        $halaman        = $this->halaman;
        $mainview       = 'admin/artist/form';
        $this->load->view('template', compact('halaman','mainview','getData'));

    }

    function tambah(){
        $halaman        = $this->halaman;
        $mainview       = 'admin/artist/form_tambah';
        $this->load->view('template', compact('halaman','mainview'));
    }

    function aksitambah(){

        $name       = $_POST['name'];
        $referral   = $_POST['referral'];
        $userId     = $_POST['userId'];
        $lembaga     = $_POST['lembaga'];

        $aksi = $this->artistadmin->inputData($name,$referral,$userId,$lembaga);

        if($aksi == true){
            $this->session->set_flashdata('sukses_aksi', '<div class="alert alert-success" role="alert">Data successfully added</div>');

            redirect(base_url('artistadmin/index'));
        }
        else{
            $this->session->set_flashdata('error_aksi', '<div class="alert alert-danger" role="alert">Data failed to add</div>');
            ?>

            <script type="text/javascript">
                window.history.back();
            </script>

            <?php
        }
    }

    function aksiedit(){
        $artistId   = $_POST['id'];
        $name       = $_POST['name'];
        $referral   = $_POST['referral'];
        $userId     = $_POST['userId'];
        $lembaga     = $_POST['lembaga'];

        $aksi = $this->artistadmin->editData($artistId,$name,$referral,$userId,$lembaga);
        
        if($aksi == true){
            $this->session->set_flashdata('sukses_aksi', '<div class="alert alert-success" role="alert">Data successfully updated</div>');

            redirect(base_url('artistadmin/index'));
        }
        else{
            $this->session->set_flashdata('error_aksi', '<div class="alert alert-danger" role="alert">Data failed to update</div>');

            ?>
            <script type="text/javascript">
                window.history.back();
            </script>
            <?php
        }
    }

    function hapus($artistId){
        $aksi = $this->artistadmin->hapus($artistId);
        if($aksi == true){
            $this->session->set_flashdata('error_aksi', '<div class="alert alert-danger" role="alert">Data successfully deleted</div>');

            redirect(base_url('artistadmin/index'));
        }
        else{
            $this->session->set_flashdata('error_aksi', '<div class="alert alert-danger" role="alert">Data failed to delete</div>');

            ?>
            <script type="text/javascript">
                window.history.back();
            </script>

            <?php
        }
    }
}