<?php require('./settings/config.php'); ?>
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
    <div class="forgot-pass">
        <div class="pass">
            <h1>Demande de mot de passe</h1>

            <div class="form">
            <label for="">Vous êtes assuré au près du groupe <?php echo($sitename); ?></label><br>
            <a onclick="newPass()" class="answer" id="yes" href="#">Oui</a>
            <a onclick="newUser()" href="#" class="answer" id="no" style="background-color: #fff; color: #1E1E1E; border: 1px solid #1E1E1E;">Non</a>

            <div class="first-contain">
                <form action="#" method="post">
                    <label for="numS">Votre numéro de souscripteur</label><br>
                    <input type="text" name="nOrMail" id="numS" required><br>
                    <label for="mail">Votre email</label><br>
                    <input type="email" id="mail" name="mail" required><br>
                    <input type="submit" value="Valider">
                </form>
            </div>

<?php 
if (isset($_REQUEST['mail'], $_REQUEST['first-name'], $_REQUEST['last-name'], $_REQUEST['password'], $_REQUEST['repassword'], $_REQUEST['phoneNumber'])){
            
    // récupérer l'email
    $mail = stripslashes($_REQUEST['mail']);
    $mail = mysqli_real_escape_string($conn, $mail); 
    // récupérer le prénom
    $firstName = stripslashes($_REQUEST['first-name']);
    $firstName = mysqli_real_escape_string($conn, $firstName);
    // récupérer le nom
    $lastName = stripslashes($_REQUEST['last-name']);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    // récupérer le mot de passe 
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($conn, $password);
   /* // récupérer le re mot de passe 
    $repassword = stripslashes($_REQUEST['repassword']);
    $repassword = mysqli_real_escape_string($conn, $repassword);
    */
    // récupérer le téléphone
    $tel = stripslashes($_REQUEST['phoneNumber']);
    $tel = mysqli_real_escape_string($conn, $tel);
    
    $query = "INSERT into `clients` (email, password, prenom, nom, tel)
    VALUES ('$mail', '".hash('sha256', $password)."', '$firstName', '$lastName', '$tel')";
    $res = mysqli_query($conn, $query);
      if($res){
         echo "<div class='sucess'>
               <h3>Vous êtes inscrit avec succès.</h3>";
               header("Location : home.php");
      }
      
} else {
    echo"ERREUR!";
  }
?>

            <div class="second-contain" style="display: none;">
                <form action="#" method="post">
                    <label for="mail">Votre email</label><br>
                    <input type="email" name="mail" id="mail" required><br>
                    <label for="first-name">Nom</label>
                    <input type="text" id="first-name" name="first-name" required>

                    <label for="last-name">Prénom</label>
                    <input type="text" id="last-name" name="last-name" required><br>

                    <label for="password">Votre mot de passe</label>
                    <input type="password" id="password" name="password" required><br>

                    <label for="repassword">Veuillez resaisir votre mot de passe</label>
                    <input type="password" id="repassword" name="repassword" required><br>

                    <label for="phoneNumber">Votre numéro de téléphone</label>
                    <input type="tel" id="phoneNumber" name="phoneNumber" required>

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