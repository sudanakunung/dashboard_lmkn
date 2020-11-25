<?= $this->session->flashdata('sukses_aksi_editsongbank') ?>

<h3 class="page-header">
	<b>Update Song Data</b>
</h3>

<?php 
$data = array("songId" => $getDataEdit['songId'], "title" => $getDataEdit['title'], "artist" => $getDataEdit['artist'], "label" => $getDataEdit['label'], "composer"=> $getDataEdit['composer'],  "arranger"=> $getDataEdit['arranger']);
?>

<?php 
buka_form('songbankadmin/aksiedit', $data['songId'], 'Edit');
	buat_textbox_readonly('Title', 'title', $data['title'], $lebar='4', $type='text');

	$artist = array();
	foreach ($getArtist as $dataArtist) {
	    $artist[] = array("cap" => $dataArtist->name, "val" => $dataArtist->artistId);
	}
	buat_combobox('Artist', 'artistId', $artist, $data['artist'], $lebar='4', $readonly="");

	$label = array();
	foreach ($getLabel as $dataLabel) {
	    $label[] = array("cap" => $dataLabel->recordLabel, "val" => $dataLabel->recordLabelId);
	}
	buat_combobox('Label', 'recordLabelId', $label, $data['label'], $lebar='4', $readonly="");

	$arranger = array();
	foreach ($getArranger as $dataArranger) {
	    $arranger[] = array("cap" => $dataArranger->arranger, "val" => $dataArranger->arrangerId);
	}
	buat_combobox('Arranger', 'arrangerId', $arranger, $data['arranger'], $lebar='4', $readonly="");

	$composer = array();
	foreach ($getComposer as $dataComposer) {
	    $composer[] = array("cap" => $dataComposer->name, "val" => $dataComposer->composerId);
	}
	buat_combobox('Composer', 'composerId', $composer, $data['composer'], $lebar='4', $readonly="");
tutup_form('songbankadmin/index');
?>