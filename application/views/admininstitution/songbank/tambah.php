<?php 
$data = array("ArtistName" => "");
?>
<form method="post" action="<?= base_url('songbankadminartist/aksitambah'); ?>">
	<h3 class="page-header">
		<b>Please choose your song</b>
		<button type="submit" class="btn btn-primary btn-sm pull-right top-button"><i class="glyphicon glyphicon-plus-sign"></i> Save song </button>
	</h3>

	<div class="row mb-15">
		<?php
		$artistname = array();
		foreach ($getArtistData as $artist) {
		        $artistname[] = array("cap" => $artist->name, "val" => $artist->artistId);
		}
		buat_combobox("Artist Name", "ArtistName", $artistname, $data['ArtistName'], $lebar = '4');
		?>
	</div>

	<div class="card mb-20" style="background: #eee;">
		<div id="resultTable">
		</div>
	</div>

</form>

<script type="text/javascript">
	$("#ArtistName").chosen({no_results_text: "Tidak ditemukan....!"});

	$("#ArtistName").on('change', function postinput(){
        var artistId = $(this).val();
        $.ajax({
		  	type: "POST",
		 	url: "<?= base_url('songbankadminartist/getDataSongArtist'); ?>",
		  	data: { artistId: artistId },
		  	success: function(response){
                $('#resultTable').html(response);
		  	} 
		});   
    });
</script>