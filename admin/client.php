<?php 
require '../settings/config.php';

session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../login.php');
    exit;
}

$stmt = $bdd->prepare('SELECT * FROM clients WHERE id = :id');
$stmt->bindParam('id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch();

if($user['rang'] < 1) {
    header('Location: ../home.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Administration - <?php echo($sitename); ?></title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>
    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<?php include('header.php'); ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Éditer le profil du client</h4>
                            </div>
                            <div class="content">
                            <?php 
                             $ste = $bdd->prepare('SELECT * FROM clients WHERE numClient = '.$_GET['numClient'].'');
                             $ste->execute();
                             $eUser = $ste->fetch();

                             if ('POST' == $_SERVER['REQUEST_METHOD']) {
                                $tel_length = mb_strlen($_POST['tel']);
                                if ($tel_length < 10 || $tel_length > 10) {
                                    echo"erreur";
                                } else if(!preg_match("#[0][6-7][- \.?]?([0-9][0-9][- \.?]?){4}$#", $_POST['tel'])) {
                                    echo"erreur";
                                } else {
                        
                                $insert = $bdd->prepare('UPDATE clients SET email = :email, nom = :nom, prenom = :prenom, adresse = :adresse, tel = :tel, bonus = :bonus, malus = :malus, numClient = :numClient WHERE numClient = '.$_GET['numClient'].'');
                                $insert->execute([
                                    'email' => $_POST['email'],
                                    'nom' => $_POST['nom'],
                                    'prenom' => $_POST['prenom'],
                                    'adresse' => $_POST['adresse'],
                                    'tel' => $_POST['tel'],
                                    'bonus' => $_POST['bonus'],
                                    'malus' => $_POST['malus'],
                                    'numClient' => $_POST['numClient'],
                                ]);
                            }} else {
                               //echo"erreur";
                            }
                            ?>
                                <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Adresse email</label>
                                                <input type="email" name="email" class="form-control" placeholder="Adresse email" value="<?php echo $eUser['email']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nom</label>
                                                <input type="text" name="nom" class="form-control" placeholder="Nom" value="<?php echo $eUser['nom']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Prénom</label>
                                                <input type="text" name="prenom" class="form-control" placeholder="Prénom" value="<?php echo $eUser['prenom']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Adresse</label>
                                                <input type="text" name="adresse" class="form-control" placeholder="Adresse" value="<?php echo $eUser['adresse']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Téléphone</label>
                                                <input type="text" name="tel" class="form-control" placeholder="Téléphone" value="<?php echo $eUser['tel']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Adresse IP</label>
                                                <input type="text" class="form-control" disabled placeholder="IP" value="<?php echo $eUser['ip']; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Bonus (%)</label>
                                                <input type="text" name="bonus" class="form-control" placeholder="Bonus" value="<?php echo $eUser['bonus']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Malus (%)</label>
                                                <input type="text" name="malus" class="form-control" placeholder="Malus" value="<?php echo $eUser['malus']; ?>">
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>N° client</label>
                                                <input type="text" name="numClient" class="form-control" placeholder="N° client" value="<?php echo $eUser['numClient']; ?>">
                                            </div>
                                    </div>
                                    </div>
    

                                    <button type="submit" class="btn btn-info btn-fill pull-right">Modifier le profil</button>
                                    <div class="clearfix"></div>
                                </form>
                                <a href=""><button class="btn btn-info btn-fill push-left">Actualiser</button></a>
                                <a href="dashboard.php"><button class="btn btn-info btn-fill push-left">Retour</button></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>

</html>
