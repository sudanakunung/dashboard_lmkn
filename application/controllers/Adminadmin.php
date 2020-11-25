<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminadmin extends Admin_Controller {
    function __construct(){
        parent::__construct();
        $this->halaman = "adminadmin";
    }

    function index(){
        $this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('adminadmin/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('adminadmin/index');
        }

        $config['total_rows'] = $this->adminadmin->countDataAdmin($keyword);
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

        $dataAdmin  = $this->adminadmin->getDataAdmin($offset, $dataPerPage, $keyword);

        $mainview   = 'admin/admin/default';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataAdmin','total_data'));
    }

    function tambah(){
        $getDataCombobox    = $this->adminadmin->getDataCombobox();
        $getLabel           = $this->adminadmin->getLabel();
        $getComposer        = $this->adminadmin->getComposer();
        $getArranger        = $this->adminadmin->getArranger();
        $halaman            = $this->halaman;
        $mainview           = 'admin/admin/tambah';
        $this->load->view('template', compact('halaman','mainview','getDataCombobox','getLabel','getComposer','getArranger'));
    }

    function aksitambah(){
        if($this->input->post("aksi") == "add"){
            $username   = $this->input->post("username");
            $email      = $this->input->post("email");
            $password   = $this->input->post("password");
            $roleId     = $this->input->post("posisi");
            $artistId   = $this->input->post("artistId");
            $labels     = $this->input->post("labels");
            $arrangerId = $this->input->post("arrangerId");
            $composerId = $this->input->post("composerId");
            $roleIdLMK  = $this->input->post("roleIdLMK");
            $lembaga    = $this->input->post("lembaga");
            $langCode   = $this->input->post("langCode");
            
            $aksi = $this->adminadmin->tambahadmin($username,$email,$password,$roleId,$artistId,$labels,$arrangerId,$composerId,$roleIdLMK,$lembaga,$langCode);
            
            if($aksi == true){
                $this->session->set_flashdata('sukses_aksi_tambahadmin', 'Data successfully added');
                redirect(base_url('adminadmin/index'));
            }
            else{
                $this->session->set_flashdata('error_aksi_tambahadmin', 'Data failed to add');
                ?>
                <script type="text/javascript">
                    window.history.back();
                </script>

                <?php
            }
        }
    }

    function edit($adminId){
        $getDataComboboxEdit = $this->adminadmin->getDataComboboxEdit();
        $getDataEdit         = $this->adminadmin->getDataEdit($adminId);
        
        if($getDataEdit == NULL){
            redirect(base_url('adminadmin/index'));
        }

        $getLabel            = $this->adminadmin->getLabel();
        $getComposer         = $this->adminadmin->getComposer();
        $getArranger         = $this->adminadmin->getArranger();
        $halaman             = $this->halaman;
        $mainview            = 'admin/admin/edit';
        $this->load->view('template', compact('halaman','mainview','getDataComboboxEdit','getDataEdit','getLabel','getComposer','getArranger'));
    }

    function aksiedit(){
        if($this->input->post("aksi") == "edit"){
            $adminId        = $this->input->post("id");
            $username       = $this->input->post("username");
            $email          = $this->input->post("email");
            $email          = isset($email) ? $email : NULL;

            $password       = $this->input->post("password");
            $roleId         = $this->input->post("posisi");
            $roleIdLMK      = $this->input->post("roleIdLMK");
            //$artistId       = $this->input->post("artistId");

            //$recordLabelId  = $this->input->post("labels");
            //$recordLabelId  = isset($recordLabelId) ? $recordLabelId : 0;

            $composerId  = $this->input->post("composerId");
            $composerId  = isset($composerId) ? $composerId : 0;

            $arrangerId  = $this->input->post("arrangerId");
            $arrangerId  = isset($arrangerId) ? $arrangerId : 0;

            $lembaga     = null;

            // jika roleid 1 (admin) atau 2 (label) maka set artistId jadi 0
            if($roleId == 0 OR $roleId == '0'){
                $artistId = $this->input->post("artistId");
                $recordLabelId = 0;
            }
            else if($roleId == 2 OR $roleId == '2'){
                $artistId = 0;
                $recordLabelId  = $this->input->post("labels");
            }
            else{
                $artistId = 0;
                $recordLabelId = 0;
            }

            // label bernilai roleId 0
            if($roleId == 2 or $roleId == '2'){
                $roleId = 0;
            }
            // buat roleId untuk admin LMK jika yang dipilih adalah LMK
            // else if($roleId == 4 or $roleId == '4'){
            //     $roleId = $roleIdLMK;
            //     $lembaga = $this->input->post("lembaga");
            // }
            else if($roleId == 9 or $roleId == '9'){
                $roleId = $roleId;
                $lembaga = $this->input->post("lembaga");
            }
            else {
                $roleId = $roleId;
                $lembaga = Null;
            }

            $hasing = genHash($username,$password);

            $aksi = $this->adminadmin->editAdmin($username,$artistId,$email,$hasing,$roleId,$recordLabelId,$arrangerId,$adminId,$composerId,$lembaga);
            
            if($aksi == true){
                $this->session->set_flashdata('sukses_aksi_editadmin', 'Data updated successfully');
                redirect(base_url('adminadmin/index'));
            }
            else{
                $this->session->set_flashdata('error_aksi_editadmin', 'Data failed to update');
                ?>
                <script type="text/javascript">
                    window.history.back();
                </script>

                <?php
            }
        }
    }

    function hapus($adminId){
        $aksi = $this->adminadmin->hapusAdmin($adminId);
        if($aksi == true){
            $this->session->set_flashdata('sukses_aksi_hapusadmin', 'Data successfully deleted');
            redirect(base_url('adminadmin/index'));
        }
        else{
            $this->session->set_flashdata('error_aksi_hapusadmin', 'Data failed to delete'); ?>
            
            <script type="text/javascript">
                window.history.back();
            </script>

        <?php
        }
    }
}