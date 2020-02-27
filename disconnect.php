<?php include '../param.php'; ?>
<?php session_unset(); ?> <!-- on vide toutes les variables de session -->
<?php session_destroy(); ?> <!-- on détruit la session -->

<?php header('location:' . SITE_URL); ?>