<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arranger extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->halaman = "arranger";
    }

    function index(){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('arranger/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('arranger/index');
        }

        $config['total_rows'] = $this->arranger->countDataArranger($keyword);
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

        $dataArranger  = $this->arranger->getDataArranger($offset, $dataPerPage, $keyword);

        $mainview   = 'admin/arranger/default';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataArranger','total_data'));
    }

    function edit($id)
    {
        $get_arranger = $this->arranger->getArrangerById($id);

        $dataEditArranger = [
            'arrangerId' => $get_arranger['arrangerId'],
            'arranger' => $get_arranger['arranger'],
            'referral' => $get_arranger['referral']
        ];
        
        $mainview   = "admin/arranger/edit";
        $halaman    = $this->halaman;
        
        $this->load->view('template',compact('mainview','halaman','dataEditArranger'));
    }

    function tambah(){
        $halaman        = $this->halaman;
        $mainview       = 'admin/arranger/tambah';
        $this->load->view('template', compact('halaman','mainview'));
    }

    function aksitambah(){
        $aksi = $this->arranger->tambahDataArranger();
            
        $this->session->set_flashdata('sukses_aksi_tambaharranger', '<div class="alert alert-success" role="alert">Success to add Arranger</div>');

        redirect(base_url('arranger/index'));
    }

    function aksiedit()
    {
        $this->arranger->ubahDataArranger();

        $this->session->set_flashdata('sukses_aksi_editarranger', '<div class="alert alert-success" role="alert">Data updated successfully</div>');
        
        redirect('arranger/index');
    }

    public function hapus_arranger($id)
    {
        $this->arranger->hapusDataArranger($id);

        $this->session->set_flashdata('sukses_aksi_hapusarranger', '<div class="alert alert-success" role="alert">Data successfully deleted</div>');

        redirect('arranger/index');
    }
}