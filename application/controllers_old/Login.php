<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('securitysimple');
    }

    public function index(){

        $sessionLangCode = $this->session->has_userdata('langCode');

        if($sessionLangCode){
            if($_POST){
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                if($this->login->login($username, $password)){
                    redirect (base_url());
                }
                else{
                    $this->session->set_flashdata('error', 'Username atau password salah.');
                }
                redirect('login');
            }
            else{
                $this->load->view('login');
            }
        } else {
            redirect(base_url());
        }
    }

    public function logout(){
        $this->login->logout();
        redirect(base_url());

    }
}
/**
 * Created by PhpStorm.
 * User: abc
 * Date: 19/11/2017
 * Time: 10:22
 */