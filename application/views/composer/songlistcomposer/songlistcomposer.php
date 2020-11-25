<?php
if($results == NULL or $results == '0' or empty($results)){
    echo '<div class="alert alert-danger login-alert" role="alert"><center><b>Maaf!</b> Tidak Ada Lagu</center> </div>';
}
else{
    foreach ($results as $result){
    
        if($result->coverImage == NULL or $result->coverImage == '' or empty($result->coverImage)){
            echo '<div class="col-md-4" align="center">';?>
            <a href="?content=SongUser&show=grafik&id=<?php echo $result->songId; ?>"><img src="image/user_placeholder.png" style="height: 200px; width: 200px; margin-top: 10px" class="img-responsive img-thumbnail"></a><center><b><?php echo $result->title; ?></b></center>
            <?php
            echo '</div>';
        }
        else{
            echo '<div class="col-md-4" align="center">'; ?>
            <a href="<?= base_url(); ?>songusercomposer/grafik/<?php echo $result->songId; ?>"><img src="<?= $result->coverImage; ?>" style="height: 200px; width: 200px; margin-top: 10px" class="img-responsive img-thumbnail"></a>
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
