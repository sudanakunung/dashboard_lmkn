<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboardadmininstitution_model extends MY_Model{

    public function totalUser(){
        $sql = "SELECT  COUNT(*) AS jumlah FROM tuser";
        return $this->db->query($sql)->row();
    }

    public function totalLagu(){
        
        if($this->session->userdata('lembaga') == 'SELMI'){

            $query = "SELECT song.songId
            FROM tsong song
            LEFT JOIN (
                SELECT artist.lembaga, song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = song.songId
            LEFT JOIN (
                SELECT label.lembaga, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = song.songId
            WHERE (artist_data.lembaga = 'SELMI' OR label_data.lembaga = 'SELMI')";
        }
        else if($this->session->userdata('lembaga') == 'KCI'){

            $query = "SELECT song.songId
            FROM tsong song
            LEFT JOIN (
                SELECT composer.lembaga, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = song.songId
            WHERE composer_data.lembaga = 'KCI'";
        }
        else if($this->session->userdata('lembaga') == 'RAI'){

            $query = "SELECT song.songId
            FROM tsong song
            LEFT JOIN (
                SELECT composer.lembaga, song_composer.songId FROM tsongcomposer song_composer 
                JOIN tcomposer composer ON composer.composerId = song_composer.composerId
            ) composer_data ON composer_data.songId = song.songId
            WHERE composer_data.lembaga = 'RAI'";
        }
        else if($this->session->userdata('lembaga') == 'WAMI'){
            $query = "SELECT song.songId
            FROM tsong song
            LEFT JOIN (
                SELECT artist.lembaga,song_artist.songId FROM tsongartist song_artist 
                JOIN tartist artist ON artist.artistId = song_artist.artistId
            ) artist_data ON artist_data.songId = song.songId
            LEFT JOIN (
                SELECT label.lembaga, song_label.songId FROM trecordlabelsong song_label 
                JOIN trecordlabel label ON label.recordLabelId = song_label.recordLabelId
            ) label_data ON label_data.songId = song.songId
            WHERE (artist_data.lembaga = 'WAMI' OR label_data.lembaga = 'WAMI')";
        } else {
            $query = "SELECT song.songId
            FROM tsong song
            LEFT JOIN tsongartist ON tsongartist.songId = song.songId
            LEFT JOIN tartist artist_data ON artist_data.artistId = tsongartist.artistId";
        }

        return $this->db->query($query)->num_rows();
    }

    public function totalArtist(){
        $sql = "SELECT  COUNT(artistId) AS jumlah FROM tartist WHERE lembaga = '".$this->session->userdata('lembaga')."'";
        return $this->db->query($sql)->row();
    }

    public function totalLabel(){
        $sql = "SELECT COUNT(recordLabelId) AS jumlah FROM trecordlabel WHERE lembaga = '".$this->session->userdata('lembaga')."'";
        return $this->db->query($sql)->row();
    }

    public function totalComposer(){
        $sql = "SELECT  COUNT(composerId) AS jumlah FROM tcomposer WHERE lembaga = '".$this->session->userdata('lembaga')."'";
        return $this->db->query($sql)->row();
    }
}
