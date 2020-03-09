<?php
require 'connect.php';
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
                INSERT INTO maintable (id_secondtable, name, grape, region, country)
                VALUES (LAST_INSERT_ID(), :name, :grape, :region, :country);
                INSERT INTO secondtable (image, year, description)
                VALUES (:image, :year, :description);
            ");


            $success = $req->execute(array(
                'name'        => $name,
                'grape'       => $grape,
                'region'      => $region,                
                'country'     => $country,
                'image'       => '',
                'year'        => $year,
                'description' => $description
            ));

            if($success) :
                $result = true;
                $response = 'Nouveau produit ajouté';
            else :
                $result = false;
                $response = 'Holla';
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
                            INSERT INTO maintable (id_secondtable, name, grape, region, country)
                            VALUES (LAST_INSERT_ID(), :name, :grape, :region, :country);
                            INSERT INTO secondtable (image, year, description)
                            VALUES (:image, :year, :description);
                        ");

                        $success = $req->execute(array(
                            'name'        => $name,
                            'grape'       => $grape,
                            'region'      => $region,                
                            'country'     => $country,
                            'image'       => $dbname,
                            'year'        => $year,
                            'description' => $description
                        ));

                        var_dump($success);

                        if($success) :
                            $result = true;
                            echo 'Nouveau produit ajouté';
                        else :
                            $result = false;
                            echo 'Ca marche paaaaaaas';
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
                $response = 'L\'extension n\'est pas bonne';

            endif;

        endif;
        
    endif;

endif;

if($result) {
    $get_request = "response=$response";
}
else {
    $get_request = "response=$response&name=$name&year=$year&grape=$grape&region=$region&country=$country&description=$description";
}

/*header("Location: ../php/create.php?$get_request");*/
?>