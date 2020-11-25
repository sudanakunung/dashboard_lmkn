<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Songrequestadmin extends Admin_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->halaman = "songrequestadmin";
    }

    public function index(){
       $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songrequestadmin/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songrequestadmin/index');
        }

        $config['total_rows'] = $this->songrequestadmin->countDataSongRequest($keyword);
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

        $totalRequest   = $this->songrequestadmin->totalrequest();
        $totalApprove   = $this->songrequestadmin->totalsongbank();
        $dataSongRequest  = $this->songrequestadmin->datasongrequest($offset, $dataPerPage, $keyword);
        

        $mainview   = "admin/songrequestadmin/songrequest";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSongRequest','total_data', 'totalRequest','totalApprove'));
    }

    public function aksiapprove($id)
    {
        $aksi = $this->songrequestadmin->approvesong($id);

        if($aksi == true){
            
            $this->session->set_flashdata('sukses_aksi_approvesong', '<div class="alert alert-success" role="alert">Song successfully approved</div>');

            redirect('songrequestadmin');

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

    public function aksidecline($id)
    {
        $aksi = $this->songrequestadmin->declinesong($id);

        if($aksi == true){
            
            $this->session->set_flashdata('sukses_aksi_approvesong', '<div class="alert alert-success" role="alert">Song successfully not to approved</div>');

            redirect('songrequestadmin');

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

    public function edit($id)
    {
        $getDataEdit = $this->songrequestadmin->getDataEdit($id);
        $getDataArtist = $this->songrequestadmin->getDataArtist();
        $getDataLabel = $this->songrequestadmin->getDataLabel();
        $getDataComposer = $this->songrequestadmin->getDataComposer();
        
        $mainview   = 'admin/songrequestadmin/edit';
        $halaman    = $this->halaman;
        
        $this->load->view('template',compact('mainview','halaman','getDataEdit', 'getDataArtist', 'getDataLabel','getDataComposer'));
    }

    public function aksiedit()
    {
        $id = $this->input->post('id', true);

        $data = $this->songrequestadmin->ubahDataSongrequest();

        if($data){
            $this->session->set_flashdata('sukses_edit_song_request', '<div class="alert alert-success" role="alert">Song data updated successfully</div>');
        } else {
            $this->session->set_flashdata('gagal_edit_song_request', '<div class="alert alert-danger" role="alert">Song data failed to update</div>');
        }      
        
        redirect('songrequestadmin/edit/'.$id);
    }
}