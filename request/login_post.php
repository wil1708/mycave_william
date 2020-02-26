<?php include 'header.php'; ?>
<?php  
$pass_hash=sha1($_POST['password']);
$username=$_POST['username'];

$req=$bdd->prepare('SELECT id FROM user WHERE username=:usernameREQ AND password =:passwordREQ');
$req->execute(array(
'usernameREQ'=>$username,
'passwordREQ'=> $pass_hash
));
$resultat = $req->fetch();

if(!$resultat){
    header('Location: login.php?msg=Votre identifiant ou votre mot de passe n\'est pas reconnu.');
}
else {
    session_start();
    $_SESSION['id']=$resultat['id'];
    $_SESSION['pseudo']= $username;
    header('Location: admin.php');
}

?>