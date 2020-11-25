<?php
buka_tabel(array("Song Id", "Title","Requested by the institution By", "Requested for"));

foreach ($dataSongRequest as $request){

	$requested_by = json_decode($request->requested_by);

	if ($request->artistId > 0) {
		$nameRequestedBy = "Artist ".$request->artist;
	}
	else if ($request->recordLabelId > 0){
		$nameRequestedBy = "Label ".$request->label;
	} else {
		$nameRequestedBy = "Composer ".$request->composer;
	}

    isi_tabel_request("", array($request->songId, $request->title, $requested_by->lembaga, $nameRequestedBy),base_url("songuserrequest/aksiapprove"), base_url("songuserrequest/aksidecline"), $request->tsongrequestId, true, true);
    
}
tutup_tabel();



