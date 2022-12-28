<?php
require '../back/settings/config.php';

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
        $tel_length = mb_strlen($_POST['tel']);
        if ($tel_length < 10 || $tel_length > 10) {
            header('Location: ../home.php');
        } else if(!preg_match("#[0][6-7][- \.?]?([0-9][0-9][- \.?]?){4}$#", $_POST['tel'])) {
            header('Location: ../home.php');
        } else {

        $insert = $bdd->prepare('UPDATE clients SET tel = :tel, adresse = :adresse WHERE numClient = :numClient');
        $insert->execute([
            'tel' => $_POST['tel'],
            'adresse' => $_POST['adresse'],
            'numClient' => $user['numClient'],
        ]);
        header('Location: ../home.php');
    }} else {
        header('Location: ../index.php');
    }
?>