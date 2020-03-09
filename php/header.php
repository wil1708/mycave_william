<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META -->
    <meta charset="UTF-8">
    <meta name="author" content="William Pires">
    <meta name="description" content="Site My Cave">
    <meta name="keywords" content="collection de bouteilles de vin, web development">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=3">

    <!-- OPEN GRAPH ogp.me -->
    <meta property="og:title" content="My Cave">
    <meta property="og:description" content="Collection de bouteilles de vin">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- LINKS -->
    <link rel="stylesheet" href="assets/css/style.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <title>My Cave</title>
</head>
<body>
    
    

    <header>
        <!-- NAVBAR -->
        <nav>
            <?php if (isset($_SESSION['id'])) :  ?>
            <div class="addButton">
                 <i class="fas fa-plus fa-4x"></i>
                <h4>ajouter une bouteille de collection</h4>
             </div>
         <?php endif; ?>
            <ul class="menu">
                <li>
                    <img class="admin" src="assets/img/logo_rouge.png" alt="logo rouge my cave">
                </li>
                <li>
                    <div>
                        <img class="admin" src="assets/img/userRed.png" alt="bouton icône administrateur">
                    </div>
                </li>
            </ul>
        </nav>
        <!-- FIN NAVBAR  -->
    </header>
        <!-- MAIN TITLE + BOUTEILLE -->
    <div class="main">
        <div class="bigTitle"><h1><span class="whiteSpan">m</span><span class="transparentText">yCAV</span><span class="whiteSpan">E</span></h1></div>

        <div class="cave">
            <div class="container">
                <div class="caveBottle1">
                
                </div>
                <div class="caveBottle2">
                
                </div>
                <div class="caveBottle2">
                
                </div>
                <div class="caveBottle2">
                
                </div>
                <div class="caveBottle2">
                
                </div>
                <div class="caveBottle2">
                
                </div>
                <div class="caveBottle2">
                
                </div>
                <div class="caveBottle2">
                
                </div>
                <div class="caveBottle2">
                
                </div>
                <div class="caveBottle2">
                
                </div>
                <div class="caveBottle2">
                
                </div>
            </div>
        </div>
        
        <div class="description">
            <img class="imgBottle" src="./assets/img/block_nine.jpg" alt="">
        
           
            <h2>Chateau de Saint Cosme</h2>
            <h3>2009</h3>
            <h3>GRENACHE / SYRAH</h3>
            <p>The aromas of fruit and spice give one a hint of the light drinkability of this lovely wine, which makes an excellent complement to fish dishes.
            </p>
        </div>
        <?php include 'create.php'; ?>
        <?php include 'login.php'; ?>
    </div>
    <script type="text/javascript" src="assets/libs/jquery/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="assets/dist/script.min.js"></script>

</body>
</html>



    