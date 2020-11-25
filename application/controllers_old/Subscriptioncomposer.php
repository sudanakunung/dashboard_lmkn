<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subscriptioncomposer extends Composer_Controller{
    function __construct()
    {
        parent::__construct();
        $this->halaman = 'subscriptioncomposer';
    }

    function index(){
        if($_POST){
            $tanggal_awal   = $this->input->post('tanggalsubscriptioncomposer')."-01";
            $waktu          = strtotime($this->input->post('tanggalsubscriptioncomposer')."-01");
            $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $waktu));
        }
        else{
            $tanggal_awal   = date('Y-m-01');
            $now            = strtotime(date("Y-m-01"));
            $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $now));
        }
        $composerId         = $this->session->userdata('composerId');
        $halaman            = $this->halaman;

        $getAllReferall     = $this->subscriptioncomposer->getAllReferAll($composerId,$tanggal_awal,$tanggal_akhir);
        $getTypeSubscription= $this->subscriptioncomposer->getTypeSubscription();

        foreach ($getTypeSubscription as $type){
            if(str_replace(' ','',$type->subscription) == "FREE"){
                $free       = $this->subscriptioncomposer->typeFree($composerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "GUEST"){
                $guest      = $this->subscriptioncomposer->typeGuest($composerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "HAPPY"){
                $happy      = $this->subscriptioncomposer->typeHappy($composerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "HAPPYPLUS"){
                $happyplus  = $this->subscriptioncomposer->typeHappyplus($composerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1MONTH"){
                $sebulan    = $this->subscriptioncomposer->typeSebulan($composerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1WEEK"){
                $seminggu   = $this->subscriptioncomposer->typeSeminggu($composerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1YEAR"){
                $setahun   = $this->subscriptioncomposer->typeSetahun($composerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "3MONTHS"){
                $triwulan   = $this->subscriptioncomposer->typeTriwulan($composerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
        }

        $mainview = "composer/subscription/subscriptioncomposer";
        $this->load->view('template',compact('halaman','mainview','getAllReferall','getTypeSubscription','free','guest','happy','happyplus','sebulan','setahun','seminggu','triwulan'));
    }
}

/**
 * Created by PhpStorm.
 * User: subki
 * Date: 27/11/2017
 * Time: 10:50
 */