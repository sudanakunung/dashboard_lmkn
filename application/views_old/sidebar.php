<ul class="nav">
    <?php
    //artist//
    buat_menu('mainscreen','home','Main Screen', array("artist"));
    buat_menu("songlist","headphones", "Song List", array("artist"));
    buat_menu("songuser","list-alt", "Song User", array("artist"));
    buat_menu("subscription","heart-empty", "Subscription", array("artist"));
    //label//
    // buat_menu("mainscreenlabel","dashboard", "Dashboard", array("label"));
    // buat_menu("adminlabel","user","Artist",array("label"));
    // buat_menu("songlabel","music","Lagu",array("label"));
    // buat_menu("subscriptionlabel","heart-empty", "Subscription", array("label"));
    buat_menu('mainscreenlabel','home','Main Screen', array("label"));
    buat_menu("songlistlabel","headphones", "Song List", array("label"));
    buat_menu("songuserlabel","list-alt", "Song User", array("label"));
    buat_menu("subscriptionlabel","heart-empty", "Subscription", array("label"));
    //composer//
    buat_menu('mainscreencomposer','home','Main Screen', array("composer"));
    buat_menu("songlistcomposer","headphones", "Song List", array("composer"));
    buat_menu("songusercomposer","list-alt", "Song User", array("composer"));
    buat_menu("subscriptioncomposer","heart-empty", "Subscription", array("composer"));
    //arranger//
    buat_menu("mainscreenarranger","dashboard", "Dashboard", array("arranger"));
    buat_menu("songlistarranger","headphones", "Song List", array("arranger"));
    buat_menu("songuserarranger","list-alt", "Song User", array("arranger"));
    buat_menu("subscriptionarranger","heart-empty", "Subscription", array("arranger"));
    
    //admin lkm artist//
    buat_menu("songadminartist","music","Music",array("adminartist"));
    // buat_menu("recordingadminartist","headphones","Recording",array("adminartist"));
    buat_menu("vieweradminartist","eye-open","Viewer",array("adminartist"));
    buat_menu("likeadminartist","thumbs-up","Like",array("adminartist"));
    // buat_menu("artistlist","star","Artist Referral",array("adminartist"));
    // buat_menu("banneradminartist","flag","Banner",array("adminartist"));
    buat_menu("songrequestadminartist","bullhorn","Song Request",array("adminartist"));
    
    //admin lkm label//
    buat_menu("songadminlabel","music","Music",array("adminlabel"));
    // buat_menu("recordingadminlabel","headphones","Recording",array("adminlabel"));
    buat_menu("vieweradminlabel","eye-open","Viewer",array("adminlabel"));
    buat_menu("likeadminlabel","thumbs-up","Like",array("adminlabel"));
    // buat_menu("labellist","th-list","Publisher / Label",array("adminlabel"));
    // buat_menu("banneradminlabel","flag","Banner",array("adminlabel"));
    buat_menu("songrequestadminlabel","bullhorn","Song Request",array("adminlabel"));
    
    //admin lkm composer//
    buat_menu("songadmincomposer","music","Music",array("admincomposer"));
    // buat_menu("recordingadmincomposer","headphones","Recording",array("admincomposer"));
    buat_menu("vieweradmincomposer","eye-open","Viewer",array("admincomposer"));
    buat_menu("likeadmincomposer","thumbs-up","Like",array("admincomposer"));
    // buat_menu("composerlist","cd","Composer",array("admincomposer"));
    // buat_menu("banneradmincomposer","flag","Banner",array("admincomposer"));
    buat_menu("songrequestadmincomposer","bullhorn","Song Request",array("admincomposer"));
    
    //admin lkm arranger//
    buat_menu("recordingadminarranger","headphones","Recording",array("adminarranger"));
    buat_menu("vieweradminarranger","eye-open","Viewer",array("adminarranger"));
    buat_menu("likeadminarranger","thumbs-up","Like",array("adminarranger"));
    buat_menu("songadminarranger","music","Music",array("adminarranger"));
    buat_menu("arrangerlist","tag","Arranger",array("adminarranger"));
    buat_menu("banneradminarranger","flag","Banner",array("adminarranger"));

    // admin //
    // buat_menu("dashboardadmin","dashboard", "Dashboard", array("admin"));
    // buat_menu("loginartistadmin","star", "Create Login Artist", array("admin"));

    // $permission = getACL($this->session->userdata('roleId'),2010);//tabel user
    // if(isset($permission)){
    //     if($permission->canRead == true){
    //         buat_menu("useradmin","heart","User", array("admin"));
    //     }
    // }

    // $permission = getACL($this->session->userdata('roleId'),10);//tabel admin
    // if(isset($permission)){
    //     if($permission->canRead == true){
    //         buat_menu("adminadmin","user","Admin",array("admin"));
    //     }
    // }

    $permission = getACL($this->session->userdata('roleId'),1030);//tabel song
    if(isset($permission)){
        if($permission->canRead == true){
            buat_menu("songadmin","music","Music",array("admin"));
        }
    }

    if($this->session->userdata('admincountry') == "" || $this->session->userdata('admincountry') == "ind"){
        $permission = getACL($this->session->userdata('roleId'),2020);//tabel recording
        if(isset($permission)){
            if($permission->canRead == true){
                buat_menu("recordingadmin","headphones","Recording",array("admin"));
            }
        }
    }

    $permission = getACL($this->session->userdata('roleId'),1030);//tabel song viewer
    if(isset($permission)){
        if($permission->canRead == true){
            buat_menu("viewer","eye-open","Viewer",array("admin"));
        }
    }

    $permission = getACL($this->session->userdata('roleId'),1030);//tabel song like
    if(isset($permission)){
        if($permission->canRead == true){
            buat_menu("like","thumbs-up","Like",array("admin"));
        }
    }

    $permission = getACL($this->session->userdata('roleId'),2050);//tabel composer
    if(isset($permission)){
        if($permission->canRead == true){
            buat_menu("composer","cd","Composer",array("admin"));
        }
    }

    $permission = getACL($this->session->userdata('roleId'),2040);//tabel label
    if(isset($permission)){
        if($permission->canRead == true){
            buat_menu("labeladmin","th-list","Publisher / Label",array("admin"));
        }
    }

    $permission = getACL($this->session->userdata('roleId'),2050);//tabel composer
    if(isset($permission)){
        if($permission->canRead == true){
            buat_menu("arranger","tag","Content Provider",array("admin"));
        }
    }

    $permission = getACL($this->session->userdata('roleId'),1010); // tabel artist ini antara ada dan tiada di halaman mydiosingrapih
    if(isset($permission)){
        if($permission->canRead == true){
            buat_menu("artistadmin","star","Artist Referral",array("admin"));
        }
    }

    /* $permission = getACL($this->session->userdata('roleId'),2060);//tabel song request
    if(isset($permission)){
        if($permission->canRead == true){
            buat_menu("songbankadmin","play-circle","Song Bank",array("admin"));
        }
    } */

    if($this->session->userdata('admincountry') == ""){
        $permission = getACL($this->session->userdata('roleId'),2070); // tabel banner
        if(isset($permission)){
            if($permission->canRead == true){
                buat_menu("banneradmin","flag","Banner",array("admin"));
            }
        }
    }

    $permission = getACL($this->session->userdata('roleId'),2060);//tabel song request
    if(isset($permission)){
        if($permission->canRead == true){
            buat_menu("songrequestadmin","bullhorn","Song Request",array("admin"));
        }
    } 

    // $permission = getACL($this->session->userdata('roleId'),1010);//tabel artist ini antara ada dan tiada di halaman mydiosingrapih
    // if(isset($permission)){
    //     if($permission->canRead == true){
    //         buat_menu("artistadmin","user","Artist",array("admin"));
    //     }
    // }

    // buat_menu("artistadmin","star", "Artist Referral", array("admin"));
    // buat_menu("banneradmin","flag", "Banner", array("admin"));
    // buat_menu("permissionadmin","lock", "Permission", array("admin"));

    ?>
</ul>