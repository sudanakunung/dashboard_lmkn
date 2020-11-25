<?php
echo '<div class="row">';

echo          '<div class="col-md-6 col-lg-6 hidden-sm hidden-xs">
        <div class="panel panel-info dashboard-panel">
            <div class="panel-heading" style="font-size: 70px; line-height: 70px">
                <i class="glyphicon glyphicon-music"></i>
                <span class="pull-right">' . $totalLagu->jumlah . '</span>
            </div>
            <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">
                Jumlah Lagu
            </div>
        </div>
    </div>';

echo         '<div class="col-md-6 col-lg-6 hidden-sm hidden-xs">
        <div class="panel panel-info dashboard-panel">
            <div class="panel-heading" style="font-size: 70px; line-height: 70px">
                <i class="glyphicon glyphicon-user"></i>
                <span class="pull-right">' .$totalArtist->jumlah. '</span>
            </div>
            <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">
                Jumlah Artist Yang Terdaftar
            </div>
        </div>
    </div>';

echo         '<div class="col-xs-12 col-sm-12 hidden-md hidden-lg">
        <div class="panel panel-info dashboard-panel">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-music"></i>
                <span class="pull-right"><b>' . $totalLagu->jumlah . '</b></span>
            </div>
            <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">
                Jumlah Lagu
            </div>
        </div>
    </div>';

echo        '<div class="col-xs-12 col-sm-12 hidden-md hidden-lg">
        <div class="panel panel-info dashboard-panel">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-user"></i>
                <span class="pull-right"><b>' .$totalArtist->jumlah. '</b></span>
            </div>
            <div class="panel-body" style="text-align: center; text-transform: uppercase;font-weight: bold">
                Jumlah Artist Yang Terdaftar
            </div>
        </div>
    </div>';

echo     '</div>';
