<?= $this->session->flashdata('sukses_aksi_approvesong'); ?>

<?= $this->session->flashdata('error_aksi_approvesong'); ?>

<?php
$totalRequest = $totalRequest->jumlah;
if($totalRequest == NULL or empty($totalRequest)){
    $totalRequest = 0;
}

$totalApprove = $totalApprove;
if($totalApprove == NULL or empty($totalApprove)){
    $totalApprove = 0;
}
?>

<h3 class="page-header" style="margin-bottom: 0;">
  <b>Song Request</b>
</h3>

<div class="row">
  <div class="panel-md col-md-6 col-lg-6 hidden-xs hidden-sm" style="margin-top:50px; ">
      <div class="panel panel-info dashboard-panel" style="background:transparent;border:none;-webkit-box-shadow:10px 7px 20px 0-5px rgba(122,217,255,.5);-moz-box-shadow:10px 7px 10px -5px rgb(122,217,255,.5);box-shadow:10px 7px 20px -5px rgb(122,217,255,.5);">
        <div class="panel-heading" style="font-size:70px;background-color:rgba(0,0,0,.4);line-height:70px;color:#ffff;">
          <img src="<?= base_url('image/dev2/ic_songs_2.png'); ?>" alt=""width="70px">
          <span class="pull-right" ><?= $totalRequest ?></span>
        </div>
        <div class="panel-body" style="color:#ffff;text-align:right;text-transform:uppercase;font-weight:700;background-color:#1840c3;">
          Total Request Song From Publisher / Label
        </div>
      </div>
  </div>

  <div class="panel-md col-md-6 col-lg-6 hidden-xs hidden-sm" style="margin-top:50px; ">
      <div class="panel panel-info dashboard-panel" style="background:transparent;border:none;-webkit-box-shadow:10px 7px 20px 0-5px rgba(122,217,255,.5);-moz-box-shadow:10px 7px 10px -5px rgb(122,217,255,.5);box-shadow:10px 7px 20px -5px rgb(122,217,255,.5);">
        <div class="panel-heading" style="font-size:70px;background-color:rgba(0,0,0,.4);line-height:70px;color:#ffff;">
          <img src="<?= base_url('image/dev2/ic_songs_2.png'); ?>" alt=""width="70px">
          <span class="pull-right"><?= $totalApprove ?></span>
        </div>
        <div class="panel-body" style="color:#ffff;text-align:right;text-transform:uppercase;font-weight:700;background-color:#1840c3;">
          Total Music
        </div>
      </div>
  </div>

  <div class="panel-xs col-xs-12 col-sm-12 hidden-md hidden-lg">
    <div class="panel panel-info dashboard-panel" style="background: transparent;">
      <div class="panel-heading" style="font-size: 30px; background-color:rgba(0,0,0,0.4); color:#ffff; line-height:30px;">
        <img src="<?= base_url('image/dev2/ic_songs_2.png'); ?>" alt=""width="30px">
        <span class="pull-right"><?= $totalRequest ?></span>
      </div>
      <div class="panel-body" style="text-align: right; text-transform: uppercase; font-weight: bold; background-color: #1840c3; color:#ffff; line-height:10px;">
        Total Request Song From Publisher / Label
      </div>
    </div>
  </div>

  <div class="panel-xs col-xs-12 col-sm-12 hidden-md hidden-lg">
    <div class="panel panel-info dashboard-panel" style="background: transparent;">
      <div class="panel-heading" style="font-size: 30px; background-color:rgba(0,0,0,0.4); color:#ffff; line-height:30px;">
        <img src="<?= base_url('image/dev2/ic_songs_2.png'); ?>" alt=""width="30px">
        <span class="pull-right"><?= $totalApprove ?></span>
      </div>
      <div class="panel-body" style="text-align: right; text-transform: uppercase; font-weight: bold; background-color: #1840c3; color:#ffff; line-height:10px;">
        Total Music
      </div>
    </div>
  </div>
</div>

<div class="card mb-20">
  <div class="card-header">
    <div class="row">
      <div class="col-md-4 pull-right">
        <?= form_search(base_url('songrequestadminlabel/index'), 'keyword', 'Search Title'); ?>
      </div>
    </div>
  </div>

  <?php
    if($dataSongRequest) {
        buka_tabel(array("Song Id", "Title","Requested by", "Update"), $no_action = false);

        foreach ($dataSongRequest as $request){

          isi_tabel_request(++$start, array($request->songId, $request->title, $request->label),base_url("songrequestadminlabel/aksiapprove"), base_url("songrequestadminlabel/aksidecline"), $request->tsongrequestId, true, true);
            
        }

        tutup_tabel();
    } else { ?>
        <div class="row">
            <div class="col-md-12 text-center mb-10">
                <?php 
                $msg = (isset($_GET['keyword']) ? 'The data you are looking for was not found' : 'Data is still empty');
                ?>
                <h3><?= $msg; ?></h3>
            </div>
        </div>
    <?php
    }
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

<script type="text/javascript">
  $(window).load(function() {
    $(".load_button").hide();
    $(".action_buttons").removeClass("hide");
  });
</script>

