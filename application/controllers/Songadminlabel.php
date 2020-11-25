<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//controller untuk halaman artist
class Songadminlabel extends AdminLabel_Controller {

    function __construct(){
        parent::__construct();
        $this->halaman = "songadminlabel";
    }

    function index(){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songadminlabel/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songadminlabel/index');
        }

        $config['total_rows'] = $this->songadminlabel->countDataSong($keyword);
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

        $dataSong  = $this->songadminlabel->getDataSong($offset, $dataPerPage, $keyword);

        $mainview   = "adminlabel/song/default";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSong','total_data'));
    }

    public function edit($songId)
    {
        $dataEditSong = $this->songadminlabel->getDataEditSong($songId);
        $dataArtist = $this->songadminlabel->getDataArtist();
        $dataLabel = $this->songadminlabel->getDataLabel();
        $dataArranger = $this->songadminlabel->getDataArranger();
        $dataComposer = $this->songadminlabel->getDataComposer();
        $mainview = "adminlabel/song/edit";
        $halaman  = $this->halaman;
        $this->load->view('template',compact('halaman','mainview','dataEditSong','dataArtist','dataLabel','dataArranger','dataComposer'));
    }

    public function aksiedit()
    {

        $songId = $this->input->post("id");
        $judul = $this->input->post("judul");
        $artistId = $this->input->post("artistId");
        $recordLabelId = $this->input->post("recordLabelId");
        $arrangerId = $this->input->post("arrangerId");
        $composerId = $this->input->post("composerId");
        $description= $this->input->post("description");
            
        if (empty($_FILES['cover']['name'])) {
            $namafileText   = $this->input->post("cover_text");
            // $aksi        = $this->songadminlabel->editsong($judul, $recordLabelId, $description, $namafileText, $songId);
			$aksi           = $this->songadminlabel->editsong($judul, $artistId, $recordLabelId, $arrangerId, $composerId, $description, $namafileText, $songId);

            if($aksi == true){
                $this->session->set_flashdata('sukses_aksi_editlagu', '<div class="alert alert-success" role="alert">Data successfully updated</div>');
                redirect(base_url('songadminlabel/edit/'.$songId));
            }
            else{
                $this->session->set_flashdata('error_aksi_editlagu', '<div class="alert alert-danger" role="alert">Data was not updated successfully</div>');
                redirect(base_url('songadminlabel/edit/'.$songId));
            }
        } else {
            $this->load->library('upload');
            $ext        =  substr(strrchr($_FILES['cover']['name'], '.'), 1);
            $namaFile   = $songId.time();
            $namaFiles  = $namaFile.'.'.$ext;
            $namaFiles  = str_replace("=","", $namaFiles);

            $config = array(
                'upload_path'   => "./imagesForSong/",
                'allowed_types' => "gif|jpg|png|jpeg|pdf",
                'overwrite'     => true,
                'max_size'      => '2048000',
                'file_name'     => $namaFiles
            );

            $this->upload->initialize($config);

            if ($this->upload->do_upload('cover')) {
                if (isset($_SERVER['HTTPS'])) {
                    $hostUntukHapusFIleLama = "https://" . $_SERVER['HTTP_HOST'];
                    $host                   = "https://" . $_SERVER['HTTP_HOST']."/mydiosing_rapih/cimydiosing/imagesForSong/";
                } else {
                    $hostUntukHapusFIleLama = "http://" . $_SERVER['HTTP_HOST'];
                    $host                   = "http://" . $_SERVER['HTTP_HOST']."/mydiosing_rapih/cimydiosing/imagesForSong/";
                }

                $namaFileAfterUpload = $host.$namaFiles;

                $getOldImage = $this->songadminlabel->getOldImage($songId);
                if($getOldImage != NULL or !empty($getOldImage) or $getOldImage->coverImage != null or !empty($getOldImage->coverImage)){
                    $namaFileLama = str_replace($hostUntukHapusFIleLama,"",$getOldImage->coverImage);
                    $namaFileLama = $_SERVER['DOCUMENT_ROOT'].$namaFileLama;
                    unlink($namaFileLama);
                }

                $aksi = $this->songadminlabel->editsong($judul, $artistId, $recordLabelId, $arrangerId, $composerId, $description, $namaFileAfterUpload, $songId);

                if($aksi == true){
                    $this->session->set_flashdata('sukses_aksi_editlagu', '<div class="alert alert-success" role="alert">Data successfully updated</div>');
                    redirect(base_url('songadminlabel/edit/'.$songId));
                }
                else{
                    $this->session->set_flashdata('error_aksi_editlagu', '<div class="alert alert-danger" role="alert">Data was not updated successfully</div>');
                    redirect(base_url('songadminlabel/edit/'.$songId));
                }

            } else {
                $this->session->set_flashdata('error_aksi_editlagu', '<div class="alert alert-danger" role="alert">Failed to upload image</div>');
                redirect(base_url('songadminlabel/edit/'.$songId));
            }
        }
    }
}