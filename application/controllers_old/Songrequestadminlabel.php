<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Songrequestadminlabel extends AdminLabel_Controller {
    function __construct(){
        parent::__construct();
        $this->halaman = "songrequestadminlabel";
    }

    function index(){
       $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songrequestadminlabel/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songrequestadminlabel/index');
        }

        $config['total_rows'] = $this->songrequestadminlabel->countDataSongRequest($keyword);
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

        $totalRequest   = $this->songrequestadminlabel->totalrequest();
        $totalApprove   = $this->songrequestadminlabel->totalsongbank();
        $dataSongRequest  = $this->songrequestadminlabel->datasongrequest($offset, $dataPerPage, $keyword);
        
        $mainview   = "adminlabel/songrequestadminlabel/songrequest";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongRequest','total_data', 'totalRequest','totalApprove'));
    }

    function aksiapprove($id)
    {
        $aksi = $this->songrequestadminlabel->approvesong($id);

        if($aksi == true){
            
            $this->session->set_flashdata('sukses_aksi_approvesong', '<div class="alert alert-success" role="alert">Song successfully approved</div>');

            redirect('songrequestadminlabel');

        }
        else{
            
            $this->session->set_flashdata('error_aksi_approvesong', '<div class="alert alert-danger" role="alert">Song failed to approve</div>');
            ?>
            <script type="text/javascript">
                window.history.back();
            </script>

        <?php
        }
    }

    function aksidecline($id)
    {
        $aksi = $this->songrequestadminlabel->declinesong($id);

        if($aksi == true){
            
            $this->session->set_flashdata('sukses_aksi_approvesong', '<div class="alert alert-success" role="alert">Song successfully not to approved</div>');

            redirect('songrequestadminlabel');

        }
        else{
            
            $this->session->set_flashdata('error_aksi_approvesong', '<div class="alert alert-danger" role="alert">Song failed to approve</div>');
            ?>
            <script type="text/javascript">
                window.history.back();
            </script>

        <?php
        }
    }

    function edit($id)
    {
        $getDataEdit = $this->songrequestadminlabel->getDataEdit($id);
        $getDataArtist = $this->songrequestadminlabel->getDataArtist();
        $getDataLabel = $this->songrequestadminlabel->getDataLabel();
        $getDataComposer = $this->songrequestadminlabel->getDataComposer();
        
        $mainview   = 'admin/songrequestadminlabel/edit';
        $halaman    = $this->halaman;
        
        $this->load->view('template',compact('mainview','halaman','getDataEdit', 'getDataArtist', 'getDataLabel','getDataComposer'));
    }

    function aksiedit()
    {
        
        $id = $this->input->post('id', true);

        $data = $this->songrequestadminlabel->ubahDataSongrequest();

        if($data){
            $this->session->set_flashdata('sukses_edit_song_request', '<div class="alert alert-success" role="alert">Song data updated successfully</div>');
        } else {
            $this->session->set_flashdata('gagal_edit_song_request', '<div class="alert alert-danger" role="alert">Song data failed to update</div>');
        }      
        
        redirect('songrequestadminlabel/edit/'.$id);
    }
}