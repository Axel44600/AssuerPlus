<?php 
require('./back/settings/config.php');
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
    <link rel="stylesheet" href="./web/css/header.css">
    <title><?php echo($sitename); ?> – Assurance auto</title>
    <script src="./web/js/header.js"></script>
</head>
<body>

<?php require('./head/header.php') ?>

<section class="one_box">
    <div class="bg"></div>
        <div class="option">
            <div class="opt">
                <div class="icon-voiture"></div>
                <h1>Auto</h1>
                <a href="#">Obtenir mon tarif</a>
            </div>
            <div class="opt">
                <div class="icon-sinistre"></div>
                <h1>Sinistre</h1>
                <a href="./home.php">Déclarer un sinistre</a>
            </div>
            <div class="opt">
                <div class="icon-assurance"></div>
                <h1>Assurances</h1>
                <a href="#">Découvrir</a>
            </div>
        </div>
</section>


<section class="two_box" id="about">
    <h1><?php echo($sitename); ?>, votre complice de vies</h1>
    <hr><br>
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