<?= $this->session->flashdata('sukses_aksi_editlagu'); ?>

<?= $this->session->flashdata('error_aksi_editlagu'); ?>

<?php
$data = array("songId"=>$dataEditSong->songId, "title"=>$dataEditSong->title, "description"=>$dataEditSong->description,"cover"=>$dataEditSong->coverImage, "artistId"=>$dataEditSong->artistId, "recordLabelId"=>$dataEditSong->recordLabelId, "arrangerId"=>$dataEditSong->arrangerId, "composerId"=>$dataEditSong->composerId);

$aksi = "Edit";

echo '<h3 class="page-header"><b>'.$aksi.' Music</b></h3>';

buka_form("songadmininstitution/aksiedit", $data['songId'], strtolower($aksi));
buat_textbox("Title", "judul", $data['title'], "10","text", "Judul","required");
buat_upload("Image Cover", "cover", $data['cover'], "10","file", "");

if($this->session->userdata('lembaga') == 'SELMI'){
	
	$artist = array();
	foreach ($dataArtist as $valartist){
		$artist[] = array("cap" => $valartist->name, "val" => $valartist->artistId);
	}
	buat_combobox("Artist Name", "artistId", $artist, $data['artistId'], '4');
	
	$label = array();
	foreach ($dataLabel as $vallabel){
	    $label[] = array("cap" => $vallabel->recordLabel, "val" => $vallabel->recordLabelId);
	}
	buat_combobox("Publisher/Label", "recordLabelId", $label, $data['recordLabelId'], '4');
	
	$arranger = array();
	foreach ($dataArranger as $valarranger){
	    $arranger[] = array("cap" => $valarranger->arranger, "val" => $valarranger->arrangerId);
	}
	buat_combobox("Content Provider", "arrangerId", $arranger, $data['arrangerId'], '4');

}
else if($this->session->userdata('lembaga') == 'KCI' || $this->session->userdata('lembaga') == 'RAI'){
	
	$composer = array();
	foreach ($dataComposer as $valcomposer){
	    $composer[] = array("cap" => $valcomposer->name, "val" => $valcomposer->composerId);
	}
	buat_combobox("Composer", "composerId", $composer, $data['composerId'], '4');
	
}
else if($this->session->userdata('lembaga') == 'WAMI'){
	
	$artist = array();
	foreach ($dataArtist as $valartist){
		$artist[] = array("cap" => $valartist->name, "val" => $valartist->artistId);
	}
	buat_combobox("Artist Name", "artistId", $artist, $data['artistId'], '4');
	
	$label = array();
	foreach ($dataLabel as $vallabel){
	    $label[] = array("cap" => $vallabel->recordLabel, "val" => $vallabel->recordLabelId);
	}
	buat_combobox("Publisher/Label", "recordLabelId", $label, $data['recordLabelId'], '4');
	
} else {
	
	$artist = array();
	foreach ($dataArtist as $valartist){
		$artist[] = array("cap" => $valartist->name, "val" => $valartist->artistId);
	}
	buat_combobox("Artist Name", "artistId", $artist, $data['artistId'], '4');

}

buat_textarea("Description", "description", $data['description'], "richtext");

tutup_form("songadmininstitution/index"); ?>

<script>
	$("#artistId").chosen({no_results_text: "Tidak ditemukan....!"});
</script>