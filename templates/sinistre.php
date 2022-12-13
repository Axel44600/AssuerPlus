<?php
$stmt = $bdd->prepare('SELECT * FROM clients WHERE id = :id');
$stmt->bindParam('id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch();

$verif = false;
$compteur = 0;
$date = date("Y-m-d");
$alert = "";

$extensions_autorisees = array('pdf');

    if ('POST' == $_SERVER['REQUEST_METHOD']) {
        $uploads_dir = './uploads';

        foreach ($_FILES["documents"]["error"] as $key => $error) {
            $infosfichier = pathinfo($_FILES["documents"]["name"][$key]);
            $extension_upload = $infosfichier["extension"];

            if(!in_array($extension_upload, $extensions_autorisees)) {
                header('Location: home.php');
            } elseif($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["documents"]["tmp_name"][$key];

                $name = $_FILES["documents"]["name"][$key];
                $file = '' .$user['numClient']. '_' .$_POST['immac']. '_' .$date. '_DOC_' .$key. '.' .$extension_upload;
                move_uploaded_file($tmp_name, "$uploads_dir/$file");
                $compteur++;
                $verif = true;
            }
        }

        if($verif){
            $insert = $bdd->prepare('INSERT INTO sinistre(numClient, typeSinistre, immatriculation, dateSinistre, details, documents) 
            VALUES(:numClient, :typeSinistre, :immatriculation, NOW(), :details, :documents)');
            $insert->execute([
                'numClient' => $user['numClient'],
                'typeSinistre' => $_POST['type'],
                'immatriculation' => $_POST['immac'],
                'details' => $_POST['details'],
                'documents' => $compteur,
            ]);
            
            if($_POST['type'] == "Accident / Collision") {
                $insert = $bdd->prepare('INSERT INTO messagerie(numClient, nom, prenom, dateMsg, msg, destinataire) 
                VALUES(:numClient, :nom, :prenom, NOW(), :msg, :destinataire)');
                $insert->execute([
                    'numClient' => 0,
                    'nom' => 'ADMIN',
                    'prenom' => 'ADMIN',
                    'msg' => 'Votre sinistre a bien été déclaré ! Je vous transmets les coordonnées d\'un garage partenaire à proximité ainsi que d\'une dépanneuse :<br>
                    <u>Garage MIDAS :</u> <a href="tel:+33240901340"><b>02 40 90 13 40</b></a><br>
                    <u>Dépanneuse :</u> <a href="tel:+33240622216"><b>02 40 62 22 16</b></a>',
                    'destinataire' => $user['numClient'],
                ]);
            } elseif($_POST['type'] == "Bris de glace") {
                $insert = $bdd->prepare('INSERT INTO messagerie(numClient, nom, prenom, dateMsg, msg, destinataire) 
                VALUES(:numClient, :nom, :prenom, NOW(), :msg, :destinataire)');
                $insert->execute([
                    'numClient' => 0,
                    'nom' => 'ADMIN',
                    'prenom' => 'ADMIN',
                    'msg' => 'Votre sinistre a bien été déclaré ! Je vous transmets les coordonnées d\'un garage partenaire à proximité :<br>
                    <u>Garage MIDAS :</u> <a href="tel:+33240901340"><b>02 40 90 13 40</b></a>',
                    'destinataire' => $user['numClient'],
                ]);
            } else {
                $insert = $bdd->prepare('INSERT INTO messagerie(numClient, nom, prenom, dateMsg, msg, destinataire) 
                VALUES(:numClient, :nom, :prenom, NOW(), :msg, :destinataire)');
                $insert->execute([
                    'numClient' => 0,
                    'nom' => 'ADMIN',
                    'prenom' => 'ADMIN',
                    'msg' => 'Votre sinistre a bien été déclaré !',
                    'destinataire' => $user['numClient'],
                ]);
            }
            
            header('Location: home.php');
        } else {
            header('Location: home.php');
        }
    } else {
       
    }
?>