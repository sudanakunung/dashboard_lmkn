<?php
if($this->session->userdata('level') == 'artist'){
    if(!empty($this->session->userdata('level'))){ ?>
        <img src= "<?= $this->session->userdata("cover"); ?>" class="img-responsive" style="height: 100px;width: 100px;border-radius: 50%; -moz-border-radius: 50%;-webkit-border-radius: 50%;"> <br/>
    <?php
    }
    else{  ?>
        <img src= "<?= base_url()?>/image/user_placeholder.png" class="img-responsive" style="height: 100px;width: 100px;border-radius: 50%; -moz-border-radius: 50%;-webkit-border-radius: 50%;"> <br/>
    <?php
    }
}
elseif ($this->session->userdata('level') == 'admin'){
    
    if($this->session->userdata('admincountry') <> ''){ 

        if($this->session->userdata('admincountry') == 'ind'){ ?>
            <img src= "<?= base_url(); ?>image/profile/LMKN.jpg" class="img-responsive" style="height: auto; width: 100%; border-radius: 10%; -moz-border-radius: 10%;-webkit-border-radius: 10%;"> <br/>
        <?php 
        } else { ?>
            <img src= "<?= base_url(); ?>image/profile/FILSCAP.jpg" class="img-responsive" style="height: auto; width: 100%; border-radius: 10%; -moz-border-radius: 10%;-webkit-border-radius: 10%;"> <br/>
        <?php
        }
    } else { ?>
        <img src= "<?= base_url(); ?>image/profile/MYDIO.jpg" class="img-responsive" style="height: auto; width: 100%; border-radius: 10%; -moz-border-radius: 10%;-webkit-border-radius: 10%;"> <br/>
    <?php
    }
}
elseif(!empty($this->session->userdata('lembaga'))){ ?>
    <img src= "<?= base_url(); ?>image/profile/<?= $this->session->userdata('lembaga'); ?>.jpg" class="img-responsive" style="height: auto; width: 100%; border-radius: 10%; -moz-border-radius: 10%;-webkit-border-radius: 10%;"> <br/>
<?php
}
else{ ?>
    
    <img src= "<?= base_url()?>/image/user_placeholder.png" class="img-responsive" style="height: 100px;width: 100px;border-radius: 50%; -moz-border-radius: 50%;-webkit-border-radius: 50%;"> <br/>
<?php
}
?>

<span>
    <b>
    <?php
    if($this->session->userdata('level') == 'label'){
        if(!empty($this->session->userdata('labelname'))){
            echo $this->session->userdata('labelname');
        }
        else{
            echo "UNKNOW";
        }
    }
    elseif($this->session->userdata('level') == 'admin'){
        if($this->session->userdata('admincountry') == 'ind'){
            echo "ADMIN LMKN";
        } 
        else if($this->session->userdata('admincountry') == 'phi'){
            echo "ADMIN FILSCAP";
        }
        else {
            echo "ADMIN MYDIO";
        }
                
    }
    elseif($this->session->userdata('level') == 'adminartist'){
        echo "LMK ".$this->session->userdata('lembaga')." <br /> <small>Represent Artist</small>";
    }
    elseif($this->session->userdata('level') == 'adminlabel'){
        echo "LMK ".$this->session->userdata('lembaga')." <br /> <small>Represent Label</small>";
    }
    elseif($this->session->userdata('level') == 'admincomposer'){
        echo "LMK ".$this->session->userdata('lembaga')." <br /> <small>Represent Composer</small>";
    }
    elseif($this->session->userdata('level') == 'adminarranger'){
        echo "LMK ".$this->session->userdata('lembaga')." <br /> <small>Represent Arranger</small>";
    }
    elseif($this->session->userdata('level') == 'artist'){
        if(!empty($this->session->userdata('nameArtist'))){
            echo $this->session->userdata('nameArtist');
        }else{
            echo "UNKNOW";
        }
    }
    elseif($this->session->userdata('level') == 'composer'){
        if(!empty($this->session->userdata('nameComposer'))){
            echo $this->session->userdata('nameComposer');
        }else{
            echo "UNKNOW";
        }
    }
    elseif($this->session->userdata('level') == 'arranger'){
        if(!empty($this->session->userdata('nameArranger'))){
            echo $this->session->userdata('nameArranger');
        }else{
            echo "UNKNOW";
        }
    }
    ?>
    <br />
    </b>
</span>
<br/>



