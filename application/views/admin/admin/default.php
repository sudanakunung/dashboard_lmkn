<?php

if (!empty($this->session->flashdata('sukses_aksi_tambahadmin'))) : ?>
    <div class="alert alert-success login-alert" role="alert">
        <center><?= $this->session->flashdata('sukses_aksi_tambahadmin') ?></center>
    </div>
<?php endif;

if (!empty($this->session->flashdata('sukses_aksi_editadmin'))) : ?>
    <div class="alert alert-success login-alert" role="alert">
        <center><?= $this->session->flashdata('sukses_aksi_editadmin') ?></center>
    </div>
<?php endif;

if (!empty($this->session->flashdata('sukses_aksi_hapusadmin'))) : ?>
    <div class="alert alert-success login-alert" role="alert">
        <center><?= $this->session->flashdata('sukses_aksi_hapusadmin') ?></center>
    </div>
<?php endif;

if (!empty($this->session->flashdata('error_aksi_hapusadmin'))) : ?>
    <div class="alert alert-danger login-alert" role="alert">
        <center><?= $this->session->flashdata('error_aksi_hapusadmin') ?></center>
    </div>
<?php endif;



// echo '<h3 class="page-header"><b>Admin List Data</b>';
// echo '	<a href="'.base_url('adminadmin/tambah').'" class="btn btn-primary btn-sm pull-right top-button">
// 			<i class="glyphicon glyphicon-plus-sign"></i> Tambah 
// 		</a>';

// echo '</h3>';
// //level login sebagai admin

// buka_tabel(array("Username", "Institution", "Artist Name", "Label Name", "Composer Name"));
// $no = 1;

// foreach ($getData as $data){

//     if($data->roleId == 1){
//         //jika data yg dimasukkan kedalam tabel adalah admin atau roleId 1
//         //tidak bisa update tetapi bisa hapus
//         $canUpdate = false;
//         $canDelete = true;
//         isi_tabel_admin($no, array("<b style='color: green'>".$data->username."</b>", $data->lembaga,$data->name, $data->label, $data->composer), "", base_url('adminadmin/hapus'), $data->adminId, $canUpdate, $canDelete);
//     }
//     elseif($data->username == 'opbulk'){
//         $canUpdate = false;
//         $canDelete = false;
//         isi_tabel_admin($no, array("<b style='color: red'>".$data->username."</b>", $data->lembaga, $data->name, $data->label, $data->composer,""), base_url('adminadmin/edit'),base_url('adminadmin/hapus'), $data->adminId, $canUpdate, $canDelete);
//     }
//     elseif($data->labelId > 0 AND $data->artistId == 0 AND $data->composer == 0){
//         $namaLabel = "";

//         if($data->label == NULL){
//             $getLabelName = $this->adminadmin->getLabelNameFromArtist($data->artistId);
//             if($getLabelName == NULL or empty($getLabelName)){
//                 $namaLabel = "-";
//             }
//             else{
//                 foreach ($getLabelName as $labelname){
//                     if($labelname->label == NULL){
//                         $namaLabel .= "- ";
//                     }
//                     else{
//                         $namaLabel .= $labelname->label." ";
//                     }
//                 }
//             }
//         }
//         else{
//             $getLabelName = $this->adminadmin->getLabelName($data->labelId);
//             foreach ($getLabelName as $labelname){
//                 $namaLabel =  $labelname->recordLabel;
//             }
            
//         }

//         $canUpdate = true;
//         $canDelete = true;
//         isi_tabel_admin($no, array("<b style='color: yellowgreen'>".$data->username."</b>", $data->lembaga, $data->name, $namaLabel, $data->composer), base_url('adminadmin/edit'), base_url('adminadmin/hapus'), $data->adminId, $canUpdate, $canDelete);
//     }
//     elseif($data->roleId == 4 || $data->roleId == 5 || $data->roleId == 6){
//         if($data->roleId == 4){
//             $mewakili = "Artist";
//         }
//         elseif($data->roleId == 5){
//             $mewakili = "Label";
//         }
//         else{
//             $mewakili = "Composer";
//         }

//         $canUpdate = true;
//         $canDelete = true;
//         isi_tabel_admin($no, array($data->username, $data->lembaga."<br /><small>Represent ".$mewakili."</small>", $data->name, $data->label, $data->composer), base_url('adminadmin/edit'), base_url('adminadmin/hapus'), $data->adminId, $canUpdate, $canDelete);
//     }
//     else {
       
//         $canUpdate = true;
//         $canDelete = true;
//         isi_tabel_admin($no, array($data->username, $data->lembaga, $data->name, $data->label, $data->composer), base_url('adminadmin/edit'), base_url('adminadmin/hapus'), $data->adminId, $canUpdate, $canDelete);

//     }
//     $no++;
// }
// tutup_tabel();

?>

<h3 class="page-header">
    <b>Admin List</b>
    <a href="<?= base_url('adminadmin/tambah') ?>" class="btn btn-primary btn-sm pull-right top-button"><i class="glyphicon glyphicon-plus-sign"></i> Add a Admin </a>
</h3>

<div class="card mb-20">
    <div class="card-header">
        <div class="row">
            <div class="col-md-4 pull-right">
                <?= form_search(base_url('adminadmin/index'), 'keyword', 'Search Title'); ?>
            </div>
        </div>
    </div>

    <?php
    buka_tabel(array("Username", "Institution", "Artist Name", "Label", "Content Provider", "Composer"), $action = true);

    foreach ($dataAdmin as $admin){

        if($admin->username == 'opbulk'){
            $username = '<b style="color: red">'.$admin->username.'</b>';
            $lembaga = $admin->lembaga;

            isi_tabel_admin(++$start, array($username, $lembaga, $admin->artist_name, $admin->label_name, $admin->arranger_name, $admin->composer_name,""), "", "", $admin->adminId, false, false);
        }
        else {
            if($admin->roleId == 1){
                if($this->session->userdata('admincountry') == ''){
                    $canUpdate = true;
                    $canDelete = true;
                } else {
                    $canUpdate = true;
                    $canDelete = false;
                }
                //jika data yg dimasukkan kedalam tabel adalah admin atau roleId 1
                //tidak bisa update tetapi bisa hapus
                
                $username = '<b style="color: green">'.$admin->username.'</b>';
                $lembaga = $admin->lembaga;
            }
            elseif($admin->roleId == 4 || $admin->roleId == 5 || $admin->roleId == 6 || $admin->roleId == 8){
                if($admin->roleId == 4){
                    $mewakili = "Artist";
                }
                elseif($admin->roleId == 5){
                    $mewakili = "Label";
                }
                elseif($admin->roleId == 8){
                    $mewakili = "Content Provider";
                }
                else{
                    $mewakili = "Composer";
                }

                $canUpdate = true;
                $canDelete = true;
                $username = $admin->username;
                $lembaga = $admin->lembaga."<br /><small>Represent ".$mewakili."</small>";
            }
            else {
                $canUpdate = true;
                $canDelete = true;
                $username = $admin->username;
                $lembaga = $admin->lembaga;
            }

            isi_tabel_admin(++$start, array($username, $lembaga, $admin->artist_name, $admin->label_name, $admin->arranger_name, $admin->composer_name), base_url('adminadmin/edit'), base_url('adminadmin/hapus'), $admin->adminId, $canUpdate, $canDelete);
        }
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