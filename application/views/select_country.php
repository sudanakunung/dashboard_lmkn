<!DOCTYPE html>
<html>

<head>
    <title>Select Country</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo LOGOICO;?>">
    <meta name="Description" content="MYDIOSING, MUSIK BAGUS" />
    <meta name="Keywords" content="?mydiosing, musik bagus, musik glan fradly, mydiosing, karaoke online, karoke, karaoke" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width= device-width, initial-scale= 1, maximum-scale=1" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <style type="text/css">
        html, body, .container-table {
            height: 100%;
        }
        body {
            background: url("<?= base_url('image/dev2/banner-image3.png'); ?>");
            background-repeat: no-repeat;
            background-size: cover;
        }
        .container-table {
            display: table;
        }
        .vertical-center-row {
            display: table-cell;
            vertical-align: middle;
        }
        .pilih-bendera{
            cursor: pointer;
        }
        .pilih-bendera:hover {
            -ms-transform: scale(1.1); /* IE 9 */
            -webkit-transform: scale(1.1); /* Safari 3-8 */
            transform: scale(1.1); 
        }
        @media only screen and (max-width: 414px) {
            body {
                background-size: 1035px 736px;
                background-position: 80% 50%; 
            }
        }
        @media only screen and (max-width: 375px) {
            body {
                background-size: 1035px 736px;
                background-position: 80% 50%; 
            }
        }
        @media only screen and (max-width: 320px) {
            body {
                background-size: 1035px 736px;
                background-position: 80% 50%; 
            }
        }
    </style>
</head>

<body>
    <div class="container container-table">
        <div class="row vertical-center-row">
            <div class="text-center col-md-12 col-lg-12">
                <img src="<?= base_url('image/webpage-03.png'); ?>" class="img-responsive" width="300" alt="MYDIO Sing" style="margin-bottom: 15px;">
            </div>
            <div class="text-center col-md-12 col-lg-12">
                <h4 style="color: #fff;">Please choose a country</h4>
                <img src="<?= base_url('image/country-flags/indonesia_kotak.png'); ?>" class="img-responsive pilih-bendera" width="100" alt="Indonesia" style="margin-right: 25px;" data-langcode="ind">
                <img src="<?= base_url('image/country-flags/philippines_kotak.png'); ?>" class="img-responsive pilih-bendera" width="100" alt="Philippines" data-langcode="phi">
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(".pilih-bendera").click(function(event) {

            event.preventDefault();

            var langCode = $(this).attr('data-langcode');

            $.ajax({
                url: "<?= base_url('selectcountry/savelangcode'); ?>",
                type: 'POST',
                dataType:'JSON',
                data: {'langCode': langCode},
                success: function(data){
                   window.location = data.redirect;
                }
            });

            return false;
        
        });
    </script>
</body>

</html>