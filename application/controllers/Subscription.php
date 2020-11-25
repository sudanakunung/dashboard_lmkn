<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subscription extends Artist_Controller{
    function __construct()
    {
        parent::__construct();
        $this->halaman = 'subscription';
    }

    function index(){
        if($_POST){
            $tanggal_awal   = $this->input->post('tanggalsubscriptionartist')."-01";
            $waktu          = strtotime($this->input->post('tanggalsubscriptionartist')."-01");
            $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $waktu));
        }
        else{
            $tanggal_awal   = date('Y-m-01');
            $now            = strtotime(date("Y-m-01"));
            $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $now));
        }
        $artistId           = $this->session->userdata('artistId');
        $halaman            = $this->halaman;

        $getAllReferall     = $this->subscription->getAllReferAll($artistId,$tanggal_awal,$tanggal_akhir);
        $getTypeSubscription= $this->subscription->getTypeSubscription();

        foreach ($getTypeSubscription as $type){
            if(str_replace(' ','',$type->subscription) == "FREE"){
                $free       = $this->subscription->typeFree($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "GUEST"){
                $guest      = $this->subscription->typeGuest($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "HAPPY"){
                $happy      = $this->subscription->typeHappy($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "HAPPYPLUS"){
                $happyplus  = $this->subscription->typeHappyplus($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1MONTH"){
                $sebulan    = $this->subscription->typeSebulan($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1WEEK"){
                $seminggu   = $this->subscription->typeSeminggu($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1YEAR"){
                $setahun   = $this->subscription->typeSetahun($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "3MONTHS"){
                $triwulan   = $this->subscription->typeTriwulan($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
        }

        $mainview = "artist/subscription/subscription";
        $this->load->view('template',compact('halaman','mainview','getAllReferall','getTypeSubscription','free','guest','happy','happyplus','sebulan','setahun','seminggu','triwulan'));
    }
}

/**
 * Created by PhpStorm.
 * User: subki
 * Date: 27/11/2017
 * Time: 10:50
 */