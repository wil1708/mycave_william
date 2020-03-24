<?php 

session_start();
    include 'connect.php';
    include '../param.php';

    $req=$bdd->prepare('
    DELETE FROM main_bottle
    WHERE id=?

');
    

    $req->execute(array($_GET['id_url']));

    $msg = 'Bouteille supprimée !';
    header("Location: " . SITE_URL);

 ?>