<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Songlist extends Artist_Controller{
    function __construct()
    {
        parent::__construct();
        $this->halaman = "songlist";
    }
    function index($page = 1){
        $total  = $this->songlist->getAllSongList($this->session->userdata('artistId'));
        $limit  = 6;
        $result = $this->songlist->getDataSong($this->session->userdata('artistId'), $limit, $page);
        $url = base_url('songlist/index');
        $config['base_url']         = $url;
        $config['total_rows']       = $total;
        $config['per_page']         = $limit;
        $config['use_page_numbers'] = true;
        $config['num_links']        = 5;
        $config['full_tag_open']    = '<ul class="pagination">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '&laquo';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '&raquo';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $this->pagination->initialize($config);
        $pagination = $this->pagination->create_links();
        //menyiapkan data untuk dikirim ke view
        $results    = $result;
        $paginations = $pagination;
        //load view
        $mainview = "artist/songlist/songlist";
        $halaman = $this->halaman;
        $this->load->view('template',compact('halaman','mainview','results', 'paginations','total'));
    }

}