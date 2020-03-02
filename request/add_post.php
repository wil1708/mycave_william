<?php
require 'connect.php';
$name      = strip_tags($_POST['name']);
$year       = strip_tags($_POST['year']); 
$grape          = strip_tags($_POST['grape']); 
$region            = strip_tags($_POST['region']);
$country         = strip_tags($_POST['country']);
$shadow_var     = strip_tags($_POST['shadow_var']);
$file           = $_FILES['upload'];
var_dump($file);
// Liste des erreurs 
// https://www.php.net/manual/en/features.file-upload.errors.php

if (empty($firstname)) :
    $result = false;
    $response = 'Remplir le champ prénom';

elseif (empty($lastname)) :
    $result = false;
    $response = 'Remplir le champ nom';
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) :
    $result = false;
    $response = 'Renseigner un email valide';
elseif ($gender === 0) :
    $result = false;
    $response = 'Choisissez votre sexe';
elseif (empty($msg)) :
    $result = false;
    $response = 'Ecrire un message';
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
                INSERT INTO contact_form (id_gender, lastname, firstname, email, message, date_create, file_url)
                VALUES (:id_gender, :lastname, :firstname, :email, :message, NOW(), :file_url)
            ");
            $success = $req->execute(array(
                'id_gender' => $gender,
                'lastname'  => $lastname,
                'firstname' => $firstname,
                'email'     => $email,                
                'message'   => $msg,
                'file_url'  => ''
            ));

            if($success) :
                $result = true;
                $response = 'Message bien envoyé';
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
                    $upload_name    = '../upload/' . $dbname;

                    // bouge le fichier stocké temporairement vers un dossier du serveur
                    $move_result = move_uploaded_file($file['tmp_name'], $upload_name);

                    if($move_result) :

                        $req = $bdd->prepare("
                            INSERT INTO contact_form (id_gender, lastname, firstname, email,  message, date_create, file_url)
                            VALUES (:id_gender,:lastname, :firstname, :email, :message, NOW(), :file_url)
                        ");
                        $success = $req->execute(array(
                            'id_gender' => $gender,
                            'lastname'  => $lastname,
                            'firstname' => $firstname,
                            'email'     => $email,                            
                            'message'   => $msg,
                            'file_url'  => $dbname
                        ));

                        if($success) :
                            $result = true;
                            $response = 'Message bien envoyé';
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
    $get_request = "response=$response";
}
else {
    $get_request = "response=$response&firstname=$firstname&lastname=$lastname&email=$email&msg=$msg&gender=$gender";
}

header("Location: ../php/form.php?$get_request");
?>