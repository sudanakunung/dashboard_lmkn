<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Labeladmin extends Admin_Controller {
    function __construct()
    {
        parent::__construct();
        $this->halaman = "labeladmin";

    }

    function index(){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('labeladmin/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('labeladmin/index');
        }

        $config['total_rows'] = $this->labeladmin->countDataLabel($keyword);
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

        $dataLabel  = $this->labeladmin->getDataLabel($offset, $dataPerPage, $keyword);

        $mainview   = "admin/label/default";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataLabel','total_data'));
    }

    function tambah(){
        $mainview   = "admin/label/tambah";
        $halaman    = $this->halaman;
        $this->load->view('template',compact('mainview','halaman','dataLabel'));
    }

    function aksitambah(){
        if($this->input->post('aksi') == "tambah"){
            $recordLabel = $this->input->post('recordLabel');
            $aksi = $this->labeladmin->tambahlabel($recordLabel);
            if($aksi == true){
                $this->session->set_flashdata('sukses_aksi_tambahlabel', 'Berhasil Memasukkan Data');
                redirect(base_url('labeladmin/index'));
            }
            else{
                $this->session->set_flashdata('error_aksi_tambahlabel', 'Gagal Memasukkan Data');
                ?>
                <script type="text/javascript">
                    window.history.back();
                </script>

                <?php
            }
        }
    }

    function edit($labelId){
        $mainview   = "admin/label/edit";
        $halaman    = $this->halaman;
        $dataEditLabel  = $this->labeladmin->editlabel($labelId);
        if($dataEditLabel == NULL){
            redirect(base_url('labeladmin/index'));
        }
        $this->load->view('template',compact('mainview','halaman','dataEditLabel'));
    }

    function aksiedit(){
        if($this->input->post('aksi') == "edit"){
            $labelId     = $this->input->post('id');
            $recordLabel = $this->input->post('recordLabel');
            $aksi = $this->labeladmin->aksieditlabel($labelId,$recordLabel);
            if($aksi == true){
                $this->session->set_flashdata('sukses_aksi_editlabel', 'Berhasil Merubah Data');
                redirect(base_url('labeladmin/index'));
            }
            else{
                $this->session->set_flashdata('error_aksi_editlabel', 'Gagal Merubah Data');
                ?>
                <script type="text/javascript">
                    window.history.back();
                </script>

                <?php
            }
        }
    }

    function aksihapus($labelId){
        $aksi = $this->labeladmin->aksihapuslabel($labelId);
        if($aksi == true){
            $this->session->set_flashdata('sukses_aksi_hapuslabel', 'Berhasil Hapus Data');
            redirect(base_url('labeladmin/index'));
        }
        else{
            $this->session->set_flashdata('error_aksi_hapuslabel', 'Gagal Hapus Data');
            redirect(base_url('labeladmin/index'));
        }
    }
}