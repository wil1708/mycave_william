<?php 

require 'connect.php';

$req = $bdd->query("
    SELECT id, name, region, country, image, grape, year, description
    FROM main_bottle
    
");

