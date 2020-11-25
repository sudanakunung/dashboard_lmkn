<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ArtistAdmin extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->halaman = "artistadmin";
    }

    function index(){
        $getData        = $this->artistadmin->getData();
        $halaman        = $this->halaman;
        $mainview       = 'admin/artist/default';
        $this->load->view('template', compact('halaman','mainview','getData'));
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
        if($this->input->post('aksi') == "tambah"){
            $name       = $_POST['name'];
            $referral   = $_POST['referral'];
            $userId     = $_POST['userId'];


            $aksi = $this->artistadmin->inputData($name,$referral,$userId);
            if($aksi == true){
                $this->session->set_flashdata('sukses_aksi', 'Berhasil Memasukkan Data');
                redirect(base_url('artistadmin/index'));
            }
            else{
                $this->session->set_flashdata('error_aksi', 'Gagal Memasukkan Data');
                ?>
                <script type="text/javascript">
                    window.history.back();
                </script>

                <?php
            }
        }
    }

    function aksiedit(){
        if($this->input->post('aksi') == "edit"){
            $artistId   = $_POST['id'];
            $name       = $_POST['name'];
            $referral   = $_POST['referral'];
            $userId     = $_POST['userId'];

            $aksi = $this->artistadmin->editData($artistId,$name,$referral,$userId);
            if($aksi == true){
                $this->session->set_flashdata('sukses_aksi', 'Berhasil Memasukkan Data');
                redirect(base_url('artistadmin/index'));
            }
            else{
                $this->session->set_flashdata('error_aksi', 'Gagal Memasukkan Data');
                ?>
                <script type="text/javascript">
                    window.history.back();
                </script>

                <?php
            }
        }
    }

    function hapus($artistId){
        $aksi = $this->artistadmin->hapus($artistId);
        if($aksi == true){
            $this->session->set_flashdata('sukses_aksi_hapusadmin', 'Berhasil Hapus Data');
            redirect(base_url('artistadmin/index'));
        }
        else{
            $this->session->set_flashdata('error_aksi_hapusadmin', 'Gagal Hapus Data');
            ?>
            <script type="text/javascript">
                window.history.back();
            </script>

            <?php
        }
    }
}