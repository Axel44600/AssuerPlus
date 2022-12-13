<?php 
require './settings/config.php';
session_start();

if (isset($_SESSION['id'])) {
    header('Location: home.php');
    exit;
}

const MIN_NAME_LEN = 3;
const MAX_NAME_LEN = 10;
const MIN_PASSWORD_LEN = 8;
const TEL_LEN = 10;

$errors = [];
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
            $errors['email'] = "L'adresse email est invalide";
        } else if (in_array($domain, BLACKLIST_EMAIL_PROVIDERS)) {
            $errors['email'] = sprintf("Les adresses email provenant de '%s' ne sont pas acceptées", htmlspecialchars($domain));
        } else {
            $stmt = $bdd->prepare('SELECT 1 FROM clients WHERE email = :email');
            $stmt->execute(['email' => $_POST['email']]);
            if (FALSE !== $stmt->fetchColumn()) {
                $errors['email'] = "Cette adresse email est déjà utilisée";
            }
        }
    } else {
        $errors['email'] = "Veuillez saisir votre adresse email.";
    }

    // NOM

    if (array_key_exists('nom', $_POST)) {
        $nom_length = mb_strlen($_POST['nom']);
        if ($nom_length < MIN_NAME_LEN || $nom_length > MAX_NAME_LEN) {
            $errors['nom'] = sprintf("Veuillez saisir votre vrai nom.");
        }
    } else {
        $errors['nom'] = "Veuillez saisir votre nom.";
    }

    // PRENOM

    if (array_key_exists('prenom', $_POST)) {
        $prenom_length = mb_strlen($_POST['prenom']);
        if ($prenom_length < MIN_NAME_LEN || $prenom_length > MAX_NAME_LEN) {
            $errors['prenom'] = sprintf("Veuillez saisir votre vrai prénom.");
        } 
    } else {
        $errors['prenom'] = "Veuillez saisir votre prénom.";
    }

    // TEL

    if (array_key_exists('tel', $_POST)) {
        $tel_length = mb_strlen($_POST['tel']);
        if ($tel_length < TEL_LEN || $tel_length > TEL_LEN) {
            $errors['tel'] = sprintf("Numéro de téléphone incorrect.");
        } else if(!preg_match("#[0][6-7][- \.?]?([0-9][0-9][- \.?]?){4}$#", $_POST['tel'])){
            $errors['tel'] = sprintf("Numéro de téléphone incorrect.");
        } else {
            $stmt = $bdd->prepare('SELECT 1 FROM clients WHERE tel = :tel');
            $stmt->execute(['tel' => $_POST['tel']]);
            if (FALSE !== $stmt->fetchColumn()) {
                $errors['tel'] = "Ce numéro de téléphone est déjà utilisé.";
            }
        }
    } else {
        $errors['tel'] = "Veuillez saisir votre numéro de téléphone.";
    }
    

    // MOT DE PASSE

    if (array_key_exists('pass', $_POST)) {
        $mdp_length = mb_strlen($_POST['pass']);
        if ($mdp_length < MIN_PASSWORD_LEN) {
            $errors['pass'] = sprintf("La longueur du mot de passe doit être d'au moins %d caractères", MIN_PASSWORD_LEN);
        }
        if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $_POST['pass'])) {
            $errors['pass'] = "Votre mot de passe doit contenir une majuscule et un caractère spécial.";
        }
        if ($_POST['pass'] != $_POST['repass']) {
            $errors['repass'] = "Le mot de passe et sa confirmation ne coïncident pas.";
        }
    } else {
        $errors['pass'] = "Veuillez saisir votre mot de passe.";
    }

    if (!$errors) {
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

        echo"<script>alert('Inscription réussie ! Vous pouvez désormais vous connecter sur votre espace personnel');</script>";
        header( "refresh:0;url=./login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./web/img/favicon_car.png"/>
    <link rel="apple-touch-icon" href="./web/img/favicon_car.png"/>
    <link rel="stylesheet" href="./web/css/style.css">
    <link rel="stylesheet" href="./web/css/index.css">
    <link rel="stylesheet" href="./web/css/first-login.css">
    <link rel="stylesheet" href="./web/css/header.css">
    <title>Première connexion - <?php echo($sitename); ?></title>
    <script src="./web/js/header.js"></script>
    <script src="./web/js/login.js"></script>
</head>
<body>

<?php require('./head/header.php') ?>

<section class="one_box">
<div class="bg1">

    <?php if ($errors): ?>
    <div class="error">
    <p>Veuillez corriger les erreurs ci-dessous afin de réaliser votre inscription :</p><br>
    <ul>
    <?php foreach ($errors as $e): ?>
    <li style="text-align: left;"><?= $e ?></li>
    <?php endforeach ?>
    </ul>
    </div>
    <?php endif ?>

    <div class="forgot-pass">
        <div class="pass">
            <h1>Demande de mot de passe</h1>

            <div class="form">
            <label for="">Vous êtes assuré au près du groupe <?php echo($sitename); ?></label><br>
            <a onclick="newPass()" class="answer" id="yes" href="#">Oui</a>
            <a onclick="newUser()" href="#" class="answer" id="no">Non</a>

            <div class="first-contain">
                
                    <label for="numS">Votre numéro de souscripteur</label><br>
                    <input type="text" name="nOrMail" id="numS" required><br>
                    <label for="mail">Votre email</label><br>
                    <input type="email" id="mail" name="mail" required><br>
                    <input type="submit" style="opacity: 0.7;" value="Indisponible..." disabled> 
            
            </div>


            <div class="second-contain">
                <form action="" method="post">
                    <label for="mail">Votre email</label><br>
                    <input type="email" name="email" id="mail" required><br>
                    <label for="first-name">Nom</label>
                    <input type="text" id="first-name" name="nom" minlength="<?php echo(MIN_NAME_LEN); ?>" maxlength="<?php echo(MAX_NAME_LEN); ?>" pattern="[A-Za-z]{3,10}" required>

                    <label for="last-name">Prénom</label>
                    <input type="text" id="last-name" name="prenom" minlength="<?php echo(MIN_NAME_LEN); ?>" maxlength="<?php echo(MAX_NAME_LEN); ?>" pattern="[A-Za-z]{3,10}" required><br>

                    <label for="password">Votre mot de passe</label>
                    <input type="password" id="password" name="pass" minlength="<?php echo(MIN_PASSWORD_LEN); ?>" required><br>

                    <label for="repassword">Veuillez resaisir votre mot de passe</label>
                    <input type="password" id="repassword" name="repass" minlength="<?php echo(MIN_PASSWORD_LEN); ?>" required><br>

                    <label for="phoneNumber">Votre numéro de téléphone</label>
                    <input type="tel" id="phoneNumber" name="tel" minlength="<?php echo(TEL_LEN); ?>" maxlength="<?php echo(TEL_LEN); ?>" required>

                    <input type="submit" value="Terminer">
                </form>
            </div>
        </div>

        </div>
    </div>
    </div>
</section>


<section class="two_box" id="about">
    <h1><?php echo($sitename); ?>, votre complice de vies</h1>
    <hr>
    <br>
    <span>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorem quis veniam qui soluta voluptatibus porro ad nostrum maxime eius, in, cupiditate nesciunt vel. Illum qui recusandae sequi, consequuntur quis hic voluptatum omnis saepe aliquid optio accusantium possimus cum veniam porro nostrum quia adipisci neque odit temporibus vitae ut deserunt a ipsam? Quo ut nisi, aliquam ad amet culpa molestiae voluptatibus numquam adipisci libero saepe, repudiandae ab! Molestiae neque eligendi dicta nemo. Nisi maiores eveniet neque enim vel esse asperiores nihil perspiciatis quia! Numquam quibusdam laudantium repudiandae blanditiis deleniti ipsum cum illo omnis ullam, praesentium quia, recusandae, doloribus molestiae officiis. Soluta corrupti, voluptas provident alias sint aut numquam nihil praesentium quisquam ducimus voluptatem autem veritatis commodi rerum, repudiandae excepturi possimus. Fugit, ducimus dolorum! Aliquam doloribus placeat aperiam atque minima, quis similique voluptates necessitatibus excepturi, incidunt ipsam, consectetur dolores sequi commodi asperiores eveniet nostrum. Quod nisi repudiandae officiis vel quae eaque incidunt doloribus iusto, sed corrupti neque quis ipsam sint. Dolore et perspiciatis fugiat quam accusamus velit eum. Officiis deleniti porro vel autem officia sit dolores odio maiores reiciendis provident perferendis maxime earum reprehenderit dolorum facilis, id nisi explicabo inventore debitis magnam laboriosam hic? Optio eveniet, iusto rerum quidem laudantium repellendus quis.</p>
    </span>   
</section>

<section class="two_box" id="map">
        <h1>Nos agences</h1>
            <hr>
            <br>
        <div class="map"></div>
</section>

<section class="two_box" id="help">
    <div class="help">
            <div class="help-contact">
                <h1>Assistance</h1>
                <hr>
                <br>
                <span>
                    <b>Une urgence ? Assistance 24 h/24, 7 j/7 </b>
                <br><br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae rem consequuntur, magni quos possimus aspernatur esse quidem odit hic, adipisci tempora ipsam. Vero repellat eveniet dicta tempore, recusandae nesciunt a ut minus beatae, assumenda nisi autem? Consectetur non nemo unde alias quae rerum quis minima ipsum molestias quaerat, ratione recusandae vitae illo dicta inventore labore atque? Facilis reiciendis corporis nobis eligendi possimus ducimus autem aliquam consequuntur tenetur! Ipsam sequi quas doloremque, blanditiis quisquam delectus repudiandae sed id, tempore inventore ab similique modi doloribus? Provident ipsa totam, pariatur vel nisi cum autem, laboriosam est, nam quasi voluptate corporis vitae velit odio?</p>
                </span>
                
              
            </div>
            <div class="pictures">
                <div class="first"></div>
                <div class="second"></div>
            </div>
    </div>
    
</section>


<?php require('./head/footer.php') ?>
    
</body>
</html>