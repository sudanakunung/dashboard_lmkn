<?php

if (!empty($this->session->flashdata('error_aksi_editadmin'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!! </b> <?= $this->session->flashdata('error_aksi_editadmin') ?></center> </div>
<?php endif;
$data   = array("recordingId" => $dataRecordingEdit->recordingId,"urlRecording" => $dataRecordingEdit->urlRecording,"urlRecordingFull" => $dataRecordingEdit->urlRecordingFull, "userId" => $dataRecordingEdit->userId, "songId" => $dataRecordingEdit->songId, "uploadDate" => $dataRecordingEdit->uploadDate, "status" => $dataRecordingEdit->status);
$aksi   = "Edit";
echo '<h3 class="page-header"><b>'.$aksi.' Status Recording</b></h3>';

buka_form("recordingadmin/aksiedit", $data['recordingId'], strtolower($aksi));
buat_textbox_readonly("userId","User Id", $data['userId'], "5", "text");
buat_textbox_readonly("songId","Song Id", $data['songId'], "5", "text");

echo '<div class="form-group"> 
		<label for="video" class="col-sm-2 control-label">Video Recording</label>
			<div class="col-sm-4">
				<video id=example-video width=300 height=150 class="video-js vjs-default-skin" controls> </video>
			</div>
		</div>';

buat_textbox_readonly("urlRecordingFull","Recordingu Url", $data['urlRecordingFull'], "5", "text");
$list = array(array("cap"=>"New","val"=>"N"),array("cap"=>"Process","val"=>"P"),array("cap"=>"Accept","val"=>"A"),array("cap"=>"Block","val"=>"X"));
buat_combobox("Status", "status", $list, $data['status'], '4');
tutup_form("recordingadmin/index");
?>
<link href="<?= base_url('plugin/dash/video-js.css'); ?>" rel="stylesheet">
<script src="<?= base_url('plugin/dash/video.js'); ?>"></script>
<script src="<?= base_url('plugin/dash/dash.all.debug.js'); ?>"></script>
<script src="<?= base_url('plugin/dash/videojs-dash.js'); ?>"></script>
<script>
    var player = videojs('example-video');

    player.ready(function() {
        player.src({
            src: '<?php echo $data['urlRecordingFull'];?>',
            type: 'application/dash+xml'
        });

    });
</script>