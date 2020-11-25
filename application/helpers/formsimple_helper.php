<?php
function buka_form($link, $id, $aksi){
    echo '<form method="post" action="'.base_url($link).'" class="form-horizontal" enctype="multipart/form-data">
			<input type="hidden" name="id" value="'.$id.'">
				<input type="hidden" name="aksi" value="'.$aksi.'">';
}

function tutup_form($linkcancel){
    echo '<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-floppy-disk"></i> Simpan</button>
				<a class="btn btn-warning" href="'.base_url($linkcancel).'">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal</a>
				</div>
			</div>
		</form>' ;
}

function buat_textbox($label, $nama, $nilai, $lebar='4', $type='text',$placeholder="", $required=""){
    echo '<div class="form-group" id="'.$nama.'"> 
		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-'.$lebar.'">
				<input type="'.$type.'" class="form-control '.$nama.'" name="'.$nama.'" value="'.$nilai.'"  placeholder="'.$placeholder.'" '.$required.'>
			</div>
	  </div>';
}

function buat_upload($label, $nama, $nilai, $lebar='2', $type='file', $required=""){
    echo '<div class="form-group" id="'.$nama.'"> 
		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-'.$lebar.'">
			<input type="text" class="form-control" name="'.$nama.'_text" value="'.$nilai.'" readonly>
			<input type="'.$type.'" class="form-control '.$nama.'" name="'.$nama.'"  '.$required.'>  
			</div>
	  </div>';
}

function buat_textbox_readonly($label, $nama, $nilai, $lebar='4', $type='text'){
    echo '<div class="form-group" id="'.$nama.'"> 
		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-'.$lebar.'">
				<input type="'.$type.'" class="form-control" name="'.$nama.'" value="'.$nilai.'" readonly>
			</div>
		</div>';
}
function buat_textbox_artistId($label, $nama, $nilai, $lebar='4', $type='text'){
    echo '<div class="form-group" id="'.$nama.'"> 
		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-'.$lebar.'">
				<input type="'.$type.'" class="form-control" name="'.$nama.'" id = "'.$nama.'" value="'.$nilai.'" placeholder="Search By Name Artist">
			</div>
		</div>';
}
function buat_textarea($label, $nama, $nilai, $class='')
{
    echo '<div class="form-group" id="'.$nama.'"> 
		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-9">
				<textarea  class="form-control '.$class.'" name="'.$nama.'" rows="8"> '.$nilai.'</textarea>
			</div>
		</div>';
}
function buat_combobox($label, $nama, $list, $nilai, $lebar='4', $readonly="")
{
    echo '
	<div class="form-group">
		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
		<div class="col-sm-'.$lebar.'">
			<select class="form-control" name="'.$nama.'" id="'.$nama.'" '.$readonly.'>';
				
				if($nilai == "" || empty($nilai) or $nilai == NULL){
					echo '<option value="" selected> Select '.$label.'</option>';
				}
				foreach ($list as $ls ) {
					$select = $ls['val'] == $nilai ? 'selected' : '';
					echo '<option value="'.$ls['val'].'" '.$select.'>'.strtoupper($ls['cap']).'</option>';
				}

			echo '
			</select>
		</div>
	</div>';
}

//variabel idLabel hanya untuk membedakan id didalam div line 71 dengan div line 73, karena akan dibuat auto select dengan ajax
function buat_combobox_HIDE($label, $nama, $list, $nilai, $lebar='4', $idLabel=""){
    echo '
	<div class="form-group" id="'.$nama.'">
	    <label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
		<div class="col-sm-'.$lebar.'" id="'.$idLabel.'">
			<select class="form-control '.$nama.'" name="'.$nama.'">';
				
				if($nilai == ""  or empty($nilai) or $nilai == NULL){
					echo '<option value="" selected>Pilih</option>';
				}
				foreach ($list as $ls ) {
					# code...
					$select = $ls['val'] == $nilai ? 'selected' : '';
					echo '<option value='.$ls['val'].' '.$select.'>'.$ls['cap'].'</option>';
				}
				
			echo 
			'</select>
		</div>
	</div>';
}

function buat_combobox_To_Artist($label, $nama, $list, $nilai, $lebar='4'){
    echo '<div class="form-group" id="'.$nama.'">
		    <label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-'.$lebar.'">
			    <select class="form-control '.$nama.'" name="'.$nama.'" required>';

    if($nilai == ""  or empty($nilai) or $nilai == NULL){
        echo '<option value="" selected>Pilih</option>';
    }

    foreach ($list as $ls ) {
        # code...
        $select = $ls['val'] == $nilai ? 'selected' : '';
        echo '<option value='.$ls['val'].' '.$select.'>'.$ls['cap'].'</option>';
    }
    echo '</select>
			</div>
		   </div>';
}
//function buat_combobox($label, $nama, $list, $nilai, $lebar='4'){
//    echo '<div class="form-group" id="'.$nama.'">
//		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
//			<div class="col-sm-'.$lebar.'">
//				<select class="form-control" name="'.$nama.'">';
//    foreach ($list as $ls ) {
//        # code...
//        $select = $ls['val'] == $nilai ? 'selected' : '';
//        echo '<option value='.$ls['val'].' '.$select.'>'.$ls['cap'].'</option>';
//
//    }
//
//    echo '</select>
//			</div>
//		</div>';
//}

function buat_checkbox($label, $nama, $list){
    echo '<div class="form-group" id="'.$nama.'"> 
		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-10">';
    foreach ($list as $ls ) {
        # code...
        echo '<input type="checkbox" name="'.$nama.'" value="'.$ls['val'].'" '.$ls['check'].'>'.$ls['cap'].'&nbsp';

    }

    echo '</div>
		</div>';
}
function buat_radio($label, $nama, $list){
    echo '<div class="form-group" id="'.$nama.'"> 
		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
			<div class="col-sm-10">';
    foreach ($list as $ls ) {
        # code...
        echo '<label for="'.$nama.$ls['val'].'" id="label_'.$nama.$ls['val'].'"><input type="radio" name="'.$nama.'" id="'.$nama.$ls['val'].'" value="'.$ls['val'].'"'.$ls['check'].'>'.$ls['cap'].'</label>';


    }

    echo '</div>
		</div>';
}

function buat_tombol($name, $table, $idtable,$icon, $link, $warna){
    global $mysqli;
    $query = $mysqli->query("SELECT * FROM $table");
    $jml_data = $query->num_rows;
    echo '<div class="col-md-6 col-xs-12"><a href ="'.$link.'">
				<div class="panel panel-'.$warna.' dashboard-panel" style="border-width: 5px; border-color: black">
					<div class="panel-heading" style="background-color: Ghostwhite">
						<h3><i class="glyphicon glyphicon-'.$icon.'"></i> '.$name.'
						<span class="pull-right">'.$jml_data.'</span></h3>
					</div>
					<div class="panel-body" style="background-color: Ghostwhite"><b>Data Terakhir yang di Tambah</b><br/>
					<table class ="table table-responsive">
						<thead>
						<tr>
						<td align="center">Data ID</td>
						<td align="center">Title</td>
						</tr>
						</thead>
							<tbody>
							<tr>';
    $query1 = $mysqli->query("SELECT * FROM $table ORDER BY $idtable DESC LIMIT 1");
    while($data = $query1->fetch_array()){
        echo '<td align="center">'.$data[0].'</td>';
        echo '<td align="center">'.$data[1].'</td>';
    }
    echo '</tr>
				</tbody>
					</table>
					</div>
				</div>
				</a></div>';
}

function form_search($action, $input_name, $btn_name = 'Search', $additional_search = null)
{
	$search_get = (isset($_GET[$input_name]) ? $_GET[$input_name] : '');

	$html = '
	<form action="'.$action.'" method="GET">
		<div class="input-group">';
		    
		    if($additional_search <> null){
		    	$html .= '
		    	<input type="hidden" name="'.$additional_search['name'].'" class="form-control" value="'.$additional_search['value'].'">
		    	';
		    }
		    
		    $html .= '
		    <input type="search" name="'.$input_name.'" class="form-control" value="'.$search_get.'">
		    	<span class="input-group-btn">
				<button class="btn btn-primary" type="submit">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span> 
					'.$btn_name.'
				</button>
		    	</span>
		</div>
	</form>
	';

	return $html;
}
?>


