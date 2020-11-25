<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo LOGOICO;?>">
    <meta name="Description" content="MYDIOSING, MUSIK BAGUS" />
    <meta name="Keywords" content="?mydiosing, musik bagus, musik glan fradly, mydiosing, karaoke online, karoke, karaoke"/>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width= device-width, initial-scale= 1, maximum-scale=1"/>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <style>
      * {
        box-sizing: border-box;
      }
      body{
        background-color: #f2f2f2;
      }
      .sisi-kiri{
        background-image: linear-gradient(#061352, #042ca5);
        background-image: url(<?= base_url('image/dev2/banner-image3.png'); ?>);
        background-size: cover;
        background-repeat:no-repeat;
        margin-left: -100px;
      }
      .form-control{
        height: 50px;
      }
      .tombol .btn-block{
        border-radius: 10px 10px;
        height: 40px;
        font-weight: 500;
        font-size: 20px;
      }

    

      .card {

        
        
        margin-top: 100px;
        border: none;
        border-radius: 2;
        width: 22rem;
        margin-left:40px;
        background-color: transparent;

      }

      .card-body {

            border-radius: 12px 12px;
          -webkit-box-shadow: 0px 0px 20px -2px rgba(122, 217, 255, 1);
          -moz-box-shadow: 0px 0px 20px -2px rgb(122, 217, 255, 1);
          box-shadow: 0px 0px 20px -2px rgb(122, 217, 255, 1);
        margin-top: 30px;
        font-family: 'Alata', sans-serif;
        background-color: rgba(0, 0, 0, 0.7);
        text-align: center;
        color: #ffff;


      }
      .form-check a{
        color: #000
      }

      p {
        font-size: 12;
        color: #cccccc;
      }

      .card .btn {
        margin-top: 20px;
        width: 200px;
        height: 30px;
        font-size: 16px;
        padding: 1px;
      }

      .copyright p{
        
        color: #a6a6a6;
        font-weight: 300;
      }
      .hiden{
        display:none;
      }

        @media only screen and (max-width: 500px) {
          .sisi-kiri{
            display: none;
          }
          .col-md-3{
            width: 100%;
          }
        
          .navbar-brand img{
            width: 250px;
            height: 40px;
          }
          .form-control{
            color: #fff;
          }
             .form-check a{
        color: #fff
      }
          body{
            -webkit-background-image: linear-gradient(#061352, #042ca5);
            background-image: url(<?= base_url('image/dev2/banner-image2.jpeg'); ?>);
          background-size: cover;
          background-repeat: no-repeat; 
          height: 600px;
          margin: 0;
          width: 0;
        
          padding: 0;
          }
          .form-group input{
            background-color: #fff;
            color: #fff;
          }
          .form-group input:focus{
             background-color: #fff;
            color: #fff;
          }
          .card{
         
        
           justify-content: center;
            width: 17rem;
          }
           .copyright p{
        
        color: #a6a6a6;
        font-size: 10px;
        
      }
      .himbauan{
        width:100px;
      }
    
     
        }
      
      

    </style>
    <!-- <script>
        $(document).ready(function() {

            $("#logins").click(function() {
                $("#login").hide();
                $("#forgot").css("block");
            })

            $("#forgots").click(function() {
                $("#forgot").addClass("hide");
                $("#login").show();
            })

        });
    </script> -->

    <script type="text/javascript">
$(document).ready(function(){
 
$("#open").click(function(){
 
$("#masuk").addClass("hiden");
$("#tutup").removeClass("hiden");
});
$("#close").click(function(){
  $("#tutup").addClass("hiden");
  $("#masuk").removeClass("hiden");
});
 
});</script>

</head>
<body>
<!-- <body style="background-image: url('<?= base_url('image/dev2/banner-image2.jpeg'); ?>'); no-repeat center center fixed; #fff;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
                background-attachment:fixed;"> -->


<?php
//if(isset($_POST['login'])){
//    $username = $_POST['username'];
//    $password = $_POST['password'];
//    $login = false;
//    $hashing = new Security();
//
//    $Logedin = $ModelLogin->Login($username,$password);
//
//
////        jika logedin tidak null, merubah var login jadi true
//    if($Logedin != NULL){
//        $login = true;
//        if($Logedin->recordLabelId > 0){
//            $data = array("username"=>$Logedin->username, "artistId"=>$Logedin->artistId, "level"=>"label", "roleId"=>$Logedin->roleId,"recordLabelId"=>$Logedin->recordLabelId);
//        }
//        if($Logedin->artistId > 0){
//            $data = array("username"=>$Logedin->username, "artistId"=>$Logedin->artistId, "level"=>"artist", "roleId"=>$Logedin->roleId,"recordLabelId"=>$Logedin->recordLabelId);
//        }
//
//        if($Logedin->artistId <= 0 AND $Logedin->recordLabelId <= 0){
//            $data = array("username"=>$Logedin->username, "artistId"=>$Logedin->artistId, "level"=>"admin", "roleId"=>$Logedin->roleId,"recordLabelId"=>$Logedin->recordLabelId);
//        }
//
//    }
//
////        kondisi nilai login adalah true
//    if($login == true){
//        $_SESSION['username'] = $data['username'];
//        $_SESSION['id'] = $data['artistId'];
//        $_SESSION['leveluser'] = $data['level'];
//        $_SESSION['timeout'] = time() + 1000;
//        $_SESSION['login'] = 1;
//        $_SESSION['roleId'] = $data['roleId'];
//        $_SESSION['recordLabelId'] = $data['recordLabelId'];
//
//        header('location: index.php');
//    }
//    // kondisi jika login false
//    else{
////                        Log::writeLn('login: '.$ipaddress.' *** access: '.__DIR__."* ".$file.' line: '.__LINE__.' Status: '.$login.' is failed *** '." input username: ".$username." input password: ".$password);
//
//        echo '<div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!</b> Username atau Password Salah.</center> </div>';
//    }
//}
//
//// untuk yg lupa password
//if(isset($_POST['send'])){
//    $email = isset($_POST['email']) ? $_POST['email'] : NULL;
//
//    if($email == NULL){
//        echo '<div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!</b> Isi Email Anda</center> </div>';
//    }
//    else{
//        $getEmail = $ModelLogin->cekMail($email);
//
//        if($getEmail->email == NULL){
//            echo '<div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!</b> Email tidak terdaftar</center> </div>';
//        }
//        else{
//            $send = $ModelLogin->sendEmail($getEmail->email,$getEmail->adminId);
//            if($send == true){
//                echo '<div class="alert alert-info login-alert" role="alert"><center><b>LIHAT EMAIL ANDA</b></center> </div>';
//            }
//            else{
//                echo '<div class="alert alert-info login-alert" role="alert"><center><b>GAGAL MENGIRIM EMAIL</b></center> </div>';
//            }
//        }
//    }
//} ?>

<!-- <?php if (!empty($this->session->flashdata('error'))) : ?>
    <div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!</b> <?= $this->session->flashdata('error') ?></center> </div>
<?php endif ?> -->
<?php if (!empty($this->session->flashdata('error'))) : ?>
<div class="himbauan">
<script type="text/javascript">
Swal.fire({
  icon: 'error',
  title: 'Oops...',
  text: '<?= $this->session->flashdata('error') ?>',
  
});
</script>
</div>
</div>
<?php endif ?>
<!-- <nav class="navbar navbar-default visible-lg visible-md visible-sm" style="background-color: transparent; border-width: 0px; color: white">
        <span class="pull-right" style="margin: 20px">
            <i class="glyphicon glyphicon-phone-alt"></i>
            <b>
                &nbsp contact us:&nbsp (+62) 8732xxxxx
            </b>
        </span>
</nav>
<center>
    <nav class="navbar navbar-default visible-xs" style="background-color: transparent; border-width: 0px; color: white">
            <span>
                <i class="glyphicon glyphicon-phone-alt"></i>
                <b>
                    &nbsp contact us:&nbsp (+62) 8732xxxxx
                </b>
            </span>
    </nav>
</center> -->
<!-- coba -->
<div class="col-md-12">
                <div class="row">
                  <div class="col-md-9 sisi-kiri" style="height: 700px;">
                  
                </div>
            <div class="col-md-3 ">
              <!-- Image and text -->
                    <nav class="navbar navbar-light">
                        <a class="navbar-brand" href="#">
                        <img src="<?= base_url('image/dev2/group.png'); ?>" width="400" height="70" class="d-inline-block align-top" alt="">
                    
                        </a>
                    </nav>
    <div class="container justify-content-center">
              <div class="card " id="masuk" >
               <form class="form-horizontal" style="margin: 10px; padding: 20px; " method="post" action="">
                    <div class="form-group ">
                        <input type="text" class="form-control bg-transparent"name="username" id="username"  aria-describedby="emailHelp" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control bg-transparent"name="password" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                    <input type="btn btn-primary" style="background-color:transparent;border:none" name="open" id="open" value="Forgot Password?">
                    </div>
                    <div class="tombol  d-flex justify-content-center">
                        <button type="submit" class="btn-block btn-primary"name="login" value="Login">Login</button>
                    </div>
                </form>
            <br>
            <br>
            <br>
            <div class="copyright d-flex justify-content-center ">
              <p>Mydiowork Technology | Copyright 2019</p>
            </div>
        
        </div>
   
              <div class="card hiden" id="tutup">
               <form class="form-horizontal" style="margin: 10px; padding: 20px; " method="post" action="">
                    <div class="form-group " >
                        <input type="email" class="form-control bg-transparent"name="email"id="email"  aria-describedby="emailHelp" placeholder="Email">
                    </div>
                   
                    <div class="form-group form-check">
                   
                    </div>
                    <div class="tombol  d-flex justify-content-center">
                        <button type="submit" class="btn-block btn-primary"name="login" value="Login">Kirim</button>
                    </div>
                    <input type="button" style="border:none;background:transparent;margin-top:20px;float:right;color:red;" name="open" id="close" value="Cancel">
                </form>
            
            <div class="copyright d-flex justify-content-center" style="margin-top:150px;">
              <p>Mydiowork Technology | Copyright 2019</p>
            </div>

<!-- coba selesai -->
<!-- <div class="col-md-6 col-sm-12">
    <center><img src="<?= base_url('image/webpage-03.png'); ?>" class="img-responsive" style="width: 50%"></center>
</div>
<br class="hidden-md hidden-lg"/>
<div class="col-md-6 col-sm-12 text-left">
    <div class="col-md-8 col-sm-12 text-left">
        <div class="panel panel-default" id="login" style="background:rgba(0, 0, 0, 0.1); color: #fff;">
            <div class="panel-heading" style="background:rgba(0, 0, 0, 0.1); color: #fff; background-color: transparent; border-width: 0.001px; border-bottom-width: 0px">
                <span class="glyphicon glyphicon-lock"></span> Login</div>
            <div class="panel-body">
                <form class="form-horizontal" style="margin: 10px; padding: 20px; " method="post" action="">
                    <div class="form-group">
                        <input class="form-control" type="text" name="username" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input class="btn btn-default col-xs-12 col-lg-4 col-sm-4 col-md-4" style="float: right" type="submit" name="login" value="Login">
                        <input class="btn col-xs-12 col-md-6 col-lg-6 col-sm-6" id="logins" style="float: left; background: transparent;" value="Forgot Password ?">
                    </div>
                </form>
            </div>
            <div class="panel-footer">

            </div>
        </div> -->

        <!-- <div class="panel panel-default hide" id="forgot" style="background:rgba(0, 0, 0, 0.1); color: #fff;">
            <div class="panel-heading" style="background:rgba(0, 0, 0, 0.1); color: #fff; background-color: transparent; border-width: 0.001px; border-bottom-width: 0px">
                <span class="glyphicon glyphicon-envelope"></span> E-mail</div>
            <div class="panel-body">
                <form class="form-horizontal" style="margin: 10px; padding: 20px" method="post">
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Your E-mail" >
                    </div>
                    <div class="form-group">
                        <input class="btn btn-danger col-xs-6 col-md-6 col-lg-6 col-sm-6" style="float: left" id="forgots" value="Cancel">
                        <input class="btn btn-default col-xs-4 col-xs-offset-2 col-md-4 col-md-offset-2 col-lg-4 col-lg-offset-2 col-sm-offset-2 col-sm-4" style="float: right" type="submit" name="send" value="Send">
                    </div>
                </form>
            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
</div> -->


</body>
</html>
