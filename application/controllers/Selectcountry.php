<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Selectcountry extends MY_Controller {
    
    public function __construct(){
        parent::__construct();
    }

    public function index()
    {
        $sessionLangCode = $this->session->has_userdata('langCode');

        if ($sessionLangCode) {
            redirect('login');
        } else {
            $this->load->view('select_country');
        }
        
    }

    public function savelangcode()
    {
        $langCode = $this->input->post('langCode');

        $isiSessionLangCode = array(
            'langCode'  => $langCode
        );

        $this->session->set_userdata($isiSessionLangCode);

        $returnArray = [
            'redirect' => base_url('login')
        ];

        echo json_encode($returnArray);
    }
}