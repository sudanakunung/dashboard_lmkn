<h3 class="page-header">
	<b>Music</b>
</h3>

<div class="card mb-20">
	<div class="card-header">
		<div class="row">
			
			<?php 
			if($this->session->userdata('admincountry') == "ind" || $this->session->userdata('admincountry') == ""){ ?>
				<div class="col-md-4 pull-left">
					<form action="<?= base_url('songadmin/index'); ?>" method="GET">
						<select name="musiclangcode" class="form-control" onChange="this.form.submit()">
							<option value="">Music From All Country</option>
							<?php
							$musiclangcode = $this->input->get('musiclangcode');
							
							foreach ($dataLang as $value) {
								if($musiclangcode){
									if($value->langCode == $musiclangcode){
										echo "<option value=\"$value->langCode\" selected>$value->name</option>";
									} else {
										echo "<option value=\"$value->langCode\">$value->name</option>";
									}
								} 
								else if($this->session->userdata('admincountry') <> ""){
									if($value->langCode == $this->session->userdata('admincountry')){
										echo "<option value=\"$value->langCode\" selected>$value->name</option>";
									} else {
										echo "<option value=\"$value->langCode\">$value->name</option>";
									}
								} 
								else {
									echo "<option value=\"$value->langCode\">$value->name</option>";
								}
							}
							?>
						</select>
					</form>
				</div>
			<?php
			}
			?>

			<div class="col-md-4 pull-right">
				<?= form_search(base_url('songadmin/index'), 'keyword', 'Search Title or Artist', array('name' => 'musiclangcode', 'value' => $this->input->get('musiclangcode'))); 
				?>
			</div>
		</div>
	</div>

	<?php
	buka_tabel(array("Title", "Artist", "Label", "Composer", "Content Provider", "Cover Image"), $action = true);
	
	foreach ($dataSong as $song){

		isi_tabel_admin(++$start, array($song->title, $song->artist, $song->label, $song->composer, $song->arranger, substr($song->coverImage, 0,30)), base_url('songadmin/edit'), "", $song->songId, true, false);
	}

	tutup_tabel();
	?>

	<div class="card-footer">
		<div class="col-md-6">
			<p class="total-data">Total : <?= $total_data; ?></p>
		</div>
		<div class="col-md-6">
			<?= $this->pagination->create_links(); ?>
		</div>
		<div class="clearfix"></div>
	</div>

</div>