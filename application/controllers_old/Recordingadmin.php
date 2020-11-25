<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Recordingadmin extends Admin_Controller {
    function __construct(){
        parent::__construct();
        $this->halaman = "recordingadmin";
    }

    function index(){
        // Library untuk pagination
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('recordingadmin/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('recordingadmin/index');
        }

        $config['total_rows'] = $this->recordingadmin->countDataRecording($keyword);
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

        $dataRecording  = $this->recordingadmin->getAllDataRecording($offset, $dataPerPage, $keyword);

        $total_data = $config['total_rows'];

        $mainview   = "admin/recording/default";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataRecording','total_data'));
    }

    function edit($recordingId){
        $dataRecordingEdit  = $this->recordingadmin->getDataRecordingEdit($recordingId);
        
        if($dataRecordingEdit == NULL){
            redirect(base_url('admin/recording/index'));
        }

        $halaman        = $this->halaman;
        $mainview       = 'admin/recording/form';
        $this->load->view('template', compact('halaman','mainview','dataRecordingEdit'));
    }

    function aksiedit(){
        if($this->input->post("aksi") == "edit"){
            $recordingId    = $this->input->post('id');
            $status         = $this->input->post('status');
            $aksi           =  $this->recordingadmin->aksiedit($recordingId, $status);

            if($aksi == true){
                $this->session->set_flashdata('sukses_aksi_edit', 'Berhasil Memasukkan Data');
                redirect(base_url('recordingadmin/index'));
            }
            else{
                $this->session->set_flashdata('error_aksi_edit', 'Gagal Memasukkan Data');
                ?>
                <script type="text/javascript">
                    window.history.back();
                </script>

                <?php
            }

        }
    }
}