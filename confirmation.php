<?php
if (isset($_GET['token'])) {
    session_start();
    require '/settings/config.php';

    if ($token = decode_token($_GET['token'])) {
        $stmt = $bdd->prepare(<<<'EOS'
                UPDATE clients
                SET confirmed_at = NOW(),
                    confirmation_token = NULL,
                    confirmation_token_sent_at = NULL
                WHERE confirmation_token = :token
                    AND confirmation_token_sent_at - INTERVAL 2 DAY
            EOS
        );
        $stmt->execute(['token' => $token]);
        $fail = 1 != $stmt->rowCount();
    } else {
        $fail = TRUE;
    }
    if ($fail) {
        $_SESSION['flash'] = "Le token d'activation est invalide ou a expiré";
        header('Location: resend_confirmation.php');
    } else {
        $_SESSION['flash'] = "Votre compte a bien été validé, vous pouvez maintenant vous identifier.";
        header('Location: login.php');
    }
    exit;
}