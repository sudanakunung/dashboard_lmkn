<!DOCTYPE html>
<html>
<head>

    <title>
        Musicpreneurship
    </title>


    <meta charset="utf-8"/>
    <meta name="Description" content="MYDIOSING, MUSIK BAGUS" />
    <meta name="Keywords" content="?mydiosing, musik bagus, musik glan fradly, mydiosing, karaoke online, karoke, karaoke"/>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo LOGOICO;?>">
    <meta name="viewport" content="width = device-width, initial-scale = 1, maximum-scale = 1.0"/>
    <link rel="stylesheet" type="text/css" href="<?= base_url('plugin/css/bootstrap.min.css'); ?> ">
    <link rel="stylesheet" type="text/css" href="<?= base_url('plugin/css/jquery.dataTables.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('plugin/css/jquery-ui.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('plugin/css/chosen.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('plugin/css/chosen.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('plugin/css/jquery-ui.theme.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('plugin/css/mystyless.css'); ?> ">
    <script src="<?= base_url('plugin/js/Chart.bundle.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugin/js/Chart.bundle.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugin/js/Chart.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugin/js/Chart.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugin/js/jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugin/js/jquery_new.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugin/js/jquery-ui.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugin/js/jquery-ui.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugin/js/jquery.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugin/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
    <!--<script src="--><?//= base_url('plugin/js/jquery-1.11.3-jquery.min.js'); ?><!--" type="text/javascript"></script>-->
    <script src="<?= base_url('plugin/js/chosen.jquery.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url('plugin/js/chosen.jquery.min.js'); ?>" type="text/javascript"></script>
    <script src="<?= base_url("plugin/js/range_date.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("plugin/js/dataTables.bootstrap.min.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("plugin/js/jquery.dataTables.min.js"); ?>" type="text/javascript"></script>

    <script src="<?= base_url("plugin/js/jquery.bootpag.js"); ?>" type="text/javascript"></script>
    <script src="<?= base_url("plugin/js/jquery.bootpag.min.js"); ?>" type="text/javascript"></script>
    <style type="text/css">
        *{
            border: 0px;
            margin: 0px;
            padding: 0px;
        }
		
		.btn:hover{
			background-color:blue;
		}

        #<?php echo $halaman; ?>{
            background-color: white;
        }
        
        .menu-header-top{
            color: #fff;
        }

        .menu-header-top:hover{
            color: #005ce6;
        }

        .menu-header, .menu-header:hover{
            color: #005ce6;
        }

        .custom-nav{
            margin-top: 25px;
        }

        .logo-custom{
            margin-left:0;
            margin-top:-15%
        }

        #content{
            margin-left: 18%;
        }

        .dataTables_info{
            display: none;
        }

        .dataTables_length {
            display: none;
        }
        
        @media only screen and (max-width: 414px) {
            .menu-header{
                color: #fff;
            }

            .menu-header:hover{
                color: #005ce6;
            }

            #<?php echo $halaman; ?> .menu-header{
                color: #005ce6; 
            }
        }

        @media screen and (max-width: 768px) {
            .custom-nav {
                margin-top: 0;
            }
            .logo-custom{
                margin-left: -10px;
                margin-top: -27%;
            }
            #content{
                margin-left: 0;
            }
        }
    </style>
</head>

<body style="background-image: url('<?php echo base_url('image/dev2/bg_2.png')?>'); no-repeat center center fixed; #fff;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        background-attachment:fixed;
          " class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="container-fluid">
    <div class="row">
        <nav class="navbar navbar-fixed-top" style="background-image: url('<?php echo base_url('image/dev2/bg_2.png')?>');background-size: cover; border-bottom: solid; border-width: 0.1px; border-bottom-color: #292f33; ">
            <div>
                <?php $this->load->view('menu'); ?>
            </div>
        </nav>
    </div>
<!--    <section>-->
<!--        <div class="row">-->
            <div class="col-md-2 col-sm-3 hidden-xs sidebar" style="width: 18.666667%;">
                <div class="col-md-12 col-sm-12 col-xs-12"  align="center" style=" border-bottom: solid; border-width: 0.1px; border-bottom-color: #292f33;color:#ffff">
                    <?php $this->load->view('profile'); ?>
                </div>
<!--                <hr align="right" width="100%" />-->
                <div class="col-md-12 col-sm-12 col-xs-12" align="center" style="margin-top: 5px;">
                    <?php $this->load->view('sidebar'); ?>
                </div>
            </div>
            <div id="content" class="col-md-10 col-sm-9 col-sm-offset-3" style="margin-top: 80px;">
                <?php $this->load->view($mainview); ?>
            </div>
<!--        </div>-->
<!--    </section>-->
</div>
<script src="<?= base_url("plugin/js/myscript.js"); ?>" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>
</body>

</html>
