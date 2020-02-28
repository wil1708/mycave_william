<?php 
include 'connect.php';
include '../param.php';

$username = trim(strip_tags($_POST['username']));
$password = trim(strip_tags($_POST['password']));

if($username) {
$req = $bdd->prepare("
    SELECT *
    FROM admin
    WHERE username = :username    
");

$req->bindValue(':username', $username, PDO::PARAM_STR);

$req->execute();

$result = $req->fetch();

    if($result) {
        $hash = $result['password'];

        if(password_verify($password, $hash)) {
            $_SESSION['id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            

            $msg_success = "Vous êtes bien connecté";
        }

        else {
            $msg_error = "Le username ou le mot de passe  ne sont pas valides";
        }
}
    else {
        $msg_error = "Le username ou le mot de passe ne sont pas valides";
    }
}
else {
        $msg_error = "Le username ou le mot de passe ne sont pas valides";
}
if (isset($msg_error)) {
    $get_result = "msg=$msg_error&username=$username&result=0";
}
else {
    $get_result = "msg=$msg_success&result=1";
} 
header("Location: " . SITE_URL . "php/login.php?$get_result");

 ?>