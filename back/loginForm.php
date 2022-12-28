<?php 
require('./settings/config.php');

session_start();

$fail = FALSE;
if ('POST' == $_SERVER['REQUEST_METHOD']) {
    $stmt = $bdd->prepare('SELECT * FROM clients WHERE email = :numOrEmail OR numClient = :numOrEmail');
    $stmt->execute(['numOrEmail' => $_POST['numOrEmail']]);

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if (password_verify($_POST['pass'], $row['password'])) {
            $_SESSION['id'] = $row['id'];
            if (password_needs_rehash($row['pass'], $password_options['algo'], $password_options['options'])) {
                $stmt = $bdd->prepare('UPDATE clients SET password = :new_hash, ip = :ip WHERE id = :id');
                $stmt->execute([
                    'id' => $row['id'],
                    'ip' => getIp(),
                    'new_hash' => password_hash($_POST['pass'], $password_options['algo'], $password_options['options']),
                ]);
            }
            $fail = FALSE;
            $_SESSION['connecte']=1;
            exit;
        } else {
            $fail = TRUE;
        }
    } else {
        $fail = TRUE;
    }
}

if($fail) {
    $error = "N° de souscripteur / email ou mot de passe incorrect.";
    echo json_encode(['error' => $error]);
}
?>

