<?php 

include './request/update_post.php';

$req=$bdd->prepare('

    SELECT name, region, country, image, grape, year, description
    FROM main_table
    WHERE id = ?

');

$req->execute(array($_GET['id_url']));
$donnees = $req->fetch();

?>

<form action="request/update_post?id_url=<?php echo $_GET['id_url']; ?>" method="POST" enctype="multipart/form-data">
    <div class="createForm2">
        <label for="name"></label>
        <input type="text" name="name" id="name" placeholder="Nom..." value="<?php echo $donnees['name']; ?>">

        <label for="year"></label>
        <input type="text" name="year" id="year" placeholder="Année..." value="<?php echo $donnees['year']; ?>">

        <label for="grape"></label>
        <input type="text" name="grape" id="grape" placeholder="Cépage..." value="<?php echo $donnees['grape']; ?>">

        <label for="region"></label>
        <input type="text" name="region" id="region" placeholder="Région..." value="<?php echo $donnees['region']; ?>">

        <label for="country"></label>
        <input type="text" name="country" id="country" placeholder="Pays..." value="<?php echo $donnees['country']; ?>">

        <label for="description"></label>
        <input type="text" name="description" id="description" placeholder="Description..." value="<?php echo $donnees['description']; ?>">

        <label for="image"></label>
        <input type="file" name="image" id="image" accept="image/*">
        <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
        <input type="hidden" name="shadow_var" value="shadow">

        <button class="buttonCreate" type="submit">Modifier</button>







































 