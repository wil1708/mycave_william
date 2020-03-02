<form action="<?php echo SITE_URL . '/request/add_post.php'; ?>" method="POST" enctype="multipart/form-data">
    
    <label for="name"></label>
    <input type="text" name="name" id="name" placeholder="Nom...">  value="<?php echo $name; ?>">

    <label for="year"></label>
    <input type="text" name="year" id="year" placeholder="Année"> value="<?php echo $year; ?>">

    <label for="grape"></label>
    <input type="text" name="grape" id="grape" placeholder="Cépage..."> value="<?php echo $grape; ?>">

    <label for="region"></label>
    <input type="text" name="region" id="region" placeholder="Région..."> value="<?php echo $region; ?>">

    <label for="country"></label>
    <input type="text" name="country" id="country" placeholder="Pays..."> value="<?php echo $country; ?>">

    <label for="description"></label>
    <input type="text" name="description" id="description" placeholder="Description..."> value="<?php echo $description; ?>">

    <label for="image"></label>
    <input type="file" name="image" id="image" accept="image/*">
    <input type="hidden" name="MAX_FILE_SIZE" value="1000000">

    <?php
    if(isset($_GET['response'])) {
        echo '<div>' . $_GET['response'] . '</div>';
    }
    ?>

    <button type="submit">Ajouter</button>

</form>