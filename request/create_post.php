<?php
require 'connect.php';
include '../param.php';
$name               = strip_tags($_POST['name']);
$year               = strip_tags($_POST['year']); 
$grape              = strip_tags($_POST['grape']); 
$region             = strip_tags($_POST['region']);
$country            = strip_tags($_POST['country']);
$description        = strip_tags($_POST['description']);
$file               = $_FILES['image'];
$shadow_var         = strip_tags($_POST['shadow_var']);

// Liste des erreurs 
// https://www.php.net/manual/en/features.file-upload.errors.php

if (empty($name)) :
    $result = false;
    $response = 'Remplir le champs nom';

elseif (empty($year)) :
    $result = false;
    $response = 'Remplir le champ année';

elseif (empty($grape)) :
    $result = false;
    $response = 'Remplir le champ cépage';

elseif (empty($region)) :
    $result = false;
    $response = 'Remplir le champ région';

elseif (empty($country)) :
    $result = false;
    $response = 'Remplir le champ pays';

elseif (empty($description)) :
    $result = false;
    $response = 'Remplir le champ description';
else :
    $error = $file['error'];
    if( $error > 0 && $error != 4) :

        if( $error == 1 || $error == 2) :
            $result = false;
            $response = 'La taille du fichier est trop importante';
        else :
            $result = false;
            $response = 'Une erreur s\'est produite pendant le chargement';
        endif;

    else :
        if($error == 4) :

            $req = $bdd->prepare("

                INSERT INTO change_bottle (image, year, description)
                VALUES (:image, :year, :description);
                INSERT INTO main_bottle (id_change_bottle, name, grape, region, country)
                VALUES (LAST_INSERT_ID(), :name, :grape, :region, :country);
                
            ");


            $success = $req->execute(array(
                'image'       => '',
                'year'        => $year,
                'description' => $description,
                'name'        => $name,
                'grape'       => $grape,
                'region'      => $region,                
                'country'     => $country
                
            ));

            if($success) :
                $result = true;
                $response = 'Nouveau produit ajouté';
            else :
                $result = false;
                $response = 'Oups ! une erreur s\'est produite';
            endif;
            
        else :

            $valid_ext = array('jpg','jpeg','png');

            //1. strrchr renvoie l'extension avec le point (« . »).
            //2. substr(chaine,1) ignore le premier caractère de chaine.
            //3. strtolower met l'extension en minuscules.
            $upload_ext = strtolower(substr(strrchr($file['name'], '.'),1));

            // ou plus simple
            // $upload_ext = pathinfo($file['name'],PATHINFO_EXTENSION));

            if(in_array($upload_ext,$valid_ext)) :

                if($file['size'] <= 1000000) :

                    $dbname         = uniqid() . '_' . $file['name'];
                    $upload_name    = '../assets/img/' . $dbname;

                    // bouge le fichier stocké temporairement vers un dossier du serveur
                    $move_result = move_uploaded_file($file['tmp_name'], $upload_name);

                    if($move_result) :

                        $req = $bdd->prepare("

                            INSERT INTO change_bottle (image, year, description)
                            VALUES (:image, :year, :description);
                            INSERT INTO main_bottle (name, grape, region, country, id_change_bottle)
                            VALUES (:name, :grape, :region, :country, LAST_INSERT_ID());
                            
                        ");


                        $success = $req->execute(array(
                            'image'       => $dbname,
                            'year'        => $year,
                            'description' => $description,
                            'name'        => $name,
                            'grape'       => $grape,
                            'region'      => $region,                
                            'country'     => $country
                            
                        ));

                        var_dump($success);

                        if($success) :
                            $result = true;
                            $response = 'Nouveau produit ajouté';
                        else :
                            $result = false;
                            $response = 'Oups ! une erreur s\'est produite';
                        endif;

                    else :
                    
                        $result = false;
                        $response = 'Une erreur s\'est produite pendant le transfert de fichier';

                    endif;

                else :

                    $result = false;
                    $response = 'La taille du fichier est trop importante';

                endif;

            else:

                $result = false;
                $response = 'Le fichier n\'est pas une image de type png, jpg ou jpeg';

            endif;

        endif;
        
    endif;

endif;

if($result) {
    $get_request = "?response=$response";
}
else {
    $get_request = "?response=$response&name=$name&year=$year&grape=$grape&region=$region&country=$country&description=$description";
}

header("Location: " . SITE_URL . "$get_request");
?>