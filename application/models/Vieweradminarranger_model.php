<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vieweradminarranger_model extends MY_Model {
	
	public function getAllDataViewer($offset, $dataPerPage, $keyword = null)
	{
		if(!empty($keyword)) {
			$where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!'";
		} else {
			$where = "";
		}

		$getsongview = $this->db->query("SELECT tsongviewer.songId, tsong.title, COUNT(tsongviewer.songId) AS jumlah FROM tsongviewer INNER JOIN tsong ON tsong.songId = tsongviewer.songId ".$where." GROUP BY tsongviewer.songId ORDER BY jumlah DESC LIMIT $offset, $dataPerPage")->result();

		$datasongviewer = [];

		foreach($getsongview as $key => $val){
			
			$datasongviewer[$key]['songId'] = $val->songId;
			$datasongviewer[$key]['jumlah'] = $val->jumlah;
			$datasongviewer[$key]['title'] = $val->title;

			$query_arranger = $this->db->select('tarranger.arranger')
				->join('tarranger', 'tarranger.arrangerId = tsongarranger.arrangerId', 'left')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $val->songId))
                ->row();
			$datasongviewer[$key]['arranger_name'] = ($query_arranger ? $query_arranger->arranger : '');
		}

		// Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php
		return result_object($datasongviewer);
	}

	public function countDataView($keyword = null)
	{
		
		if(!empty($keyword)) {
			$where = "WHERE tsong.title LIKE '%".$keyword."%' ESCAPE '!'";
		} else {
			$where = "";
		}

		$query = $this->db->query("SELECT tsongviewer.songId FROM tsongviewer INNER JOIN tsong ON tsong.songId = tsongviewer.songId $where GROUP BY tsongviewer.songId ORDER BY tsongviewer.songId DESC")->num_rows();

		return $query;
	}
}