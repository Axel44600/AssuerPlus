<?php
# Paramètres pour le hachage des mots de passe
$password_options = [
    'algo' => PASSWORD_DEFAULT,
    'options' => [
        'cost' => 12,
    ]
];

# Connexion à la base de données
$bdd = new PDO('mysql:host=localhost;dbname=AssuerPlus;charset=utf8', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Configuration du site
$sitename = "AssuerPlus";





// Fonctions

const BLACKLIST_EMAIL_PROVIDERS = [
    'yopmail.com',
    # ...
];

# génère un token binaire de $length octets
function generate_token(int $length): string {
    return openssl_random_pseudo_bytes($length);
}

# encode un token pour figurer dans une URL (en $_GET)
function encode_token(string $token): string {
    return base64_encode($token);
}

# décode le token provenant d'une URL ($_GET)
function decode_token(string $token)/*: false | string*/ {
    return base64_decode($token, TRUE);
}

function render_to_string(string $path, array $assigns = []): string {
    ob_start();
    extract($assigns);
    include $path;
    return ob_get_flush();
}

function send_mail_confirmation(string $to, string $login, string $token): void {
    $message = render_to_string(
        __DIR__ . '/../templates/confirmation_email.php',
        [
            'pseudo' => $login,
            'token' => encode_token($token),
        ]
    );
    $headers = [
        'Content-Type' => 'text/html; charset=UTF-8',
        # ...
    ];
    mail($to, 'Validation de votre compte mon.site.fr', $message, $headers);
}
?>