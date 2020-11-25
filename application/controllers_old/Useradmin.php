<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//controller untuk halaman artist
class Useradmin extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->halaman = "useradmin";

    }

    function index(){

        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('useradmin/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('useradmin/index');
        }

        $config['total_rows'] = $this->useradmin->countDataUser($keyword);
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

        $dataUser  = $this->useradmin->getDataUser($offset, $dataPerPage, $keyword);

        $mainview = "admin/user/user";
        $halaman  = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataUser','total_data'));
    }

    function edit($userId){
        $data       = $this->useradmin->getEdit($userId);
        if($data == NULL){
            redirect(base_url('useradmin/index'));
        }
        $mainview   = "admin/user/edit";
        $halaman    = $this->halaman;
        $this->load->view('template', compact('halaman', 'mainview', 'data'));
    }

    function aksi(){

        if($_POST){
            $userId     = $this->input->post('id');
            $email      = $this->input->post('email');
            $nama       = $this->input->post('nama');
            $birthday   = $this->input->post('birthday');
            $gender     = $this->input->post('gender');

            $aksi       = $this->useradmin->getAksi($userId,$email,$nama,$birthday,$gender);


            if($aksi == true){
                redirect(base_url("useradmin/index"));
            }
            else{
                $this->session->set_flashdata('error_aksi_useradmin', 'Gagal Memasukkan Data, Mungkin Masukkan dengan email yang beda');
                ?>
                <script type="text/javascript">
                    window.history.back();
                </script>

                <?php
            }
        }
    }
}
