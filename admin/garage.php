<?php 
require '../back/settings/config.php';

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

$stg = $bdd->prepare('SELECT * FROM garage');
$stg->execute();
$lGarage = $stg->fetchAll(PDO::FETCH_ASSOC);
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
    <script>
        function className() {
            document.getElementById('tb').className = ""; 
            document.getElementById('ga').className = "active"; 
            document.getElementById('si').className = ""; 
        }
    </script>
</head>
<body onLoad="className()">

<?php include('header.php'); ?>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Nos garages partenaires</h4>
                            </div>
                        
                            <div class="content all-icons">
                                <div class="row">
                                  
                                  <div class="font-icon-list col-lg-2 col-md-3 col-sm-4 col-xs-6 col-xs-6">
                                  <?php foreach ($lGarage as $g){ ?>
                                    <div class="font-icon-detail"><i class="pe-7s-car"></i>
                                      <p><?php echo(htmlspecialchars($g['nom'])); ?></p>
                                      <small><?php echo(htmlspecialchars($g['adresse'])); ?></small><br>
                                      <small><?php echo(htmlspecialchars($g['tel'])); ?></small>
                                    </div>
                                    <?php } ?>
                                  </div>              
                                </div>
                            </div>
                       


                        </div>
                    </div>

                </div>
            </div>



            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                        <div class="header">
                          <h4 class="title">Ajouter un garage</h4>
                        </div>
                        <div class="content all-icons">
                <?php
                 if ('POST' == $_SERVER['REQUEST_METHOD']) {
                    $exploded_string = explode(' ', $_POST['adresse']); 

                    $insert = $bdd->prepare('INSERT INTO garage(nom, adresse, ville, tel) 
                    VALUES(:nom, :adresse, :ville, :tel)');
                    $insert->execute([
                        'nom' => $_POST['nom'],
                        'adresse' => $_POST['adresse'],
                        'ville' => array_pop($exploded_string),
                        'tel' => $_POST['tel'],
                    ]);
                 }
                ?>
                          <form action="" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Nom du garage</label>
                                                <input type="text" name="nom" class="form-control" placeholder="Nom du garage" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label>Adresse</label>
                                                <input type="text" name="adresse" class="form-control" placeholder="Adresse complète du garage" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>N° de téléphone</label>
                                                <input type="text" name="tel" class="form-control" placeholder="Numéro de téléphone du garage" minlength="10" maxlength="10" required>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Ajouter</button>
                                        </div>
                                </div>
                           </form>
                           <a href=""><button class="btn btn-info btn-fill push-left">Actualiser</button></a>
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
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>


</html>
