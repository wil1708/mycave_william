<?php 

require 'connect.php';

$req = $bdd->query("
    SELECT main_bottle.name, change_bottle.year, change_bottle.grape, main_bottle.region, main_bottle.country, change_bottle.description, change_bottle.image
    FROM main_bottle, change_bottle
    
");

?>