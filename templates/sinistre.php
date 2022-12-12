<?php
require '../settings/config.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../login.php');
    exit;
}

$stmt = $bdd->prepare('SELECT * FROM clients WHERE id = :id');
$stmt->bindParam('id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch();
$verif = false;

$extensions_autorisees = array('pdf');

    if ('POST' == $_SERVER['REQUEST_METHOD']) {
        $uploads_dir = '../uploads';

        foreach ($_FILES["documents"]["error"] as $key => $error) {
            $infosfichier = pathinfo($_FILES["documents"]["name"][$key]);
            $extension_upload = $infosfichier["extension"];

            if(!in_array($extension_upload, $extensions_autorisees)) {
                header('Location: ../home.php');
            } elseif($error == UPLOAD_ERR_OK) {
                $tmp_name = $_FILES["documents"]["tmp_name"][$key];

                $name = $_FILES["documents"]["name"][$key];
                $file = '' .$user['numClient']. '_' .$_POST['immac']. '_DOC_' .$key. '.' .$extension_upload;
                move_uploaded_file($tmp_name, "$uploads_dir/$file");
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
                'documents' => 0,
            ]);
            header('Location: ../home.php');
        } else {
            header('Location: ../home.php');
        }
    } else {
        header('Location: ../index.php');
    }
?>