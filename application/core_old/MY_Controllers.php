<?php
class MY_Controllers extends CI_Controller
{
    protected $halaman = '';


    public function __construct()
    {
        parent::__construct();

        define("LOGOICO", base_url('image/favicon.ico'));

        $model = strtolower(get_class($this));
        if (file_exists(APPPATH . 'models/' . $model . '_model.php')) {
            $this->load->model($model . '_model', $model, true);
        }



        $timeout = $this->session->userdata('timeout');

        if (time() < $timeout){

           $this->session->set_userdata('timeout', time() + 5000);
        }
        else{
            $this->session->set_userdata('login', 0);
        }
    }
}
