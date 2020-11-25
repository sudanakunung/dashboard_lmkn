<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Adminadmin_model extends MY_Model{

    public function getDataAdmin($offset, $dataPerPage, $keyword = null)
    {
        
        if (!empty($keyword)) {
            $where = "AND username LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        if ($this->session->userdata('admincountry') == 'ind') {
            $WherelangCode = "WHERE langCode = 'ind'";
        } 
        else if ($this->session->userdata('admincountry') == 'phi') {
            $WherelangCode = "WHERE langCode = 'phi'";
        } 
        else {
            $WherelangCode = "";
        }

        $query = $this->db->query("SELECT adminId, username, lembaga, roleId, email, artistId, recordLabelId, arrangerId, composerId FROM tadmin $WherelangCode $where ORDER BY adminId ASC LIMIT $offset, $dataPerPage")->result();

        $dataAdmin = [];

        foreach($query as $key => $val){
            
            $dataAdmin[$key]['adminId'] = $val->adminId;
            $dataAdmin[$key]['username'] = $val->username;
            $dataAdmin[$key]['lembaga'] = $val->lembaga;
            $dataAdmin[$key]['roleId'] = $val->roleId;
            $dataAdmin[$key]['email'] = $val->email;
            $dataAdmin[$key]['artistId'] = $val->artistId;
            $dataAdmin[$key]['recordLabelId'] = $val->recordLabelId;
            $dataAdmin[$key]['arrangerId'] = $val->arrangerId;
            $dataAdmin[$key]['composerId'] = $val->composerId;

            $query_artist = $this->db->select('name')
                ->get_where('tartist', array('artistId' => $val->artistId))
                ->row();
            $dataAdmin[$key]['artist_name'] = ($query_artist ? $query_artist->name : '');

            $query_label = $this->db->select('recordLabel')
                ->get_where('trecordlabel', array('recordLabelId' => $val->recordLabelId))
                ->row();
            $dataAdmin[$key]['label_name'] = ($query_label ? $query_label->recordLabel : '');

            $query_arranger = $this->db->select('arranger')
                ->get_where('tarranger', array('arrangerId' => $val->arrangerId))
                ->row();
            $dataAdmin[$key]['arranger_name'] = ($query_arranger ? $query_arranger->arranger : '');

            $query_composer = $this->db->select('name')
                ->get_where('tcomposer', array('composerId' => $val->composerId))
                ->row();
            $dataAdmin[$key]['composer_name'] = ($query_composer ? $query_composer->name : '');
        }

        // Fungsi result object ada pada folder helper dengan nama file resultobject_helper.php
        return result_object($dataAdmin);
    }

    public function countDataAdmin($keyword = null)
    {
        
        if(!empty($keyword)) {
            $where = "WHERE username LIKE '%".$keyword."%' ESCAPE '!'";
        } else {
            $where = "";
        }

        $query = $this->db->query("SELECT adminId, username, lembaga, roleId, email, artistId, recordLabelId, composerId FROM tadmin $where ORDER BY adminId ASC")->num_rows();

        return $query;
    }

    public function getLabelNameFromArtist($artistId){
        $sql = "SELECT DISTINCT trecordlabel.recordLabel as label FROM trecordlabel
                                          INNER JOIN trecordlabelsong ON trecordlabelsong.recordLabelId = trecordlabel.recordLabelId
                                          INNER JOIN tsongartist ON trecordlabelsong.songId = tsongartist.songId WHERE tsongartist.artistId = ?";
        $data = $this->db->query($sql, array($artistId))->result();
        return $data;
    }

    public function getLabelName($recordLabelId){
        $sql = "SELECT DISTINCT trecordlabel.recordLabel FROM trecordlabel 
                WHERE trecordlabel.recordLabelId = ?";
        $data = $this->db->query($sql, array($recordLabelId))->result();
        return $data;
    }

    public function getDataCombobox(){
        $sql = "SELECT DISTINCT artistId, name FROM tartist WHERE  referral = 1 AND artistId NOT IN (SELECT artistId FROM tadmin) ORDER BY name ASC";
        $data = $this->db->query($sql, array())->result();
        return $data;

    }

    public function getLabel(){
        $sql = "SELECT recordLabelId, recordLabel FROM trecordlabel";
        $data = $this->db->query($sql, array())->result();
        return $data;

    }

    public function getComposer(){
        $sql = "SELECT composerId, name FROM tcomposer";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }

    public function getArranger(){
        $sql = "SELECT arrangerId, arranger FROM tarranger";
        $data = $this->db->query($sql, array())->result();
        return $data;
    }

    public function tambahadmin($username,$email,$password,$roleId,$artistId,$labels,$arrangerId,$composerId,$roleIdLMK,$lembaga,$langCode)
    {
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;

        if($roleId == 0){
            $artistId = $artistId;
        }
        else{
            //  jika tidak artistId diisi sesuai form
            $artistId = 0;
        }

        if($roleId == 2){
            $recordLabelId = $labels;
        }
        else{
            $recordLabelId = 0;
        }

        if($roleId == 3){
            $composerId = $composerId;
        }
        else{
            $composerId = 0;
        }

        if($roleId == 7){
            $arrangerId = $arrangerId;
        }
        else{
            $arrangerId = 0;
        }

		// roldeId dibuat seolah olah memiliki nilai sama dengan trole, padahal tidak sama sekali, hanya untuk form saja
		// buat seolah jika roleId 1 (admin) atau roleId 0 (artist) maka set label menjadi 0

        // buat default jika yg dibuat label, roleId bernilai 0
        if($roleId == 2 or $roleId == '2'){
            $roleId = 0;
        }

        // buat roleId untuk admin LMK jika yang dipilih adalah LMK
        if($roleId == 4 or $roleId == '4'){
            $roleId = $roleIdLMK;
            $lembaga = $lembaga;
        }
        else {
            $roleId = $roleId;
            $lembaga = Null;
        }

        $hasing = genHash($username,$password);

        $sql = "INSERT INTO tadmin (username,password,artistId,email,roleId,recordLabelId,arrangerId,composerId,lembaga,langCode) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $data = $this->db->query($sql, array($username,$hasing,$artistId,$email,$roleId,$recordLabelId,$arrangerId,$composerId,$lembaga,$langCode));

        $this->db->db_debug = $db_debug;
        return $data;

    }
	
	//note
	//roleid = 0 = artist
	//roleid = 1 = admin
	//roleid = 2 = label (tetapi nilainnya 0 bukan 2, itu hanya untuk tanda posisi saja di combobox)
	//roleid = 3 = composer
    //roleid = 4 = adminartist
    //roleid = 5 = adminlabel
    //roleid = 6 = admincomposer

    public function getDataEdit($adminId){
        $sql = "SELECT adminId, username, artistId, email, roleId, recordLabelId, composerId, arrangerId, lembaga FROM tadmin WHERE adminId = ?";

        $datas = $this->db->query($sql, array($adminId))->row();

        if($datas == null){
            return null;
        }

        if($datas->roleId == 2){
            redirect(base_url('adminadmin/index'));
        }

        if($datas->artistId > 0){
            $data = array("adminId" => $datas->adminId, "username" => $datas->username, "artistId"=> $datas->artistId,"email"=>$datas->email, "password"=>"","roleId"=>0,"recordLabelId"=>$datas->recordLabelId, "arrangerId"=>$datas->arrangerId, "composerId"=>$datas->composerId, "lembaga"=>$datas->lembaga);
        }
        elseif($datas->recordLabelId > 0){
            $data = array("adminId" => $datas->adminId, "username" => $datas->username, "artistId"=> $datas->artistId,"email"=>$datas->email, "password"=>"","roleId"=>2,"recordLabelId"=>$datas->recordLabelId, "arrangerId"=>$datas->arrangerId, "composerId"=>$datas->composerId, "lembaga"=>$datas->lembaga);
        }
        elseif($datas->composerId > 0){
            $data = array("adminId" => $datas->adminId, "username" => $datas->username, "artistId"=> $datas->artistId,"email"=>$datas->email, "password"=>"","roleId"=>3,"recordLabelId"=>$datas->recordLabelId, "arrangerId"=>$datas->arrangerId, "composerId"=>$datas->composerId, "lembaga"=>$datas->lembaga);
        }
        elseif($datas->arrangerId > 0){
            $data = array("adminId" => $datas->adminId, "username" => $datas->username, "artistId"=> $datas->artistId,"email"=>$datas->email, "password"=>"","roleId"=>7,"recordLabelId"=>$datas->recordLabelId, "arrangerId"=>$datas->arrangerId, "composerId"=>$datas->composerId, "lembaga"=>$datas->lembaga);
        }
        else{
            $data = array("adminId" => $datas->adminId, "username" => $datas->username, "artistId"=> $datas->artistId,"email"=>$datas->email, "password"=>"","roleId"=>$datas->roleId,"recordLabelId"=>$datas->recordLabelId, "arrangerId"=>$datas->arrangerId, "composerId"=>$datas->composerId, "lembaga"=>$datas->lembaga);
        }

        return $data;

    }

    public function getDataComboboxEdit(){
        $sql    = "SELECT DISTINCT artistId, name FROM tartist WHERE referral = 1 ORDER BY name ASC";
        $data   = $this->db->query($sql)->result();

        return $data;
    }

    public function editAdmin($username,$artistId,$email,$hasing,$roleId,$recordLabelId,$arrangerId,$adminId,$composerId,$lembaga){
        
        $db_debug = $this->db->db_debug;
        $this->db->db_debug = FALSE;
        
        if($this->session->userdata('admincountry') <> ''){
             $sql = "UPDATE tadmin SET username = ?, artistId = ?, email = ?, password = ?, roleId = ?,recordLabelId = ?,arrangerId = ?, composerId = ?, lembaga = ? WHERE adminId = ?";
             $data = $this->db->query($sql, array($username,$artistId,$email,$hasing,$roleId,$recordLabelId,$arrangerId,$composerId,$lembaga,$adminId));
        } else {
             $sql = "UPDATE tadmin SET username = ?, email = ?, password = ? WHERE adminId = ?";
             $data = $this->db->query($sql, array($username,$email,$hasing,$adminId));
        }
        
        $this->db->db_debug = $db_debug;
        return $data;
    }

    public function hapusAdmin($adminId){
        $sql = "SELECT adminId, username, artistId, email, roleId, recordLabelId FROM tadmin WHERE adminId = ?";
        $datas = $this->db->query($sql, array($adminId))->row();

        if($datas->roleId != 1){
            $sql = "DELETE FROM tadmin WHERE adminId = ?";
            $data = $this->db->query($sql, array($adminId));
            return $data;
        }
        else{
            $this->session->set_flashdata('error_aksi_hapusadmin', 'Data Admin tidak boleh dihapus');
            redirect(base_url('adminadmin/index'));
        }       
    }

}






