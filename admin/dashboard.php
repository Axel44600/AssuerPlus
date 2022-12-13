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

$stl = $bdd->prepare('SELECT * FROM clients');
$stl->execute();
$lUser = $stl->fetchAll(PDO::FETCH_ASSOC);

$select = $bdd->prepare("SELECT COUNT(*) AS nb FROM clients");
$select->execute();
$s = $select->fetch(PDO::FETCH_OBJ);

if ($_GET !== null) {
    $std = $bdd->prepare('DELETE FROM clients WHERE numClient = :delete');
    $std->bindParam('delete', $_GET['delete'], PDO::PARAM_INT);
    $std->execute();
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
                <div class="row"></div>
                
                    <div class="col-md-6">
                        <div class="card ">
                            <div class="header">
                                <h4 class="title">Liste des clients</h4>
                                <p class="category">Total : <?php  echo $s->nb; ?> client(s)</p>
                            </div>
                            <div class="content">
                                <div class="table-full-width">
                                    <table class="table">
                                        <tbody>
                                            <?php foreach ($lUser as $l){ ?>

                                            <tr>
                                                <td>
													<div class="checkbox">
						  							  	<input id="checkbox1" type="checkbox">
						  							  	<label for="checkbox1"></label>
					  						  		</div>
                                                </td>
                                                <td><u>N°<?php echo $l['numClient']; ?> --></u>  Nom: <b><?php echo $l['nom']; ?></b> | Prénom: <b><?php echo $l['prenom']; ?></b> | <a href="contact.php?msg=<?php echo $l['numClient']; ?>">Contacter</a></td>
                                                <td class="td-actions text-right">
                                                    <button type="button" rel="tooltip" href="" title="Éditer" class="btn btn-info btn-simple btn-xs">
                                                        <a href="client.php?numClient=<?php echo $l['numClient']; ?>"><i class="fa fa-edit"></i></a>
                                                    </button>
                                                    <button type="button" rel="tooltip" title="Supprimer" class="btn btn-danger btn-simple btn-xs">
                                                        <a href="?delete=<?php echo $l['numClient']; ?>"><i class="fa fa-times"></i></a>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php } ?>




                                        </tbody>
                                    </table>
                                </div>

                                <div class="footer">
                                    <hr>
                                    <div class="stats">
                                        <i class="fa fa-history"></i> Mis à jour il y a 3 minutes
                                    </div>
                                    <a href=""><button class="btn btn-info btn-fill push-right">Actualiser</button></a>
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

	<script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: "Bonjour <b>ADMIN</b>, bienvenue sur l'administration !",

            },{
                type: 'info',
                timer: 4000
            });

    	});
	</script>

</html>
