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