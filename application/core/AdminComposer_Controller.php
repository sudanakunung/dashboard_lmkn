<?php
class AdminComposer_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $username = $this->session->userdata('username');
        $level    = $this->session->userdata('level');
        $is_login = $this->session->userdata('login');
        $timeout  = $this->session->userdata('timeout');


        if (!$is_login) {
            redirect(base_url());
            return;
        }

        if ($level !== 'admincomposer') {
            redirect(base_url());
            return;
        }
    }
}
