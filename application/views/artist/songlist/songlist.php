<?php

foreach ($results as $result){
    if($total == NULL or $total == '0' or empty($total)){
        echo '<div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!</b> Tidak Ada Lagu</center> </div>';
    }
    else{
        if($result->coverImage == NULL or $result->coverImage == '' or empty($result->coverImage)){
            echo '<div class="col-md-4" align="center">';?>
            <a href="?content=SongUser&show=grafik&id=<?php echo $result->songId; ?>"><img src="image/user_placeholder.png"   style="height: 200px; width: 200px; margin-top: 10px" class="img-responsive img-thumbnail"></a><center><b><?php echo $result->title; ?></b></center>
            <?php
            echo '</div>';
        }
        else{
            echo '<div class="col-md-4" align="center">'; ?>
            <a href="<?php echo base_url(); ?>songuser/grafik/<?php echo $result->songId; ?>"><img src="<?php echo $result->coverImage;; ?>"   style="height: 200px; width: 200px; margin-top: 10px" class="img-responsive img-thumbnail"></a>
            <center><b><?php echo $result->title; ?></b></center>
            <?php
            echo ' </div>';
        }

    }
}
?>
<div class="col-md-12">
				<!-- Menampilkan pagination -->
			<center>
                <?php echo $paginations;?>
            </center>
</div>
