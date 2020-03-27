<?php 

include 'connect.php';

$req = $bdd->prepare('

    UPDATE main_bottle
    SET name=?, region=?, country=?, image=?, grape=?, year=?, description=?
    WHERE id=?

    ');

$req->execute(array(
    $_POST['name'],
    $_POST['region'],
    $_POST['country'],
    $_POST['image'],
    $_POST['grape'],
    $_POST['year'],
    $_POST['description'],
    $_GET['id_url']
));

$donnees= $req->fetch();

















?>