<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Composer extends Admin_Controller {
    function __construct(){
        parent::__construct();
		$this->load->model('Composer_model');
		$this->halaman = "composer";
    }

    function index(){
		$this->load->library('pagination');

        //cek jika ada search keyword
        $keyword = $this->input->get('keyword');
        
        if($keyword != NULL ) {
            $keyword = $this->input->get('keyword', true);
            $url = base_url('composer/index').'?keyword=' . $keyword;
        } else {
            $keyword = null;
            $url = base_url('composer/index');
        }

        $config['total_rows'] = $this->composer->countDataComposer($keyword);
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

        $dataComposer  = $this->composer->getAllDataComposer($offset, $dataPerPage, $keyword);

        $mainview   = 'admin/composer/default';
        $halaman    = $this->halaman;
        $this->load->view('template', compact('mainview','halaman','start','dataComposer','total_data'));
    }

    function tambah(){
        $mainview   = "admin/composer/tambah";
        $halaman    = $this->halaman;
        $this->load->view('template',compact('mainview','halaman','dataComposer'));
    }

    function aksitambah(){
        if($this->input->post('aksi') == "add"){
            $aksi = $this->Composer_model->tambahDataComposer();
            
            $this->session->set_flashdata('sukses_aksi_tambahcomposer', '<div class="alert alert-success" role="alert">Success to add composer</div>');

            redirect(base_url('composer/index'));
        }        
    }

    function edit($id)
	{
        $get_composer = $this->Composer_model->getComposerById($id);

		$dataEditComposer = [
			'id' => $get_composer['composerId'],
			'name' => $get_composer['name'],
            'referral' => $get_composer['referral']
        ];
        
        $mainview   = "admin/composer/edit";
        $halaman    = $this->halaman;
        
        $this->load->view('template',compact('mainview','halaman','dataEditComposer'));
    }

    function aksiedit()
    {
        $this->Composer_model->ubahDataComposer();

		$this->session->set_flashdata('sukses_aksi_editcomposer', '<div class="alert alert-success" role="alert">Data successfully to update</div>');
		
		redirect('composer/index');
    }

    public function hapus_composer($id)
	{
		$this->Composer_model->hapusDataComposer($id);

		$this->session->set_flashdata('sukses_aksi_hapuscomposer', '<div class="alert alert-success" role="alert">Data successfully to delete</div>');

		redirect('composer/index');
	}
}