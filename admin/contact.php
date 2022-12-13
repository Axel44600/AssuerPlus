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

if (isset($_GET['delete'])) {
    if($_GET['delete'] !== ''){
        $std = $bdd->prepare('DELETE FROM messagerie WHERE id = :delete');
        $std->bindParam('delete', $_GET['delete'], PDO::PARAM_INT);
        $std->execute();
    }
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
                <div class="card">
                    <div class="header">
                        <h4 class="title">Messagerie</h4>
                    </div>

<?php
    $stc = $bdd->prepare('SELECT * FROM messagerie WHERE numClient = :msg OR numClient = 0');
    $stc->bindParam('msg', $_GET['msg'], PDO::PARAM_INT);
    $stc->execute();
    $message = $stc->fetchAll(PDO::FETCH_ASSOC);
?>
                    
                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                        <?php  if(empty($message)){} else { foreach ($message as $m){ 
                                if($m['numClient'] == 0) {
                        ?>
                                <div class="alert alert-info">
                                    <a href="?delete=<?php echo $m['id']; ?>"><button type="button" aria-hidden="true" class="close">×</button></a>
                                    <span><b> <?php echo htmlspecialchars($m['nom']); ?> - </b> <?php echo htmlspecialchars($m['msg']); ?></span>
                                </div>
                        <?php } else { ?>
                                <div class="alert alert-warning">
                                <a href="?delete=<?php echo $m['id']; ?>"><button type="button" aria-hidden="true" class="close">×</button></a>
                                    <span><b> <?php echo $m['nom']; ?> <?php echo htmlspecialchars($m['prenom']); ?> - </b> <?php echo htmlspecialchars($m['msg']); ?></span>
                                </div>
                        <?php }}} ?>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="places-buttons">
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 text-center">
                                    <hr>
                                </div>
                            </div>
                            <div class="row">
                        <?php
                         if ('POST' == $_SERVER['REQUEST_METHOD']) {
                            $insert = $bdd->prepare('INSERT INTO messagerie(numClient, nom, prenom, dateMsg, msg, destinataire) 
                            VALUES(:numClient, :nom, :prenom, NOW(), :msg, :destinataire)');
                            $insert->execute([
                                'numClient' => 0,
                                'nom' => 'ADMIN',
                                'prenom' => '',
                                'msg' => $_POST['msg'],
                                'destinataire' => $_GET['msg'],
                            ]);
                        } else {
                        }
                        ?>
                                <form action="" method="post">

                                <div class="col-md-6">
                                    <div class="form-group">
                                            <input type="text" name="msg" class="form-control" placeholder="Votre message" required>
                                    </div>
                                </div>
                                    
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-default btn-block">Envoyer le message</button>
                                    </div>   
                                </div> 

                                </form>
                                <div class="col-md-2">
                                    <div class="form-group">
                                    <a href="javascript:window.history.go(-1)"><button class="btn btn-info btn-fill push-left">Actualiser</button></a>
                                    </div>   
                                </div> 
                               
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
