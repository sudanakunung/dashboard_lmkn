<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Songlistcomposer_model extends MY_Model
{
    protected $perPage = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
    }

    public function getAllSongList($id)
    {
        $sql = "SELECT COUNT(songId) as jumlah FROM tsongcomposer WHERE composerId = ?";
        $data = $this->db->query($sql, array($id))->row();

        return $data->jumlah;
    }


    function getDataSong($id, $limit, $page)
    {
        $position = ($page - 1) * $limit;
        $sql = "SELECT tsong.songId, tsong.title, tsong.coverImage FROM tsong INNER JOIN tsongcomposer ON tsongcomposer.songId = tsong.songId WHERE tsongcomposer.composerId = ? ORDER BY tsong.songId DESC LIMIT ?, ?";
        $data = $this->db->query($sql, array($id, $position, $limit))->result();
        
        return $data;
    }
}



//    public function getData($id, $position, $item_per_page){
//        $sql = "SELECT tsong.songId, tsong.title, tsong.coverImage FROM tsong INNER JOIN tsongartist ON tsongartist.songId = tsong.songId WHERE tsongartist.artistId = ? ORDER BY tsong.songId DESC LIMIT ?,?";
//        $data = $this->db->query($sql, array($id,$position, $item_per_page))->row();
//
//        return $data->jumlah;
//    }
//
//    public function makePagination($baseURL, $uriSegment, $totalRows = null)
//    {
//        $args = func_get_args();
//
//        $this->load->library('pagination');
//
//        $config = [
//            'base_url'         => $baseURL,
//            'uri_segment'      => $uriSegment,
//            'per_page'         => $this->perPage,
//            'total_rows'       => $totalRows,
//            'use_page_numbers' => true,
//            'num_links'        => 5,
//            'full_tag_open'    => '<div class="pagination"><ul>',
//            'full_tag_close'   => '</ul></div>',
//            'first_link'       => '&laquo; First',
//            'first_tag_open'   => '<li class="prev page">',
//            'first_tag_close'  => '</li>',
//            'last_link'        => 'Last &raquo;',
//            'last_tag_open'    => '<li class="next page">',
//            'last_tag_close'   => '</li>',
//            'next_link'        => 'Next &rarr;',
//            'next_tag_open'    => '<li class="next page">',
//            'next_tag_close'   => '</li>',
//            'prev_link'        => '&larr; Previous',
//            'prev_tag_open'    => '<li class="prev page">',
//            'prev_tag_close'   => '</li>',
//            'cur_tag_open'     => '<li class="active"><a href="">',
//            'cur_tag_close'    => '</a></li>',
//            'num_tag_open'     => '<li class="page">',
//            'num_tag_close'    => '</li>'
//        ];
//
//
//        if (count($_GET) > 0) {
//            $config['suffix']    = '?' . http_build_query($_GET, '', "&");
//            $config['first_url'] = $config['base_url'] . '?' . http_build_query($_GET);
//        } else {
//            $config['suffix']    = http_build_query($_GET, '', "&");
//            $config['first_url'] = $config['base_url'];
//        }
//
//        $this->pagination->initialize($config);
//        return $this->pagination->create_links();
//    }


/**
 * Created by PhpStorm.
 * User: abc
 * Date: 19/11/2017
 * Time: 10:32
 */