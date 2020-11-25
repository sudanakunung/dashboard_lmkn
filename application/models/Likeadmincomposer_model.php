<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Likeadmincomposer_model extends MY_Model {
	
	public function getAllDataLike($offset, $dataPerPage, $keyword = null)
	{
		
		if(!empty($keyword)) {
			$where = "WHERE (tsong.title LIKE '%".$keyword."%' ESCAPE '!' OR tartist.name LIKE '%".$keyword."%' ESCAPE '!')";
		} else {
			$where = "";
		}
		
		$getsonglike = $this->db->query("SELECT tsonglike.songId, tsong.title, COUNT(tsonglike.songId) AS jumlah, tartist.name
			FROM tsonglike 
			INNER JOIN tsong ON tsong.songId = tsonglike.songId 
            LEFT JOIN tsongartist ON tsongartist.songId = tsonglike.songId
            LEFT JOIN tartist ON tartist.artistId = tsongartist.artistId
			".$where." 
			GROUP BY tsonglike.songId 
			ORDER BY jumlah DESC 
			LIMIT $offset, $dataPerPage")->result();

		$datasonglike = [];

		foreach($getsonglike as $key => $songlike){
			
			$datasonglike[$key]['songId'] = $songlike->songId;
			$datasonglike[$key]['jumlah'] = $songlike->jumlah;
			$datasonglike[$key]['title'] = $songlike->title;
			$datasonglike[$key]['artist_name'] = $songlike->name;

			$query_label = $this->db->select('trecordlabel.recordLabel')
				->join('trecordlabel', 'trecordlabelsong.recordLabelId = trecordlabel.recordLabelId', 'left')
                ->get_where('trecordlabelsong', array('trecordlabelsong.songId' => $songlike->songId))
                ->row();
			$label = ($query_label ? $query_label->recordLabel : '');
			$datasonglike[$key]['label_name'] = $label;

			$query_arranger = $this->db->select('tarranger.arranger')
                ->join('tarranger', 'tarranger.arrangerId = tsongarranger.arrangerId', 'left')
                ->get_where('tsongarranger', array('tsongarranger.songId' => $songlike->songId))
                ->row();
            $arranger = ($query_arranger ? $query_arranger->arranger : '');
            $datasonglike[$key]['arranger_name'] = $arranger;

			$query_composer = $this->db->select('tcomposer.name')
				->join('tcomposer', 'tsongcomposer.composerId = tcomposer.composerId', 'left')
                ->get_where('tsongcomposer', array('tsongcomposer.songId' => $songlike->songId))
                ->row();
			$composer = ($query_composer ? $query_composer->name : '');
			$datasonglike[$key]['composer_name'] = $composer;
		}

		// Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php
		return result_object($datasonglike);
	}

	public function countDataLike($keyword = null)
	{
		
		if(!empty($keyword)) {
			$where = "WHERE (tsong.title LIKE '%".$keyword."%' ESCAPE '!' OR tartist.name LIKE '%".$keyword."%' ESCAPE '!')";
		} else {
			$where = "";
		}
		
		$query = $this->db->query("SELECT 1
			FROM tsonglike 
			INNER JOIN tsong ON tsong.songId = tsonglike.songId 
            LEFT JOIN tsongartist ON tsongartist.songId = tsonglike.songId
            LEFT JOIN tartist ON tartist.artistId = tsongartist.artistId
			".$where." 
			GROUP BY tsonglike.songId")->num_rows();
		
		return $query;
	}
}