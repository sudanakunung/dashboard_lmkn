<?php
function buat_menu($link, $ikon, $judul, $leveluser=array()){
    $ci =& get_instance();
    foreach ($leveluser as $level) {
        # code...
        if($ci->session->userdata('level') == $level)
            echo'
            <li style="border-radius: 25px;height:40px;margin:3px ;" id="'.$link.'">
                <a class="btn menu-header" style="text-align:left;border-radius:25px 25px;margin-bottom:10px;font-size:16px;height:40px;font-weight:bold;" href="'.base_url($link).'" style="font-size:20px;">
                    <i class="glyphicon glyphicon-'.$ikon.'"></i> '.$judul.'
                </a>
            </li>';
    }
}

function buat_submenu($link, $judul, $leveluser=array("admin")){
    $ci =& get_instance();
    foreach ($leveluser as $level) {
        # code...
        if($ci->session->userdata('level') == $level)
            echo'<li>
			<a href="'.base_url($link).'">'.$judul.'</a></li>';

    }
}

function buka_dropdown($ikon, $judul, $leveluser=array("admin")){
    $ci =& get_instance();
    foreach ($leveluser as $level) {
        # code...
        if($ci->session->userdata('level') == $level)
            echo'<li class="dropdown">
			<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-'.$ikon.'"></i> '.$judul.'<b class="caret"></b></a><ul class="dropdown-menu">';

    }
}
function tutup_dropdown($leveluser=array("admin")){
    $ci =& get_instance();
    foreach ($leveluser as $level) {
        # code...
        if($ci->session->userdata('level') == $level)
            echo '</ul></li>';
    }

}
?>