<?php
require "connect.php";
require "../param.php";
$password   = "admin";
$hash       = password_hash($password, PASSWORD_DEFAULT);
$req = $bdd->prepare("
    INSERT INTO admin(username, password)
    VALUES (:username, :password)
");
$req->bindValue(":username", "admin", PDO::PARAM_STR);
$req->bindValue(":password", $hash, PDO::PARAM_STR);
$result = $req->execute();
?>






























 