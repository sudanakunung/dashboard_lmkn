<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Composer_model extends MY_Model {
	
	public function getAllDataComposer($offset, $dataPerPage, $keyword = null)
	{
		if(!empty($keyword)) {
			$where = "WHERE name LIKE '%".$keyword."%' ESCAPE '!'";
		} else {
			$where = "";
		}

		$query = $this->db->query("SELECT * FROM tcomposer $where ORDER BY name ASC LIMIT $offset, $dataPerPage")->result();

		return $query;
	}

	public function countDataComposer($keyword = null)
	{
		
		if(!empty($keyword)) {
			$where = "WHERE name LIKE '%".$keyword."%' ESCAPE '!'";
		} else {
			$where = "";
		}

		$query = $this->db->query("SELECT composerId FROM tcomposer $where ORDER BY name ASC")->num_rows();

		return $query;
	}

	public function tambahDataComposer()
	{
		//Fungsi 'true' pada bagian input untuk melindungi post dari sql injection dengan mengamankan html special karakter
		$data = [
			'name' => $this->input->post('name', true),
			'referral' => $this->input->post('referral', true)
		];

		$this->db->insert('tcomposer', $data);
	}

	public function getComposerById($id)
	{
		return $this->db->get_where('tcomposer', ['composerId' => $id])->row_array();
	}

	public function ubahDataComposer()
	{
		$data = [
			'composerId' => $this->input->post('id', true),
			'name' => $this->input->post('name', true),
			'referral' => $this->input->post('referral', true)
		];

		$this->db->where('composerId', $this->input->post('id'));
		$this->db->update('tcomposer', $data);
	}

	public function hapusDataComposer($id)
	{
		$this->db->delete('tcomposer', ['composerId' => $id]);
	}
}