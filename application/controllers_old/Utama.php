<?php
//controlleer utama yang mengatur login  dan time
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller{
    private $is_login;
    private $level;
    private $timeout;

    function __construct()
    {
        parent::__construct();
        $this->is_login = $this->session->userdata('login');
        $this->level    = $this->session->userdata('level');
        $this->timeout  = $this->session->userdata('timeout');

        if (time() < $this->timeout){
            $this->timeout =  $this->session->set_userdata('timeout', time() + 5000);
        }
        else{
            $this->is_login =  0;
        }
    }

    function index(){
        $sessionNegara = $this->session->has_userdata('langCode');

        if($sessionNegara){
            if($this->is_login == 1){
                if($this->level == "admin"){
                    redirect(base_url('dashboardadmin'));
                }
                elseif($this->level == "artist"){
                    redirect(base_url('mainscreen'));
                }
                elseif($this->level == "label"){
                    redirect(base_url('mainscreenlabel'));
                }
                elseif($this->level == "arranger"){
                    redirect(base_url('mainscreenarranger'));
                }
                elseif($this->level == "composer"){
                    redirect(base_url('mainscreencomposer'));
                }
                elseif($this->level == "adminartist"){
                    redirect(base_url('dashboardadminartist'));
                }
                elseif($this->level == "adminlabel"){
                    redirect(base_url('dashboardadminlabel'));
                }
                elseif($this->level == "admincomposer"){
                    redirect(base_url('dashboardadmincomposer'));
                }
                elseif($this->level == "adminarranger"){
                    redirect(base_url('dashboardadminarranger'));
                }
            }
            else{
                $data = [
                    "username"=>null,
                    "artistId"=>null,
                    "level"=>null,
                    "roleId"=>null,
                    "recordLabelId"=>null,
                    "timeout" =>null,
                    "login" => null,
                    "labelname"=> null,
                    "nameArtist"=>null,
                    "cover"=>null,
                    "langCode"=>null
                ];
                
                $this->session->unset_userdata($data);
                $this->session->sess_destroy();
                redirect(base_url('login/index'));
            }
        } else {
            redirect('selectcountry');
        }
    }
}