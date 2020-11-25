<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Viewer_model extends MY_Model {
	
	public function getAllDataViewer($offset, $dataPerPage, $keyword = null)
	{
		if(!empty($keyword)) {
			$where = "WHERE (tsong.title LIKE '%".$keyword."%' ESCAPE '!' OR tartist.name LIKE '%".$keyword."%' ESCAPE '!')";
		} else {
			$where = "";
		}

		$getsongview = $this->db->query("SELECT tsongviewer.songId, tsong.title, COUNT(tsongviewer.songId) AS jumlah, tartist.name
			FROM tsongviewer 
			INNER JOIN tsong ON tsong.songId = tsongviewer.songId 
			LEFT JOIN tsongartist ON tsongartist.songId = tsongviewer.songId
			LEFT JOIN tartist ON tartist.artistId = tsongartist.artistId
			".$where." 
			GROUP BY tsongviewer.songId ORDER BY jumlah DESC LIMIT $offset, $dataPerPage")->result();

		$data = [];

		foreach($getsongview as $key => $val){
			
			$data[$key]['songId'] = $val->songId;
			$data[$key]['jumlah'] = $val->jumlah;
			$data[$key]['title'] = $val->title;
			$data[$key]['artist_name'] = $val->name;

			$query_label = $this->db->select('trecordlabel.recordLabel')
				->join('trecordlabel', 'trecordlabelsong.recordLabelId = trecordlabel.recordLabelId', 'left')
                ->get_where('trecordlabelsong', array('trecordlabelsong.songId' => $val->songId))
                ->row();
			$data[$key]['label_name'] = ($query_label ? $query_label->recordLabel : '');

			$query_arranger = $this->db->select('tarranger.arranger')
                ->join('tarranger', 'tarranger.arrangerId = tsongarranger.arrangerId', 'left')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $val->songId))
                ->row();
            $arranger = ($query_arranger ? $query_arranger->arranger : '');
            $data[$key]['arranger_name'] = $arranger;
            
			$query_composer = $this->db->select('tcomposer.name')
				->join('tcomposer', 'tsongcomposer.composerId = tcomposer.composerId', 'left')
                ->get_where('tsongcomposer', array('tsongcomposer.songId' => $val->songId))
                ->row();
			$data[$key]['composer_name'] = ($query_composer ? $query_composer->name : '');
		}

		// Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php
		return result_object($data);
	}

	public function countDataView($keyword = null)
	{
		
		if(!empty($keyword)) {
			$where = "WHERE (tsong.title LIKE '%".$keyword."%' ESCAPE '!' OR tartist.name LIKE '%".$keyword."%' ESCAPE '!')";
		} else {
			$where = "";
		}

		$query = $this->db->query("SELECT 1
			FROM tsongviewer 
			INNER JOIN tsong ON tsong.songId = tsongviewer.songId 
			LEFT JOIN tsongartist ON tsongartist.songId = tsongviewer.songId
			LEFT JOIN tartist ON tartist.artistId = tsongartist.artistId
			".$where."
			GROUP BY tsongviewer.songId")->num_rows();

		return $query;
	}
}