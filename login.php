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
            header('Location: home.php');
            exit;
        } else {
            $fail = TRUE;
        }
    } else {
        $fail = TRUE;
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
    <link rel="stylesheet" href="./web/css/login.css">
    <link rel="stylesheet" href="./web/css/header.css">
    <title>Connexion - <?php echo($sitename); ?></title>
    <script src="./web/js/header.js"></script>
</head>
<body>

<?php require('./head/header.php') ?>

<section class="one_box">
    <div class="bg1">
    <div class="login">
        <div class="login-form">
            <h1 style="overflow: hidden;">Accéder à mon espace personnel</h1>

<?php if ($fail): ?>
<p style="margin-top: 10px; width: 80%; display: block; padding: 10px; border-radius: 8px; background-color: #df3b3b; color: #FFF;">N° de souscripteur / email ou mot de passe incorrect.</p>
<?php endif ?>

            <form action="" method="post">
            <label for="mail">N° de souscripteur / email</label><br>
            <input type="text" placeholder="ex: 56444392829..." name="numOrEmail" id="mail" minlength="3" pattern="[A-Za-z-@-.--]" required><br>
            <label for="password">Mot de passe</label><br>
            <input type="password" placeholder="*********" type="password" id="password" name="pass" required><br>
            <small><a href="./first-login.php">1ère connexion / Mot de passe oublié ?</a></small>
            <input type="submit" value="Se connecter">
            </form>

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

<section class="two_box" id="help" style="display: flex; flex-wrap: wrap;">
    <div class="help">
            <div class="help-contact">
                <h1>Assistance</h1>
                <hr>
                <br>
                <span style="text-align: center;">
                    <b>Une urgence ? Assistance 24 h/24, 7 j/7 </b>
                <br><br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vitae rem consequuntur, magni quos possimus aspernatur esse quidem odit hic, adipisci tempora ipsam. Vero repellat eveniet dicta tempore, recusandae nesciunt a ut minus beatae, assumenda nisi autem? Consectetur non nemo unde alias quae rerum quis minima ipsum molestias quaerat, ratione recusandae vitae illo dicta inventore labore atque? Facilis reiciendis corporis nobis eligendi possimus ducimus autem aliquam consequuntur tenetur! Ipsam sequi quas doloremque, blanditiis quisquam delectus repudiandae sed id, tempore inventore ab similique modi doloribus? Provident ipsa totam, pariatur vel nisi cum autem, laboriosam est, nam quasi voluptate corporis vitae velit odio?</p>
                </span>
                
              
            </div>
            <div class="pictures">
                <div style="background-image: url(./web/img/first-contact-picture.png); margin-bottom: 20px; border-radius: 10px 10px 0px 0px; width: 80%; height: 200px;"></div>
                <div style="background-image: url(./web/img/second-contact-picture.png); border-radius: 0px 0px 10px 10px; background-size: cover; width: 80%; height: 200px;"></div>
            </div>
    </div>
    
</section>

<?php require('./head/footer.php') ?>
    
</body>
</html>