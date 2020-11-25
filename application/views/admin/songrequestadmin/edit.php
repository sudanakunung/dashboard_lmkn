<?php 
echo $this->session->flashdata('sukses_edit_song_request');
echo $this->session->flashdata('gagal_edit_song_request');

$data = array("songId" => $getDataEdit['songId'], "title" => $getDataEdit['title'], "artist" => $getDataEdit['artist'], "label" => $getDataEdit['label'], "composer" => $getDataEdit['composer']);

$aksi = "Edit";

echo '<h3 class="page-header"><b>'.$aksi.' Song Data</b></h3>';

buka_form( 'songuserrequest/aksiedit', $data['songId'], strtolower($aksi));

buat_textbox("Song Title", "title", $data['title'], "10", "text", "", "disabled");

$artist = array();
foreach ($getDataArtist as $dataArtist){
    $artist[] = array("cap" => $dataArtist->name, "val" => $dataArtist->artistId);
}

buat_combobox_HIDE("Artist", "artistId", $artist, $data['artist'], '4');

$label = array();
foreach ($getDataLabel as $dataLabel) {
    $label[] = array("cap" => $dataLabel->recordLabel, "val" => $dataLabel->recordLabelId);
}
buat_combobox_HIDE("Label", "recordLabelId", $label, $data['label'], $lebar = '4');

$composer = array();
foreach ($getDataComposer as $dataComposer) {
    $composer[] = array("cap" => $dataComposer->name, "val" => $dataComposer->composerId);
}
buat_combobox_HIDE("Composer", "composerId", $composer, $data['composer'], $lebar = '4');

tutup_form('songuserrequest/index');
?>

<script type="text/javascript">
	$(".artistId").chosen({no_results_text: "Tidak ditemukan....!"});
	$(".recordLabelId").chosen({no_results_text: "Tidak ditemukan....!"});
	$(".composerId").chosen({no_results_text: "Tidak ditemukan....!"});
</script>