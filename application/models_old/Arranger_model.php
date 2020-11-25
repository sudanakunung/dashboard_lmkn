<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Arranger_model extends MY_Model {
	
	public function getDataArranger($offset, $dataPerPage, $keyword = null)
	{
		if(!empty($keyword)) {
			$where = "WHERE arranger LIKE '%".$keyword."%' ESCAPE '!'";
		} else {
			$where = "";
		}

		$query = $this->db->query("SELECT * FROM tarranger $where ORDER BY arrangerId DESC LIMIT $offset, $dataPerPage")->result();

		return $query;
	}

	public function countDataArranger($keyword = null)
	{
		
		if(!empty($keyword)) {
			$where = "WHERE arranger LIKE '%".$keyword."%' ESCAPE '!'";
		} else {
			$where = "";
		}

		$query = $this->db->query("SELECT arrangerId FROM tarranger $where")->num_rows();

		return $query;
	}

	public function tambahDataArranger()
	{
		//Fungsi 'true' pada bagian input untuk melindungi post dari sql injection dengan mengamankan html special karakter
		$data = [
			'arranger' => $this->input->post('arranger_name', true),
			'referral' => $this->input->post('referral', true),
			'createdDate' => date('Y-m-d H:i:s')
		];

		$this->db->insert('tarranger', $data);
	}

	public function getArrangerById($id)
	{
		return $this->db->get_where('tarranger', ['arrangerId' => $id])->row_array();
	}

	public function ubahDataArranger()
	{
		$data = [
			'arrangerId' => $this->input->post('id', true),
			'arranger' => $this->input->post('arranger_name', true),
			'referral' => $this->input->post('referral', true)
		];

		$this->db->where('arrangerId', $this->input->post('id'));
		$this->db->update('tarranger', $data);
	}

	public function hapusDataArranger($id)
	{
		$this->db->delete('tarranger', ['arrangerId' => $id]);
	}
}