<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subscriptionlabel extends Label_Controller{
    function __construct()
    {
        parent::__construct();
        $this->halaman = 'subscriptionlabel';
    }

    function index(){
        if($_POST){
            $tanggal_awal   = $this->input->post('tanggalsubscriptionlabel')."-01";
            $waktu          = strtotime($this->input->post('tanggalsubscriptionlabel')."-01");
            $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $waktu));
        }
        else{
            $tanggal_awal   = date('Y-m-01');
            $now            = strtotime(date("Y-m-01"));
            $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $now));
        }
        $recordLabelId         = $this->session->userdata('recordLabelId');
        $halaman            = $this->halaman;

        $getAllReferall     = $this->subscriptionlabel->getAllReferAll($recordLabelId,$tanggal_awal,$tanggal_akhir);
        $getTypeSubscription= $this->subscriptionlabel->getTypeSubscription();

        foreach ($getTypeSubscription as $type){
            if(str_replace(' ','',$type->subscription) == "FREE"){
                $free = $this->subscriptionlabel->typeFree($recordLabelId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "GUEST"){
                $guest = $this->subscriptionlabel->typeGuest($recordLabelId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "HAPPY"){
                $happy = $this->subscriptionlabel->typeHappy($recordLabelId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "HAPPYPLUS"){
                $happyplus = $this->subscriptionlabel->typeHappyplus($recordLabelId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1MONTH"){
                $sebulan = $this->subscriptionlabel->typeSebulan($recordLabelId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1WEEK"){
                $seminggu = $this->subscriptionlabel->typeSeminggu($recordLabelId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "1YEAR"){
                $setahun = $this->subscriptionlabel->typeSetahun($recordLabelId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
            elseif (str_replace(' ','',$type->subscription) == "3MONTHS"){
                $triwulan = $this->subscriptionlabel->typeTriwulan($recordLabelId, $type->subscription, $tanggal_awal, $tanggal_akhir);
            }
        }

        $mainview = "label/subscription/subscriptionlabel";
        $this->load->view('template',compact('halaman','mainview','getAllReferall','getTypeSubscription','free','guest','happy','happyplus','sebulan','setahun','seminggu','triwulan'));
    }
}

// class Subscriptionlabel extends Label_Controller{
//     function __construct(){
//         parent::__construct();
//         $this->halaman = 'subscriptionlabel';
//     }

//     function index(){
//         $recordLabelId   = $this->session->userdata('recordLabelId');
//         $halaman         = $this->halaman;
//         $data            = $this->subscriptionlabel->getDataArtist($recordLabelId);
//         $mainview        = "label/subscription/subscription";
//         $this->load->view('template',compact('halaman','mainview','data'));
//     }

//     function grafik($artistId){
//         if($_POST){
//             $tanggal_awal   = $this->input->post('tanggalsubscriptionlabel')."-01";
//             $waktu          = strtotime($this->input->post('tanggalsubscriptionlabel')."-01");
//             $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $waktu));
//         }
//         else{
//             $tanggal_awal   = date('Y-m-01');
//             $now            = strtotime(date("Y-m-01"));
//             $tanggal_akhir  = date('Y-m-d', strtotime('+1 month', $now));
//         }
//         $recordLabelId   = $this->session->userdata('recordLabelId');
//         $permission      = self::cekArtist($recordLabelId, $artistId);
//         if($permission == false){
//             redirect(base_url('subscriptionlabel/index'));
//         }
//         $getAllReferall      = $this->subscriptionlabel->getAllReferall($artistId, $tanggal_awal, $tanggal_akhir);
//         $getTypeSubscription = $this->subscriptionlabel->getTypeSubscription();

//         foreach ($getTypeSubscription as $type){
//             if(str_replace(' ','',$type->subscription) == "FREE"){
//                 $free       = $this->subscriptionlabel->typeFree($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
//             }
//             elseif (str_replace(' ','',$type->subscription) == "GUEST"){
//                 $guest      = $this->subscriptionlabel->typeGuest($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
//             }
//             elseif (str_replace(' ','',$type->subscription) == "HAPPY"){
//                 $happy      = $this->subscriptionlabel->typeHappy($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
//             }
//             elseif (str_replace(' ','',$type->subscription) == "HAPPYPLUS"){
//                 $happyplus  = $this->subscriptionlabel->typeHappyplus($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
//             }
//             elseif (str_replace(' ','',$type->subscription) == "SEBULAN"){
//                 $sebulan    = $this->subscriptionlabel->typeSebulan($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
//             }
//             elseif (str_replace(' ','',$type->subscription) == "SEMINGGU"){
//                 $seminggu   = $this->subscriptionlabel->typeSeminggu($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
//             }
//             elseif (str_replace(' ','',$type->subscription) == "TRIWULAN"){
//                 $triwulan   = $this->subscriptionlabel->typeTriwulan($artistId, $type->subscription, $tanggal_awal, $tanggal_akhir);
//             }
//         }

//         $halaman        = $this->halaman;
//         $mainview       = "label/subscription/grafik";
//         $this->load->view('template',compact('halaman','mainview','data','getTypeSubscription','getAllReferall','free','guest','happy','happyplus','sebulan','seminggu','triwulan'));
//     }

//     function cekArtist($recordLabelId, $artistId){
//         $data   = $this->subscriptionlabel->cekArtist($recordLabelId, $artistId);
//         return $data;
//     }
// }