<?php
class Label_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $username = $this->session->userdata('username');
        $level    = $this->session->userdata('level');
        $is_login = $this->session->userdata('login');
        $timeout  = $this->session->userdata('timeout');

//        if (time() < $this->timeout){
//            $timeout =  $this->session->set_userdata('timeout', time() + 5000);
//        }
//        else{
//            $is_login =  0;
//        }

        if (!$is_login) {
            redirect(base_url());
            return;
        }

        if ($level !== 'label') {
            redirect(base_url());
            return;
        }
    }
}
