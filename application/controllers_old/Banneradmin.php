<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banneradmin extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->halaman = "banneradmin";
    }

    function index(){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('banneradmin/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('banneradmin/index');
        }

        $config['total_rows'] = $this->banneradmin->countDataBanner($keyword);
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
        $total_data  = $config['total_rows'];

        $dataBanner  = $this->banneradmin->getDataBanner($offset, $dataPerPage, $keyword);

        $mainview   = 'admin/banner/default';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataBanner','total_data'));
    }

    function tambah(){
        $halaman            = $this->halaman;
        $mainview           = 'admin/banner/tambah';
        $this->load->view('template', compact('halaman','mainview'));
    }

    function aksitambah(){
        if($this->input->post("aksi") == "tambah"){
            $config['upload_path']          = '../banner/';
            $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp|PNG|JPG|JPEG|GIF|BMP';
            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('image')){
                $this->session->set_flashdata('error_aksi_uploadbanner', 'Gagal Upload Gambar');
                ?>
                <script type="text/javascript">
                    window.history.back();
                </script>

                <?php
            }
            else{
                $title       = $this->input->post("title");
                $urlklik     = $this->input->post("url");
                $createdDate = date('Y-m-d h:i:s');
                $showDate    = $this->input->post("showDate");
                $showDate    = date('Y-m-d ', strtotime($showDate)).date('h:i:s');
                $expDate     = $this->input->post("expDate");
                $expDate     = date('Y-m-d ', strtotime($expDate)).date('h:i:s');
                $urlImage    = "https://mydiosing.com:7443/mydiosing/banner/".$this->upload->file_name;
                $aksi = $this->banneradmin->tambah($title,$urlImage,$urlklik,$createdDate,$showDate,$expDate);

                if($aksi == true){
                    $this->session->set_flashdata('sukses_aksi_tambahbanner', 'Berhasil Memasukkan Data');
                    redirect(base_url('banneradmin/index'));
                }
                else{
                    $this->session->set_flashdata('error_aksi_tambahbanner', 'Gagal Memasukkan Data');
                    ?>
                    <script type="text/javascript">
                        window.history.back();
                    </script>

                    <?php
                }

            }
        }
    }

    function edit($id){
        $halaman            = $this->halaman;
        $dataEdit           = $this->banneradmin->dataEdit($id);
        $mainview           = 'admin/banner/edit';
        $this->load->view('template', compact('halaman','mainview', 'dataEdit'));
    }

    function aksiedit(){
        if($this->input->post("aksi") == "edit"){
            $image = $_FILES['image']['name'];
//            jika gambar tidak di ubah
            if($image == ""){
                $id          = $this->input->post("id");
                $title       = $this->input->post("title");
                $urlklik     = $this->input->post("url");
                $createdDate = date('Y-m-d h:i:s');
                $showDate    = $this->input->post("showDate");
                $showDate    = date('Y-m-d ', strtotime($showDate)).date('h:i:s');
                $expDate     = $this->input->post("expDate");
                $expDate     = date('Y-m-d ', strtotime($expDate)).date('h:i:s');
                $aksi = $this->banneradmin->editWithoutImage($title,$urlklik,$createdDate,$showDate,$expDate,$id);
                if($aksi == true){
                    $this->session->set_flashdata('sukses_aksi_editbanner', 'Berhasil Memasukkan Data');
                    redirect(base_url('banneradmin/index'));
                }
                else{
                    $this->session->set_flashdata('error_aksi_editbanner', 'Gagal Memasukkan Data');
                    ?>
                    <script type="text/javascript">
                        window.history.back();
                    </script>

                    <?php
                }
            }

//            jika gambar di ubah
            else{
                $config['upload_path']          = '../banner/';
                $config['allowed_types']        = 'gif|jpg|png|jpeg|bmp|PNG|JPG|JPEG|GIF|BMP';
                $this->load->library('upload', $config);
                if ( ! $this->upload->do_upload('image')){
                    $this->session->set_flashdata('error_aksi_uploadbanner', 'Gagal Upload Gambar');
                    ?>
                    <script type="text/javascript">
                        window.history.back();
                    </script>

                    <?php
                }
                else{
                    $id          = $this->input->post("id");
                    $title       = $this->input->post("title");
                    $urlklik     = $this->input->post("url");
                    $createdDate = date('Y-m-d h:i:s');
                    $showDate    = $this->input->post("showDate");
                    $showDate    = date('Y-m-d ', strtotime($showDate)).date('h:i:s');
                    $expDate     = $this->input->post("expDate");
                    $expDate     = date('Y-m-d ', strtotime($expDate)).date('h:i:s');
                    $urlImage    = "https://mydiosing.com:7443/mydiosing/banner/".$this->upload->file_name;
                    $aksi = $this->banneradmin->editWithImage($title,$urlImage,$urlklik,$createdDate,$showDate,$expDate,$id);

                    if($aksi == true){
                        $this->session->set_flashdata('sukses_aksi_editbanner', 'Berhasil Memasukkan Data');
                        redirect(base_url('banneradmin/index'));
                    }
                    else{
                        $this->session->set_flashdata('error_aksi_editbanner', 'Gagal Memasukkan Data');
                        ?>
                        <script type="text/javascript">
                            window.history.back();
                        </script>

                        <?php
                    }

                }
            }


        }

    }

    function hapus($bannerId){
        $aksi = $this->banneradmin->hapus($bannerId);
        if($aksi == true){
            $this->session->set_flashdata('sukses_aksi_hapusbanner', 'Berhasil Hapus Data');
            redirect(base_url('banneradmin/index'));
        }
        else{
            $this->session->set_flashdata('error_aksi_hapusbanner', 'Gagal Hapus Data');
            ?>
            <script type="text/javascript">
                window.history.back();
            </script>

            <?php
        }
    }
}
/**
 * Created by PhpStorm.
 * User: subki
 * Date: 15/02/2018
 * Time: 12:36
 */