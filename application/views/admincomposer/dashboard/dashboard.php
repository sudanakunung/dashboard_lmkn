<?php
$totalUser = $totalUser->jumlah;
if($totalUser == NULL or empty($totalUser)){
    $totalUser = 0;
}

$totalLagu = $totalLagu->jumlah;
if($totalLagu == NULL or empty($totalLagu)){
    $totalLagu = 0;
}

$totalAdmin = $totalAdmin->jumlah;
if($totalAdmin == NULL or empty($totalAdmin)){
    $totalAdmin = 0;
}

$totalComposer = $totalComposer->jumlah;
if($totalComposer == NULL or empty($totalComposer)){
    $totalComposer = 0;
}

echo '<div class="row">';
//tag untuk membuat tampilan jumlah user mydiosing
echo       '<div class="col-md-6 col-lg-6 hidden-xs hidden-sm" style="margin-top:50px; ">
<div class="panel panel-info dashboard-panel" style="background:transparent;border:none;
-webkit-box-shadow: 10px 7px 20px 0-5px rgba(122, 217, 255, 0.5);
-moz-box-shadow: 10px 7px 10px -5px rgb(122, 217, 255, 0.5);
box-shadow: 10px 7px 20px -5px rgb(122, 217, 255, 0.5);">
                <div class="panel-heading " style=";font-size: 70px; background-color: rgba(0, 0, 0, 0.4); line-height: 70px ;color:#ffff;">
                <img src="image/dev2/ic_user_2.png" alt=""width="70px">
                        <span class="pull-right" >' . $totalUser . '</span>
                    </div>
                    <div class="panel-body" style="color:#ffff; text-align: right; text-transform: uppercase;font-weight: bold ;   background-color: #1840c3;">
                    Total User
                </div>
            </div>
           </div>';
echo       '<div class="col-xs-12 col-sm-12 hidden-md hidden-lg">
                <div class="panel panel-info dashboard-panel"style="background:transparent">
                    <div class="panel-heading" style="font-size: 30px;background-color:rgba(0,0,0,0.4);color:#ffff;line-height:30px">
                    <img src="image/dev2/ic_user_2.png" alt=""width="30px">
                        <span class="pull-right">' . $totalUser . '</span>
                    </div>
                    <div class="panel-body" style="text-align: right; text-transform: uppercase;font-weight: bold ;   background-color: #1840c3;color:#ffff;line-height:10px;"">
                    Total User
                </div>
            </div>
           </div>';
//akhir tag untuk membuat jumlah user mydiosing

//tag untuk membuat jumlah lagu mydiosing
echo     '<div class="col-md-6 col-lg-6 hidden-xs hidden-sm "style="margin-top:50px;">
              <div class="panel panel-info dashboard-panel" style="background:transparent;border:none;border-radius: 12px 12px;
              -webkit-box-shadow: 10px 7px 20px 0-5px rgba(122, 217, 255, 0.5);
              -moz-box-shadow: 10px 7px 10px -5px rgb(122, 217, 255, 0.5);
              box-shadow: 10px 7px 20px -5px rgb(122, 217, 255, 0.5);">
                <div class="panel-heading" style="font-size: 70px; background-color: rgba(0, 0, 0, 0.4); line-height: 70px;color:#ffff;">
                <img src="image/dev2/ic_songs_2.png" alt=""width="70px">
                       <span class="pull-right">' . $totalLagu . '</span>
                </div>
                <div class="panel-body" style="text-align: right; text-transform: uppercase;font-weight: bold ;   background-color: #1840c3;color:#ffff;">
                    Total Song
                </div>
              </div>
           </div>';
echo     '<div class="col-xs-12 col-sm-12 hidden-md hidden-lg">
            <div class="panel panel-info dashboard-panel"style="background:transparent">
            <div class="panel-heading" style="font-size: 30px;background-color:rgba(0,0,0,0.4);color:#ffff;line-height:30px">
            <img src="image/dev2/ic_songs_2.png" alt=""width="30px">
                       <span class="pull-right">' . $totalLagu . '</span>
                </div>
                <div class="panel-body" style="text-align: right; text-transform: uppercase;font-weight: bold ;   background-color: #1840c3;color:#ffff;line-height:10px;">
                    Total Song
                </div>
              </div>
           </div>';
//akhir tag untuk buat tampilan jumlah lagu

//akhir tag row
echo  '</div>';

//tag row untuk buat baris (row)  tampilan
echo '<div class="row">';

//tag membuat tampilan jumlah label
echo  '<div class="col-md-6 col-lg-6 hidden-xs hidden-sm">
<div class="panel panel-info dashboard-panel" style="background:transparent;border:none;
-webkit-box-shadow: 10px 7px 20px 0-5px rgba(122, 217, 255, 0.5);
-moz-box-shadow: 10px 7px 10px -5px rgb(122, 217, 255, 0.5);
box-shadow: 10px 7px 20px -5px rgb(122, 217, 255, 0.5);">
                <div class="panel-heading" style="font-size: 70px; background-color: rgba(0, 0, 0, 0.4); line-height: 70px;color:#ffff;">
                <img src="image/dev2/ic_composer_2.png" alt=""width="70px">
                        <span class="pull-right">' . $totalComposer . '</span>
                    </div>
                    <div class="panel-body" style="text-align: right; text-transform: uppercase;font-weight: bold ;   background-color: #1840c3;color:#ffff;">
                    Total Composer
                </div>
            </div>
           </div>';
echo  '<div class="col-sm-12 col-xs-12 hidden-md hidden-lg">
<div class="panel panel-info dashboard-panel"style="background:transparent">
<div class="panel-heading" style="font-size: 30px;background-color:rgba(0,0,0,0.4);color:#ffff;line-height:30px">
<img src="image/dev2/ic_composer_2.png" alt=""width="30px">
                        <span class="pull-right">' . $totalComposer . '</span>
                    </div>
                    <div class="panel-body" style="text-align: right; text-transform: uppercase;font-weight: bold ;   background-color: #1840c3;color:#ffff;line-height:10px;"">
                    total Composer
                </div>
            </div>
           </div>';
//akhir tag jumlah tabel

//tag untuk jumlah admin yang
echo     '<div class="col-md-6 col-lg-6 hidden-xs hidden-sm">
<div class="panel panel-info dashboard-panel" style="background:transparent;border:none;
-webkit-box-shadow: 10px 7px 20px 0-5px rgba(122, 217, 255, 0.5);
-moz-box-shadow: 10px 7px 10px -5px rgb(122, 217, 255, 0.5);
box-shadow: 10px 7px 20px -5px rgb(122, 217, 255, 0.5);">
                 <div class="panel-heading" style="font-size: 70px; background-color: rgba(0, 0, 0, 0.4); line-height: 70px;color:#ffff;">
                 <img src="image/dev2/ic_admin_2.png" alt=""width="70px">
                       <span class="pull-right">' . $totalAdmin . '</span>
                </div>
                <div class="panel-body" style="text-align: right; text-transform: uppercase;font-weight: bold ;   background-color: #1840c3;color:#ffff;">
                  total admin
                </div>
              </div>
           </div>';

echo     '<div class="col-sm-12 col-xs-12 hidden-md hidden-lg">
<div class="panel panel-info dashboard-panel"style="background:transparent">
<div class="panel-heading" style="font-size: 30px;background-color:rgba(0,0,0,0.4);color:#ffff;line-height:30px">
<img src="image/dev2/ic_admin_2.png" alt=""width="30px">
                       <span class="pull-right">' . $totalAdmin . '</span>
                </div>
                <div class="panel-body" style="text-align: right; text-transform: uppercase;font-weight:bold ;   background-color: #1840c3;color:#ffff;line-height:10px;"">
                    total Admin
                </div>
              </div>
           </div>';
//akhir tag jumlah admin yg terdaftar
echo  '</div>';
?>
