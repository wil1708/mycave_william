
<?php include 'param.php' ?>



<?php $username                 = isset($_GET['username']) ? $_GET['username'] : ''; ?>



<form action="request/login_post.php" method="POST" enctype="multipart/form-data">
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
</form>





