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

    if ('POST' == $_SERVER['REQUEST_METHOD']) {
        if ($_FILES['documents']['size'] <= 1000000){
            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['documents']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
            if (in_array($extension_upload, $extensions_autorisees)){
                // On peut valider le fichier et le stocker définitivement
                move_uploaded_file($_FILES['documents']['tmp_name'],               
                'uploads/' . basename($_FILES['documents']['name']));
            }
        }
        $insert = $bdd->prepare('INSERT INTO sinistre(numClient, typeSinistre, immatriculation, dateSinistre, details, documents) 
        VALUES(:numClient, :typeSinistre, :immatriculation, NOW(), :details, :documents)');
        $insert->execute([
            'numClient' => $user['numClient'],
            'typeSinistre' => $_POST['type'],
            'immatriculation' => $_POST['immac'],
            'details' => $_POST['details'],
            'documents' => $_POST['documents'],
        ]);
        header('Location: ../home.php');
    } else {
        header('Location: ../index.php');
    }
?>