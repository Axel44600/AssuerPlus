<?php
# Paramètres pour le hachage des mots de passe
$password_options = [
    'algo' => PASSWORD_DEFAULT,
    'options' => [
        'cost' => 12,
    ]
];

# Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=assuerplus;charset=utf8', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Configuration du site
$sitename = "AssuerPlus";

// Fonctions
function getIp() {
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }
?>