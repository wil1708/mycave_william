<?php require './request/read_post.php'; ?>



<div class="cave">
    <div class="container">
          
        <?php  while ($datas = $req->fetchObject()) : ?>

                <?php  echo '<div class="caveBottle1" style="background-image:url(http://localhost/mycave_william/assets/upload/' . $datas->image .');"></div>';
                ?>

                <div class="description"> 
        
                        <img src="<?php echo 'http://localhost/mycave_william/assets/upload/' . $datas->image; ?>" alt="Bouteille Saint Cosme">           
                        <h2><?php echo $datas->name; ?></h2>
                        <h3><?php echo $datas->year; ?></h3>
                        <h3><?php echo $datas->grape; ?></h3>
                        <h3><?php echo $datas->region; ?></h3>
                        <h3><?php echo $datas->country; ?></h3>
                        <p><?php echo $datas->description; ?></p>
            
                </div>

        <?php endwhile; ?> 
        
    </div>
</div>





