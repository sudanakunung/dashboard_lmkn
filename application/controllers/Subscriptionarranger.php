<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptionarranger extends Arranger_Controller{
    function __construct()
    {
        parent::__construct();
        $this->halaman = 'subscriptionarranger';
    }

    function index(){
        if($_POST){
            $tanggal_awal   = $this->input->post('tanggalsubscriptionarranger')."-01";
            $waktu          = strtotime($this->input->post('tanggalsubscriptionarranger')."-01");
            $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $waktu));
        }
        else{
            $tanggal_awal   = date('Y-m-01');
            $now            = strtotime(date("Y-m-01"));
            $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $now));
        }
        $arrangerId         = $this->session->userdata('arrangerId');
        $halaman            = $this->halaman;

        $getAllReferall     = $this->subscriptionarranger->getAllReferAll($arrangerId,$tanggal_awal,$tanggal_akhir);
        $getTypeSubscription= $this->subscriptionarranger->getTypeSubscription();

        foreach ($getTypeSubscription as $type){
            if(str_replace(' ','',$type->subscription) == "FREE"){
                $free = $this->subscriptionarranger->typeFree($arrangerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "GUEST"){
                $guest = $this->subscriptionarranger->typeGuest($arrangerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "HAPPY"){
                $happy = $this->subscriptionarranger->typeHappy($arrangerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "HAPPYPLUS"){
                $happyplus = $this->subscriptionarranger->typeHappyplus($arrangerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1MONTH"){
                $sebulan = $this->subscriptionarranger->typeSebulan($arrangerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1WEEK"){
                $seminggu = $this->subscriptionarranger->typeSeminggu($arrangerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1YEAR"){
                $setahun = $this->subscriptionarranger->typeSetahun($arrangerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "3MONTHS"){
                $triwulan = $this->subscriptionarranger->typeTriwulan($arrangerId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
        }

        $mainview = "arranger/subscription/subscriptionarranger";
        $this->load->view('template',compact('halaman','mainview','getAllReferall','getTypeSubscription','free','guest','happy','happyplus','sebulan','setahun','seminggu','triwulan'));
    }
}

/**
 * Created by PhpStorm.
 * User: subki
 * Date: 27/11/2017
 * Time: 10:50
 */