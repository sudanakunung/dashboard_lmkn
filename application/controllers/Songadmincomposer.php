<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Songadmincomposer extends AdminComposer_Controller {

    function __construct(){
        parent::__construct();
        $this->halaman = "songadmincomposer";
    }

    function index(){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('songadmincomposer/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('songadmincomposer/index');
        }

        $config['total_rows'] = $this->songadmincomposer->countDataSong($keyword);
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

        $dataSong  = $this->songadmincomposer->getDataSong($offset, $dataPerPage, $keyword);

        $mainview   = "admincomposer/song/default";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataSong','total_data'));
    }

    public function edit($songId)
    {
        $dataEditSong = $this->songadmincomposer->getDataEditSong($songId);
        $dataArtist = $this->songadmincomposer->getDataArtist();
        $dataLabel = $this->songadmincomposer->getDataLabel();
        $dataArranger = $this->songadmincomposer->getDataArranger();
        $dataComposer = $this->songadmincomposer->getDataComposer();
        $mainview = "admincomposer/song/edit";
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
            // $aksi           = $this->songadmincomposer->editsong($judul, $composerId, $description, $namafileText, $songId);
			$aksi           = $this->songadmincomposer->editsong($judul, $artistId, $recordLabelId, $arrangerId, $composerId, $description, $namafileText, $songId);

            if($aksi == true){
                $this->session->set_flashdata('sukses_aksi_editlagu', '<div class="alert alert-success" role="alert">Data successfully updated</div>');
                redirect(base_url('songadmincomposer/edit/'.$songId));
            }
            else{
                $this->session->set_flashdata('error_aksi_editlagu', '<div class="alert alert-danger" role="alert">Data was not updated successfully</div>');
                redirect(base_url('songadmincomposer/edit/'.$songId));
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

                $getOldImage = $this->songadmincomposer->getOldImage($songId);
                if($getOldImage != NULL or !empty($getOldImage) or $getOldImage->coverImage != null or !empty($getOldImage->coverImage)){
                    $namaFileLama = str_replace($hostUntukHapusFIleLama,"",$getOldImage->coverImage);
                    $namaFileLama = $_SERVER['DOCUMENT_ROOT'].$namaFileLama;
                    unlink($namaFileLama);
                }

                $aksi = $this->songadmincomposer->editsong($judul, $artistId, $recordLabelId, $arrangerId, $composerId, $description, $namaFileAfterUpload, $songId);

                if($aksi == true){
                    $this->session->set_flashdata('sukses_aksi_editlagu', '<div class="alert alert-success" role="alert">Data successfully updated</div>');
                    redirect(base_url('songadmincomposer/edit/'.$songId));
                }
                else{
                    $this->session->set_flashdata('error_aksi_editlagu', '<div class="alert alert-danger" role="alert">Data was not updated successfully</div>');
                    redirect(base_url('songadmincomposer/edit/'.$songId));
                }

            } else {
                $this->session->set_flashdata('error_aksi_editlagu', '<div class="alert alert-danger" role="alert">Failed to upload image</div>');
                redirect(base_url('songadmincomposer/edit/'.$songId));
            }
        }
    }
}