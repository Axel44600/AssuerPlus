<?php 
require './settings/config.php';

session_start();

const MIN_NAME_LEN = 3;
const MAX_NAME_LEN = 10;
const MIN_PASSWORD_LEN = 8;
const TEL_LEN = 10;

$errors = 0;
mb_internal_encoding('UTF-8');
if ('POST' == $_SERVER['REQUEST_METHOD']) {


    // NUM CLIENT

    $numClient = (rand(1, 10000) * rand(1, 10000));
    $stmt = $bdd->prepare('SELECT 1 FROM clients WHERE numClient = :numClient');
    if (FALSE !== $stmt->fetchColumn()) {
        $numClient = (rand(1, 10000) * rand(1, 10000) +1);
    }

    // MAIL

    if (array_key_exists('email', $_POST)) {
        $domain = substr(strrchr($_POST['email'], '@'), 1);
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors = 1;
        } else {
            $stmt = $bdd->prepare('SELECT 1 FROM clients WHERE email = :email');
            $stmt->execute(['email' => $_POST['email']]);
            if (FALSE !== $stmt->fetchColumn()) {
                $errors = 2;
            }
        }
    } 

    // NOM

    if (array_key_exists('nom', $_POST)) {
        $nom_length = mb_strlen($_POST['nom']);
        if ($nom_length < MIN_NAME_LEN || $nom_length > MAX_NAME_LEN) {
            $errors = 3;
        }
    }

    // PRENOM

    if (array_key_exists('prenom', $_POST)) {
        $prenom_length = mb_strlen($_POST['prenom']);
        if ($prenom_length < MIN_NAME_LEN || $prenom_length > MAX_NAME_LEN) {
            $errors = 4;
        } 
    } 

    // TEL

    if (array_key_exists('tel', $_POST)) {
        $tel_length = mb_strlen($_POST['tel']);
        if ($tel_length < TEL_LEN || $tel_length > TEL_LEN) {
            $errors = 5;
        } else if(!preg_match("#[0][6-7][- \.?]?([0-9][0-9][- \.?]?){4}$#", $_POST['tel'])){
            $errors = 6;
        } else {
            $stmt = $bdd->prepare('SELECT 1 FROM clients WHERE tel = :tel');
            $stmt->execute(['tel' => $_POST['tel']]);
            if (FALSE !== $stmt->fetchColumn()) {
                $errors = 7;
            }
    }}
    

    // MOT DE PASSE

    if (array_key_exists('pass', $_POST)) {
        $mdp_length = mb_strlen($_POST['pass']);
        if ($mdp_length < MIN_PASSWORD_LEN) {
            $errors = 8;
        }
        if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $_POST['pass'])) {
            $errors = 9;
        }
        if ($_POST['pass'] != $_POST['repass']) {
            $errors = 10;
        }
    } 

    if ($errors == 0) {
        $insert = $bdd->prepare('
                INSERT INTO clients(numClient, email, nom, prenom, password, ip, tel, bonus, malus, rang)
                VALUES(:numClient, :email, :nom, :prenom, :pass, :ip, :tel, :bonus, :malus, :rang)');
        $insert->execute([
            'numClient' => $numClient,
            'email' => $_POST['email'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'pass' => password_hash($_POST['pass'], $password_options['algo'], $password_options['options']),
            'ip' => getIp(),
            'tel' => $_POST['tel'],
            'bonus' => 100,
            'malus' => 0,
            'rang' => 0,
        ]);

        $_SESSION['connecte']=1;
        exit;
    }
}

echo json_encode(['error' => $errors]);
?>
