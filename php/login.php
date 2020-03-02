<?php $username                 = isset($_GET['username']) ? $_GET['username'] : ''; ?>

<?php if (isset($_SESSION['id'])) :  ?>
<a class="disconnect" href="<?php echo SITE_URL . 'php/disconnect.php' ?>"><span class="disconnectColor">S</span>e déconnecter</a>
<?php else : ?>
<form action="<?php echo SITE_URL . 'request/login_post.php'; ?>" method="POST" enctype="multipart/form-data">
    <div class="loginTable">
        <label for="username"></label>
        <input type="text" name="username" id="username" placeholder="Nom d'utilisateur...">

        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="Mot de passe...">
        <div>
            <label for="button"></label>
            <input type="submit" value="Se connecter" name="button" id="button">
        </div>
    </div>
    <div class="msg"><?php if (isset($_GET['msg'])) echo $_GET['msg']; ?></div>
</form>
<?php endif; ?>
<?php  
if(isset($_GET['result']) && $_GET['result'] == 1) :
    header('Location:' . SITE_URL);
endif;
?>



