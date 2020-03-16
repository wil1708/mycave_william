<?php 

require 'connect.php';

$req = $bdd->query("
    SELECT name, region, country, image, grape, year, description
    FROM main_bottle
    
");

