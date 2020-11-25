<?php

function result_object($data){

    $alldata = [];
	
	foreach ($data as $key => $val) {
		$alldata[$key] = (object)$val;
	}

	return $alldata;
}
?>