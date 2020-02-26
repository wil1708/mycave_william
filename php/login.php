<?php require '../param.php' ?>

<?php include 'header.php'; ?>

<form action="<?php echo SITE_URL . '/request/login_post.php';?>" method="POST" enctype="multipart/form-data">

    <label for="username"></label>
    <input type="text" name="username" id="username" placeholder="nom d'utilisateur...">

    <label for="password"></label>
    <input type="password" name="password" id="password" placeholder="mot de passe">

    <label for="button"></label>
    <input type="button" value="Se connecter" name="button" id="button">

</form>