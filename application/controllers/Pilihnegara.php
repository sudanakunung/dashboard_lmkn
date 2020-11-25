<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Pilihnegara extends MY_Controller {
    
    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $sessionNegara = $this->session->has_userdata('negara');

        if ($sessionNegara) {
            redirect('login');
        } else {
            $this->load->view('pilih_negara');
        }
        
    }

    public function simpansessionnegara()
    {
        $negara = $this->input->post('negara');

        $isiSessionNegara = array(
            'negara'  => $negara
        );

        $this->session->set_userdata($isiSessionNegara);

        $returnArray = [
            'redirect' => base_url('login')
        ];

        echo json_encode($returnArray);
    }
}