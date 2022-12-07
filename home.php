<?php 
require './settings/config.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}


$stmt = $bdd->prepare('SELECT * FROM clients WHERE id = :id');
$stmt->bindParam('id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch();
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
    <link rel="stylesheet" href="./web/css/home.css">
    <link rel="stylesheet" href="./web/css/header.css">
    <title>Mon espace personnel - <?php echo($sitename); ?></title>

</head>
<body>

<header class="head" style="max-height: 800px;">
    <div class="head-left" style="margin-bottom: 15px;">
        <span class="logo"><?php echo($sitename); ?></span>
        <div class="slogan">Le spécialiste de l'assurance auto depuis 20 ans !</div>
    </div>


    <div class="right">
        <h1><b><?= htmlspecialchars($user['prenom'], ENT_NOQUOTES) ?> <?= htmlspecialchars($user['nom'], ENT_NOQUOTES) ?>
        : </b><br> <p>mon espace personnel</p></h1>
        <ul>
           <div class="bc1"></div>
           <div onclick="window.location.href = './logout.php'" class="bc2">Se déconnecter</div>
           <div class="bc3"></div>
        </ul>
    </div>
</header>

<section id="one">
    <div class="messagerie">
        <span class="title">Messagerie</span>

        <div class="contain" style="overflow-y: scroll;">
            <div class="msg">
                <u><b>Assistant <?php echo($sitename); ?> :</b></u><br>
                <p>N'hésitez pas à me contacter en cas de problèmes, je suis à votre service !</p>
            </div>

            <div class="answer">
                <u><b>Moi :</b></u>
                <p>Merci à vous pour votre disponibilité.</p>
            </div>
        </div>
        <form action="#">
            <input type="text" placeholder="Votre message" required>
            <input type="submit" value="Envoyer">
        </form>
    </div>

    
    <div class="contrats">
        <span class="title">Mes contrats</span>
        <div style="padding: 10px; display: flex; flex-wrap: wrap; justify-content: center; flex-direction: column; align-content: stretch;">
            
            <div style="margin-top: 10px; margin-bottom: 10px; background-color: grey; width: 90%; height: 50px; border-radius: 10px; "></div>
            <div style="margin-top: 10px; margin-bottom: 10px; background-color: grey; width: 90%; height: 50px; border-radius: 10px; "></div>
            <div style="margin-top: 10px; margin-bottom: 10px; background-color: grey; width: 90%; height: 50px; border-radius: 10px; "></div>
        </div>
    </div>
</section>

<section id="two">
    <div class="sinistre">
        <span class="title" style="background-color: #1E1E1E; color: #FFF; border-top: 2px solid #eee;">Déclarer un sinistre</span>
    
        <form action="#" method="post">
            <div style="text-align: left; display: inline-block; width: 45%;">
                <label for="immac">N° d'immatriculation</label>
                <input type="text" id="immac" name="immac" required>
             </div>

            <div style="text-align: left; display: inline-block; width: 45%;">
                <label for="select">Type de sinistre</label>

                <select name="type" id="select">
                    <option value="dog">Accident / Collision</option>
                    <option value="cat">Bris de glace</option>
                    <option value="hamster">Vol</option>
                    <option value="parrot">Incendie</option>
                </select>
            </div>

            
            <div style="margin-top: 10px; text-align: left; display: inline-block; width: 90%;">
                <label for="about">Décrivez le sinistre en détails</label>
                <textarea name="details" id="" cols="30" rows="10" required></textarea>
            </div>

            
                <p class="file">
                    <input class="input-file" id="my-file" type="file" multiple required>

                <div style="display: inline-block; width: 45%;">
                    <label for="my-file" class="input-file-trigger">Transférer mes documents</label>
                    <p class="file-return"></p>
                </p>
            </div>
            <div style="display: inline-block; width: 45%;">
                <input type="submit" value="Déclarer mon sinistre">
            </div>

        </form>

    </div>


    <div class="picture">
        <span class="title" style="background-color: #1E1E1E; color: #FFF; border-top: 2px solid #eee;"></span>
        <div class="picture_accident" style="text-align: center;">
            <div style="height: 100%; letter-spacing: 1px; padding: 10px; color: #FFF; text-shadow: 2px 2px 4px #1E1E1E; background-color: rgba(0, 0, 0, 0.366)">
            <p><b>Décrire le siniste en détails : </b>
                <br> Préciser les éléments suivants : lieu, date et heure du sinistre, circonstances, dégâts occasionnés, éventuelles difficultés rencontrées lors de la rédaction du constat amiable avec un tiers (autre conducteur, piéton, témoin, etc.), lieu où se trouve le véhicule pour le passage de l’expert.</p>
                <br>
                <p><b>Les documents à nous transmettre : </b><br>
                    En cas d'accident : Le volet du constat amiable d’accident automobile.<br>
                    Des photos des véhicules impliqués et du lieu de l’accident pour appuyer vos déclarations. <br>
                    En cas de vol, une copie du dépôt de plainte faite au commissariat de police ou à la gendarmerie.
                </p>
            </div>
        </div>
    </div>
</section>

<section id="three">
    <div class="my-sinistre">
        <span style="border-bottom: 2px solid #1E1E1E; background-color: #1E1E1E; color: #FFF; border-top: 2px solid #eee;" class="title">Mes sinistres</span>
        
        <div style="display: flex;">
          <div class="bonus">BONUS : <b><?= htmlspecialchars($user['bonus'], ENT_NOQUOTES) ?>%</b></div>
          <div class="malus">MALUS : <b><?= htmlspecialchars($user['malus'], ENT_NOQUOTES) ?>%</b></div>
        </div>

        <div style="margin-top: 10px; margin-bottom: 10px; background-color: grey; width: 90%; height: 50px; border-radius: 10px; "></div>
        <div style="margin-top: 10px; margin-bottom: 10px; background-color: grey; width: 90%; height: 50px; border-radius: 10px; "></div>
        <div style="margin-top: 10px; margin-bottom: 10px; background-color: grey; width: 90%; height: 50px; border-radius: 10px; "></div>
    </div>

    <div class="profil">
        <span class="title" style="border-bottom: 2px solid #eee; background-color: #FFF; color: #1E1E1E;">Mes coordonnées</span>
        
        <form action="#" method="post">

            <div style="text-align: left; display: inline-block; width: 50%;">
                <label for="adresse">Adresse</label><br>
                <input type="text" style="width: 90%;" id="adresse" name="adresse" value="9 Rue Philibert Delorme" required>
             </div>

            <div style="text-align: left; display: inline-block; width: 45%;">
                <label for="telephone">N° de téléphone</label><br>
                <input type="tel" id="telephone" name="tel" value="<?= htmlspecialchars($user['tel'], ENT_NOQUOTES) ?>" required>
            </div>

            
            <div style="margin-top: 10px; text-align: left; display: inline-block; width: 25%;">
                <label for="first-name">Nom</label><br>
                <input type="text" id="first-name" value="<?= htmlspecialchars($user['nom'], ENT_NOQUOTES) ?>" disabled>
            </div>

            <div style="margin-top: 10px; text-align: left; display: inline-block; width: 25%;">
                <label for="last-name">Prénom</label><br>
                <input type="text" id="last-name" value="<?= htmlspecialchars($user['prenom'], ENT_NOQUOTES) ?>" disabled>
            </div>

            <div style="margin-top: 10px; text-align: left; display: inline-block; width: 45%;">
                <input type="submit" value="Modifier">
            </div>
        </form>
    </div>
</section>

<?php require('./head/footer.php') ?>
    
</body>
</html>