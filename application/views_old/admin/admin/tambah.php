<?php
if (!empty($this->session->flashdata('error_aksi_tambahadmin'))) { ?>
    <div class="alert alert-danger login-alert" role="alert">
        <center><b>Sorry!</b> <?= $this->session->flashdata('error_aksi_tambahadmin') ?>
        </center>
    </div> 
<?php 
}

$data = array("adminId" => "", "username" => "", "artistId"=>"","password"=>"","email"=>"","roleId"=>"","recordLabelId"=>"", "composerId"=>"", "arrangerId"=>"");
$aksi = "Add";

echo '<h3 class="page-header"><b>'.$aksi.' Admin</b></h3>';

//tampilan form username, email, password, nilainya berdasarkan query tabel admin tergantung id ada di line 74-80
buka_form( 'adminadmin/aksitambah', $data['adminId'], strtolower($aksi));

if($this->session->userdata('admincountry') <> ""){
    echo '<input type="hidden" name="langCode" value="'.$this->session->userdata('langCode').'" />';
}

buat_textbox("USERNAME", "username", $data['username'], "10","text", "Username","required");

buat_textbox("EMAIL", "email", $data['email'], "10","email","Email Boleh tidak di isi", "xx");

buat_textbox("PASSWORD", "password", $data['password'], "4","password", "Password","required");

if($this->session->userdata('admincountry') == ""){
    buat_combobox("ADMIN FOR", "langCode", array(array("cap" => "LMKN", "val" => "ind"), array("cap" => "FILSCAP", "val" => "phi")), "", '4');
}

if ($this->session->userdata('admincountry') == 'ind') {
    $typeAdmin = array(array("cap"=>"Admin LMK","val"=>4),array("cap"=>"Artist","val"=>0),array("cap"=>"Label","val"=>2),array("cap"=>"Content Provider","val"=>7),array("cap"=>"Composer","val"=>3));  
}
else if ($this->session->userdata('admincountry') == 'phi') {
    $typeAdmin = array(array("cap"=>"Artist","val"=>0),array("cap"=>"Label","val"=>2),array("cap"=>"Content Provider","val"=>7),array("cap"=>"Composer","val"=>3));
} 
else {
    $typeAdmin = array(array("cap"=>"Admin LMKN/FILSCAP","val"=>1),array("cap"=>"LMK","val"=>4),array("cap"=>"Artist","val"=>0),array("cap"=>"Label","val"=>2),array("cap"=>"Content Provider","val"=>7),array("cap"=>"Composer","val"=>3));
}

buat_combobox("POSITION", "posisi", $typeAdmin, $data['roleId'], $lebar = '4',"");

$list = array();
foreach ($getDataCombobox as $dataCombobox){
    $list[] = array("cap" => $dataCombobox->name, "val" => $dataCombobox->artistId);
}

buat_combobox_HIDE("ARTIST ID", "artistId", $list, $data['artistId'], '4');

$label = array();
foreach ($getLabel as $dataLabel) {
        $label[] = array("cap" => $dataLabel->recordLabel, "val" => $dataLabel->recordLabelId);
}

buat_combobox_HIDE("LABEL", "labels", $label, $data['recordLabelId'], $lebar = '4');

$composer = array();
foreach ($getComposer as $dataComposer){
    $composer[] = array("cap" => $dataComposer->name, "val" => $dataComposer->composerId);
}

buat_combobox_HIDE("COMPOSER", "composerId", $composer, $data['composerId'], '4');

$arranger = array();
foreach ($getArranger as $dataArranger){
    $arranger[] = array("cap" => $dataArranger->arranger, "val" => $dataArranger->arrangerId);
}

buat_combobox_HIDE("ARRANGER", "arrangerId", $arranger, $data['arrangerId'], '4');

$dataLMK = array(["cap" => "Artist", "val" => 4], ["cap" => "Label/Publisher", "val" => 5], ["cap" => "Composer", "val" => 6]);
$lmk = array();
foreach ($dataLMK as $getlmk){
    $lmk[] = array("cap" => $getlmk['cap'], "val" => $getlmk['val']);
}

buat_combobox_HIDE("REPRESENT", "roleIdLMK", $lmk, "", '4');

$dataLembaga = array(["cap" => "SELMI", "val" => "SELMI"], ["cap" => "RAI", "val" => "RAI"], ["cap" => "WAMI", "val" => "WAMI"], ["cap" => "KCI", "val" => "KCI"], ["cap" => "PAPPRI", "val" => "PAPPRI"]);
$lembaga = array();
foreach ($dataLembaga as $getlembaga){
    $lembaga[] = array("cap" => $getlembaga['cap'], "val" => $getlembaga['val']);
}

buat_combobox_HIDE("THE INSTITUTION", "lembaga", $lembaga, "", '4');

tutup_form('adminadmin/index'); ?>


<!-- javascript untuk menampilkan dan menghilangkan form, serta menambah dan menghapus require(wajib diisi didalam form)-->
    <script type="text/javascript">
        $("#posisi").change(function(){
            var posisi = $("#posisi").val();
            if(posisi == '1' || posisi == 1){
                $("#roleIdLMK").addClass("hide");
                $(".roleIdLMK").removeAttr("required");
                $("#lembaga").addClass("hide");
                $(".lembaga").removeAttr("required");
                $("#artistId").addClass("hide");
                $(".artistId").removeAttr("required");
                $("#labels").addClass("hide");
                $(".labels").removeAttr("required");
                $("#arrangerId").addClass("hide");
                $(".arrangerId").removeAttr("required");
                $("#composerId").addClass("hide");
                $(".composerId").removeAttr("required");
                document.getElementsByName('email')[0].placeholder='Email Harus di Isi';
                $(".email").prop("required", true);
            }
            else if(posisi == '0' || posisi == 0){
                $("#artistId").removeClass("hide");
                $(".artistId").prop("required", true);
                $("#roleIdLMK").addClass("hide");
                $(".roleIdLMK").removeAttr("required");
                $("#lembaga").addClass("hide");
                $(".lembaga").removeAttr("required");
                $("#labels").addClass("hide");
                $(".labels").removeAttr("required");
                $("#arrangerId").addClass("hide");
                $(".arrangerId").removeAttr("required");
                $("#composerId").addClass("hide");
                $(".composerId").removeAttr("required");
                document.getElementsByName('email')[0].placeholder='Email Boleh tidak di isi';
                $(".email").removeAttr('required');
                $(".artistId").chosen({no_results_text: "Tidak ditemukan....!"});
            }
            else if(posisi == '2' || posisi == 2){
                $("#labels").removeClass("hide");
                $(".labels").prop("required", true);
                $("#arrangerId").addClass("hide");
                $(".arrangerId").removeAttr("required");
                $("#roleIdLMK").addClass("hide");
                $(".roleIdLMK").removeAttr("required");
                $("#lembaga").addClass("hide");
                $(".lembaga").removeAttr("required");
                $("#artistId").addClass("hide");
                $(".artistId").removeAttr("required");
                $("#composerId").addClass("hide");
                $(".composerId").removeAttr("required");
                document.getElementsByName('email')[0].placeholder='Email Boleh tidak di isi';
                $(".email").removeAttr('required');
                $(".labels").chosen({no_results_text: "Tidak ditemukan....!"});
            }
            else if(posisi == '3' || posisi ==3){
                $("#composerId").removeClass("hide");
                $(".composerId").prop("required", true);
                $("#roleIdLMK").addClass("hide");
                $(".roleIdLMK").removeAttr("required");
                $("#lembaga").addClass("hide");
                $(".lembaga").removeAttr("required");
                $("#artistId").addClass("hide");
                $(".artistId").removeAttr("required");
                $("#labels").addClass("hide");
                $(".labels").removeAttr("required");
                $("#arrangerId").addClass("hide");
                $(".arrangerId").removeAttr("required");
                document.getElementsByName('email')[0].placeholder='Email Boleh tidak di isi';
                $(".email").removeAttr('required');
                $(".composerId").chosen({no_results_text: "Tidak ditemukan....!"});
            }
            else if(posisi == '4' || posisi == 4){
                $("#roleIdLMK").removeClass("hide");
                $(".roleIdLMK").prop("required", true);
                $("#lembaga").removeClass("hide");
                $(".lembaga").prop("required", true);
                $("#artistId").addClass("hide");
                $(".artistId").removeAttr("required");
                $("#labels").addClass("hide");
                $(".labels").removeAttr("required");
                $("#arrangerId").addClass("hide");
                $(".arrangerId").removeAttr("required");
                $("#composerId").addClass("hide");
                $(".composerId").removeAttr("required");
                document.getElementsByName('email')[0].placeholder='Email Boleh tidak di isi';
                $(".email").removeAttr('required');
                $(".roleIdLMK").chosen({no_results_text: "Tidak ditemukan....!"});
                $(".lembaga").chosen({no_results_text: "Tidak ditemukan....!"});
            }
            else if(posisi == '7' || posisi == 7){
                $("#arrangerId").removeClass("hide");
                $(".arrangerId").prop("required", true);
                $("#roleIdLMK").addClass("hide");
                $(".roleIdLMK").removeAttr("required");
                $("#lembaga").addClass("hide");
                $(".lembaga").removeAttr("required");
                $("#artistId").addClass("hide");
                $(".artistId").removeAttr("required");
                $("#labels").addClass("hide");
                $(".labels").removeAttr("required");
                $("#composerId").addClass("hide");
                $(".composerId").removeAttr("required");
                document.getElementsByName('email')[0].placeholder='Email Boleh tidak di isi';
                $(".email").removeAttr('required');
                $(".arrangerId").chosen({no_results_text: "Tidak ditemukan....!"});
            }
        });

        var posisi = $("#posisi").val();
        if(posisi == '1' || posisi == 1){
            $("#roleIdLMK").addClass("hide");
            $(".roleIdLMK").removeAttr("required");
            $("#lembaga").addClass("hide");
            $(".lembaga").removeAttr("required");
            $("#artistId").addClass("hide");
            $(".artistId").removeAttr("required");
            $("#labels").addClass("hide");
            $(".labels").removeAttr("required");
            $("#arrangerId").addClass("hide");
            $(".arrangerId").removeAttr("required");
            $("#composerId").addClass("hide");
            $(".composerId").removeAttr("required");
            $("#arrangerId").addClass("hide");
            $(".arrangerId").removeAttr("required");
            document.getElementsByName('email')[0].placeholder='Email Harus di Isi';
            $(".email").prop("required", true);
        }
        else if(posisi == '0' || posisi == 0){
            $("#artistId").removeClass("hide");
            $(".artistId").prop("required", true);
            $("#roleIdLMK").addClass("hide");
            $(".roleIdLMK").removeAttr("required");
            $("#lembaga").addClass("hide");
            $(".lembaga").removeAttr("required");
            $("#labels").addClass("hide");
            $(".labels").removeAttr("required");
            $("#arrangerId").addClass("hide");
            $(".arrangerId").removeAttr("required");
            $("#composerId").addClass("hide");
            $(".composerId").removeAttr("required");
            $("#arrangerId").addClass("hide");
            $(".arrangerId").removeAttr("required");
            document.getElementsByName('email')[0].placeholder='Email Boleh tidak di isi';
            $(".email").removeAttr('required');
            $(".artistId").chosen({no_results_text: "Tidak ditemukan....!"});
        }
        else if(posisi == '2' || posisi == 2){
            $("#labels").removeClass("hide");
            $(".labels").prop("required", true);
            $("#arrangerId").addClass("hide");
            $(".arrangerId").removeAttr("required");
            $("#roleIdLMK").addClass("hide");
            $(".roleIdLMK").removeAttr("required");
            $("#lembaga").addClass("hide");
            $(".lembaga").removeAttr("required");
            $("#artistId").addClass("hide");
            $(".artistId").removeAttr("required");
            $("#composerId").addClass("hide");
            $(".composerId").removeAttr("required");
            $("#arrangerId").addClass("hide");
            $(".arrangerId").removeAttr("required");
            document.getElementsByName('email')[0].placeholder='Email Boleh tidak di isi';
            $(".email").removeAttr('required');
            $(".labels").chosen({no_results_text: "Tidak ditemukan....!"});
        }
        else if(posisi == '3' || posisi == 3){
            $("#composerId").removeClass("hide");
            $(".composerId").prop("required", true);
            $("#roleIdLMK").addClass("hide");
            $(".roleIdLMK").removeAttr("required");
            $("#lembaga").addClass("hide");
            $(".lembaga").removeAttr("required");
            $("#artistId").addClass("hide");
            $(".artistId").removeAttr("required");
            $("#labels").addClass("hide");
            $(".labels").removeAttr("required");
            $("#arrangerId").addClass("hide");
            $(".arrangerId").removeAttr("required");
            document.getElementsByName('email')[0].placeholder='Email Boleh tidak di isi';
            $(".email").removeAttr('required');
            $(".composerId").chosen({no_results_text: "Tidak ditemukan....!"});
        }
        else if(posisi == '4' || posisi == 4){
            $("#roleIdLMK").removeClass("hide");
            $(".roleIdLMK").prop("required", true);
            $("#lembaga").removeClass("hide");
            $(".lembaga").prop("required", true);
            $("#artistId").addClass("hide");
            $(".artistId").removeAttr("required");
            $("#labels").addClass("hide");
            $(".labels").removeAttr("required");
            $("#arrangerId").addClass("hide");
            $(".arrangerId").removeAttr("required");
            $("#composerId").addClass("hide");
            $(".composerId").removeAttr("required");
            document.getElementsByName('email')[0].placeholder='Email Boleh tidak di isi';
            $(".email").removeAttr('required');
            $(".roleIdLMK").chosen({no_results_text: "Tidak ditemukan....!"});
            $(".lembaga").chosen({no_results_text: "Tidak ditemukan....!"});
        }
        else if(posisi == '7' || posisi == 7){
            $("#arrangerId").removeClass("hide");
            $(".arrangerId").prop("required", true);
            $("#roleIdLMK").addClass("hide");
            $(".roleIdLMK").removeAttr("required");
            $("#lembaga").addClass("hide");
            $(".lembaga").removeAttr("required");
            $("#artistId").addClass("hide");
            $(".artistId").removeAttr("required");
            $("#labels").addClass("hide");
            $(".labels").removeAttr("required");
            $("#arrangerId").addClass("hide");
            $(".arrangerId").removeAttr("required");
            $("#composerId").addClass("hide");
            $(".composerId").removeAttr("required");
            document.getElementsByName('email')[0].placeholder='Email Boleh tidak di isi';
            $(".email").removeAttr('required');
            $(".arrangerId").chosen({no_results_text: "Tidak ditemukan....!"});
        }
    </script>
