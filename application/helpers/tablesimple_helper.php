<?php

function buka_tabel($judul, $action = true, $action_name = null){
    echo '
    <div class="table-responsive padding-10">
	   <table class="table table-hover mb-0" width="100%;">
            <thead>
                <tr style="text-align: center">
                    <th style="width:10px; text-align: center">No</th>';
                        foreach ($judul as $jdl) {
                            echo '<th style="text-align: center">'.$jdl.'</th>';
                        }

                        if($action){
                            $ActionName = (!empty($action_name) ? $action_name : 'Update Data');
                            echo '<th style="width: 8.5%; text-align: center">'.$ActionName.'</th>';
                        }
                echo '
                </tr>
            </thead>
            <tbody>';
}

function buka_tabel_for_label($judul){
    echo '
    <div class="table-responsive padding-10">
	   <table class="table table-hover mb-0" width="100%;">
	       <thead>
                <tr style="text-align: center">
                    <th style="width:10px; text-align: center">No</th>';
                    foreach ($judul as $jdl) {
                        echo '<th style="text-align: center">'.$jdl.'</th>';
                    }
                echo '
                </tr>
        </thead>
        <tbody>';
}

function buka_tabel_for_song($judul, $action = true){
    echo '
    <div class="table-responsive padding-10">
       <table class="table table-hover mb-0" width="100%;">
            <thead>
                <tr style="text-align: center">
                    <th style="width:10px; text-align: center">ID</th>';
                    foreach ($judul as $jdl) {
                        echo '<th style="text-align: center">'.$jdl.'</th>';
                    }

                    if($action){
                        echo '<th style="width: 60px; text-align: center">Update Data</th>';
                    }

                echo '
                </tr>
            </thead>
            <tbody>';
}

function buka_tabel_datatable($judul, $action = false, $action_name = null){
    echo '
    <div class="table-responsive padding-10">
       <table class="data-table table table-hover mb-0" width="100%;">
            <thead>
                <tr style="text-align: center">
                    <th style="width:10px; text-align: center">No</th>';
                        foreach ($judul as $jdl) {
                            echo '<th style="text-align: center">'.$jdl.'</th>';
                        }

                        if($action){
                            $ActionName = (!empty($action_name) ? $action_name : 'Update Data');
                            echo '<th style="width: 8.5%; text-align: center">'.$ActionName.'</th>';
                        }
                echo '
                </tr>
            </thead>
            <tbody>';
}

function isi_tabel($no, $data, $link, $id, $awal, $akhir, $lihat=true){
    echo '
    <tr style="text-align: center">
        <td valign="top"> '.$no.'</td>';
        foreach($data as $dt){
            echo '<td valign="top">'.$dt.'</td>';
        }
        echo '
        <td valign="top">';
            if($lihat){
                echo'
                <a href="'.$link.'/'.$id.'/'.$awal.'/'.$akhir.'" class="tb btn-primary btn-sm" title="Lihat Statistika">
                    <i class="glyphicon glyphicon-stats"></i>
                </a>';
            }
        echo '
        </td>
    </tr>';
}

function isi_tabel_for_label($no, $data, $link, $id, $lihat=true){
    echo '
    <tr style="text-align: center">
        
        <td valign="top"> '.$no.'</td>';
        foreach($data as $dt){
            echo '<td valign="top">'.$dt.'</td>';
        }
    
    echo '
    </tr>';
}

// function isi_tabel_for_label($no, $data, $link, $id, $lihat=true){
//     echo '
//     <tr style="text-align: center">
//         <td valign="top"> '.$no.'</td>';
//             foreach($data as $dt){
//                 echo '<td valign="top">'.$dt.'</td>';

//             }
//         echo '
//         <td valign="top">';
//             if($lihat){
//                 echo'
//                 <a href="'.$link.'/'.$id.'" class="tb btn-primary btn-sm" title="Lihat Statistika">
//                     <i class="glyphicon glyphicon-stats"></i>
//                 </a>';
//             }
//         echo '
//         </td>
//     </tr>';
// }

function isi_tabel_for_subscription($no, $data, $link, $id, $lihat=true){
    echo '
    <tr style="text-align: center">
        <td valign="top"> '.$no.'</td>';
            foreach($data as $dt){
                echo '<td valign="top">'.$dt.'</td>';
            }
    echo '
    </tr>';
}

function isi_tabel_admin($no, $data, $linkEdit, $linkHapus, $id, $edit = true, $hapus = true, $additional = null){
    echo '
    <tr style="text-align: center"><td valign="top"> '.$no.'</td>';
        foreach($data as $dt){
            echo '<td valign="top">'.$dt.'</td>';
        }
    
        if($edit || $hapus || !empty($additional)){
            echo '<td valign="top">';
            
            if($edit){
                echo'
                <a href="'.$linkEdit.'/'.$id.'" class="tb btn-primary btn-sm pull-left">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>';
            }

            if($hapus){
            //class hapuss untuk menampilkan konfirmasi hapus data
                echo'&nbsp <a href="'.$linkHapus.'/'.$id.'" class="tb btn-danger btn-sm hapuss pull-right" onClick="return confirm(\'Are you sure want to delete?\')">
                        <i class="glyphicon glyphicon-trash"></i>
                    </a>';
            }

            if(!empty($additional)){
            //class hapuss untuk menampilkan konfirmasi hapus data
                echo $additional;
            }

            echo '</td>';
        }
        
    echo '
    </tr>';
}

function isi_tabel_request($no, $data, $linkEdit, $linkHapus, $id, $approve = true, $not_approved = true){
    echo '
    <tr style="text-align: center">
        <td valign="top"> '.$no.'</td>';
        
        foreach($data as $dt){
            echo '<td valign="top">'.$dt.'</td>';
        }
        
        echo '
        <td valign="top" style="width: 8.5%; text-align: center">
            <div class="load_button">
                <img src="'.base_url("image/loading_animation.gif").'" width="25">
            </div>
            <div class="action_buttons hide">';
            if($approve){
                echo'
                <a href="'.$linkEdit.'/'.$id.'" class="tb btn-success btn-sm pull-left">
                    <i class="glyphicon glyphicon-ok"></i>
                </a>';
            }
        
            if($not_approved){
            //class hapuss untuk menampilkan konfirmasi hapus data
                echo'
                &nbsp <a href="'.$linkHapus.'/'.$id.'" class="tb btn-danger btn-sm hapuss pull-right" onClick="return confirm(\'Are you sure want to delete?\')">
                    <i class="glyphicon glyphicon-remove"></i>
                </a>';
            }
        echo '
            </div>
        </td>
    </tr>';
}

function isi_tabel_label($no, $data, $link, $id, $lihat){
    echo'
    <tr style="text-align: center">
        <td valign="top"> '.$no.'</td>';
        foreach($data as $dt){
            echo '<td valign="top">'.$dt.'</td>';
        }
        echo '
        <td valign="top">';
            if($lihat){
                echo'
                <a href="'.$link.'/'.$id.'" class="tb btn-primary btn-sm" data-toggle="tooltip" title="Lihat Statistika">
                    <i class="glyphicon glyphicon-stats"></i>
                </a>';
            }

        echo '
        </td>
    </tr>';
}

function isi_tabel_lagu_label($no, $data, $link, $id, $lihat){
    echo'
    <tr style="text-align: center">
        <td valign="top"> '.$no.'</td>';
        foreach($data as $dt){
            echo '<td valign="top">'.$dt.'</td>';
        }
        echo'
        <td valign="top">';
            if($lihat){
                echo'
                <a href="'.$link.'/'.$id.'" class="tb btn-primary btn-sm " title="Lihat Daftar Lagu">
                    <i class="glyphicon glyphicon-eye-open"></i>
                </a>';
            }
        echo '
        </td>
    </tr>';
}

function tutup_tabel(){
            echo '
            </tbody>
        </table>
	</div>';
}
?>

