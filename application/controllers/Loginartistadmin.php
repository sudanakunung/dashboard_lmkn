<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Loginartistadmin extends Admin_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->halaman = "loginartistadmin";
    }

    function index()
    {
        $data = $this->loginartistadmin->getdata();
        $halaman = $this->halaman;
        $mainview = 'admin/loginartist/loginartist';
        $this->load->view('template', compact('halaman', 'mainview', 'data'));
    }

    function tambah()
    {
        $listCombobox = $this->loginartistadmin->getList();
        $halaman = $this->halaman;
        $mainview = 'admin/loginartist/form';
        $this->load->view('template', compact('halaman', 'mainview', 'listCombobox'));
    }

    function aksitambah(){

        if ($this->input->post("aksi") == "tambah") {
            $username = $this->input->post("username");
            $pass = $this->input->post("password");
            $password = genHash($username, $pass);
            $name = $this->input->post("name");
            $email = $this->input->post("email");
            $artistId = $this->input->post("artistId");

            //cek username di tabel tadmin dan cek email di tabel user karena
            // jika username di tadmin ada yang sama maka data tidak bisa masuk (unik)
            // jika email di tuser ada yang sama maka data tidak bisa masuk (unik)

            $cekUsername = $this->loginartistadmin->cekUsername($username);
            $cekEmail    = $this->loginartistadmin->cekEmail($email);

            if($cekEmail != NULL or $cekUsername != NULL){
                echo '<script type="text/javascript"> alert("Gagal Memasukkan Data, Ganti Username Atau Email !!!");</script>';
                echo '<script type="text/javascript"> window.history.back();</script>';
            }
            else{
                //insert data di tadmin
                $inputTadmin = $this->loginartistadmin->inputTadmin($username, $password, $artistId);

                if ($inputTadmin == true) {
                    $inputTuser = $this->loginartistadmin->inputTuser($email, $name, $password, $artistId);

                    if ($inputTuser != false) {
                        //$inputTuser jadi Last Id
                        $last_Id = $inputTuser;
                        $updateTartist = $this->loginartistadmin->updateTartist($last_Id, $artistId);
                    }
                    else {
                        //kondisi kalo datanya gagal dimasukkan kedalam tuser dicari dah tuh data userIdnya berdasarkan email
                        $getUserId = $this->loginartistadmin->getUserId($email);

                        $userId = $getUserId->userId;

                        //update berdasarkan userid yang di dapat
                        $updateTuser = $this->loginartistadmin->updateTuser($email, $name, $password, $artistId, $userId);

                        if ($updateTuser == true) {
                            $updateTartist = $this->loginartistadmin->updateTartistIFFALSE($userId, $artistId);
                        }
                    }
                    redirect(base_url('loginartistadmin/index'));
                }
                else {
                    echo '<script type="text/javascript"> alert("Gagal Memasukkan Data, Ganti Username!!!");</script>';
                    echo '<script type="text/javascript"> window.history.back();</script>';
                }
            }
        }
    }
}
