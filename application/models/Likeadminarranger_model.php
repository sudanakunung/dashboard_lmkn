<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Likeadminarranger_model extends MY_Model {
	
	public function getAllDataLike($offset, $dataPerPage, $keyword = null)
	{
		
		if(!empty($keyword)) {
			$where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!'";
		} else {
			$where = "";
		}
		
		$getsonglike = $this->db->query("SELECT tsonglike.songId, tsong.title, COUNT(tsonglike.songId) AS jumlah FROM tsonglike INNER JOIN tsong ON tsong.songId = tsonglike.songId $where GROUP BY tsonglike.songId ORDER BY jumlah DESC LIMIT $offset, $dataPerPage")->result();

		$datasonglike = [];

		foreach($getsonglike as $key => $songlike){
			
			$datasonglike[$key]['songId'] = $songlike->songId;
			$datasonglike[$key]['jumlah'] = $songlike->jumlah;
			$datasonglike[$key]['title'] = $songlike->title;

			$query_arranger = $this->db->select('tarranger.arranger')
				->join('tarranger', 'tarranger.arrangerId = tsongarranger.arrangerId', 'left')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $songlike->songId))
                ->row();
			$datasonglike[$key]['arranger_name'] = ($query_arranger ? $query_arranger->arranger : '');
		}

		// Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php
		return result_object($datasonglike);
	}

	public function countDataLike($keyword = null)
	{
		
		if(!empty($keyword)) {
			$where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!'";
		} else {
			$where = "";
		}

		$query = $this->db->query("SELECT tsonglike.songId FROM tsonglike INNER JOIN tsong ON tsong.songId = tsonglike.songId $where GROUP BY tsonglike.songId ORDER BY  tsonglike.songId DESC")->num_rows();

		return $query;
	}
}