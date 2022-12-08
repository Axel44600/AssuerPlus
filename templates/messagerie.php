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
        $insert = $bdd->prepare('INSERT INTO messagerie(numClient, nom, prenom, dateMsg, msg) 
        VALUES(:numClient, :nom, :prenom, NOW(), :msg)');
        $insert->execute([
            'numClient' => $user['numClient'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'msg' => $_POST['msg'],
        ]);
        header('Location: ../home.php');
    } else {
        header('Location: ../index.php');
    }
?>