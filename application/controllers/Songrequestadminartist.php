<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Songrequestadminartist extends AdminArtist_Controller {
    function __construct(){
        parent::__construct();
        $this->halaman = "songrequestadminartist";
    }

    function index(){
       $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songrequestadminartist/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songrequestadminartist/index');
        }

        $config['total_rows'] = $this->songrequestadminartist->countDataSongRequest($keyword);
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

        $totalRequest   = $this->songrequestadminartist->totalrequest();
        $totalApprove   = $this->songrequestadminartist->totalsongbank();
        $dataSongRequest  = $this->songrequestadminartist->datasongrequest($offset, $dataPerPage, $keyword);
        
        $mainview   = "adminartist/songrequestadminartist/songrequest";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongRequest','total_data', 'totalRequest','totalApprove'));
    }

    function aksiapprove($id)
    {
        $aksi = $this->songrequestadminartist->approvesong($id);

        if($aksi == true){
            
            $this->session->set_flashdata('sukses_aksi_approvesong', '<div class="alert alert-success" role="alert">Song successfully approved</div>');

            redirect('songrequestadminartist');

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
        $aksi = $this->songrequestadminartist->declinesong($id);

        if($aksi == true){
            
            $this->session->set_flashdata('sukses_aksi_approvesong', '<div class="alert alert-success" role="alert">Song successfully not to approved</div>');

            redirect('songrequestadminartist');

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
        $getDataEdit = $this->songrequestadminartist->getDataEdit($id);
        $getDataArtist = $this->songrequestadminartist->getDataArtist();
        $getDataLabel = $this->songrequestadminartist->getDataLabel();
        $getDataComposer = $this->songrequestadminartist->getDataComposer();
        
        $mainview   = 'admin/songrequestadminartist/edit';
        $halaman    = $this->halaman;
        
        $this->load->view('template',compact('mainview','halaman','getDataEdit', 'getDataArtist', 'getDataLabel','getDataComposer'));
    }

    function aksiedit()
    {
        
        $id = $this->input->post('id', true);

        $data = $this->songrequestadminartist->ubahDataSongrequest();

        if($data){
            $this->session->set_flashdata('sukses_edit_song_request', '<div class="alert alert-success" role="alert">Song data updated successfully</div>');
        } else {
            $this->session->set_flashdata('gagal_edit_song_request', '<div class="alert alert-danger" role="alert">Song data failed to update</div>');
        }      
        
        redirect('songrequestadminartist/edit/'.$id);
    }
}