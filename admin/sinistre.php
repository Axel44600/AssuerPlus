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
    <script>
        function className() {
            document.getElementById('tb').className = ""; 
            document.getElementById('ga').className = ""; 
            document.getElementById('si').className = "active"; 
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
                                <h4 class="title">Les sinistres #1</h4>
                                <p class="category">Accident / Collision</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>N° Client</th>
                                    	<th>Immatriculation</th>
                                    	<th>Date</th>
                                    	<th>Details</th>
                                        <th>Documents</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sts1 = $bdd->prepare('SELECT * FROM sinistre WHERE typeSinistre = "Accident / Collision"');
                                            $sts1->execute();
                                            $lSin = $sts1->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($lSin as $s){
                                        ?>
                                        <tr>
                                        	<td><?php echo ($s['id']); ?></td>
                                        	<td><?php echo ($s['numClient']); ?></td>
                                        	<td><?php echo ($s['immatriculation']); ?></td>
                                        	<td><?php echo ($s['dateSinistre']); ?></td>
                                        	<td><?php echo ($s['details']); ?></td>
                                            <td>
                                                <?php 
                                                if($s['documents'] > 1){
                                                    for($i = 0; $i < $s['documents']; $i++) { ?>
                                                <a target="_blank" href="../uploads/<?php echo ($s['numClient']); ?>_<?php echo ($s['immatriculation']); ?>_<?php echo ($s['dateSinistre']); ?>_DOC_<?php echo ($i); ?>.pdf">Document <?php echo ($i); ?> | </a>
                                                <?php }} ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Les sinistres #2</h4>
                                <p class="category">Bris de glace</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>N° Client</th>
                                    	<th>Immatriculation</th>
                                    	<th>Date</th>
                                    	<th>Details</th>
                                        <th>Documents</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sts2 = $bdd->prepare('SELECT * FROM sinistre WHERE typeSinistre = "Bris de glace"');
                                            $sts2->execute();
                                            $lSin = $sts2->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($lSin as $s){
                                        ?>
                                        <tr>
                                        	<td><?php echo ($s['id']); ?></td>
                                        	<td><?php echo ($s['numClient']); ?></td>
                                        	<td><?php echo ($s['immatriculation']); ?></td>
                                        	<td><?php echo ($s['dateSinistre']); ?></td>
                                        	<td><?php echo ($s['details']); ?></td>
                                            <td>
                                                <?php 
                                                if($s['documents'] > 1){
                                                    for($i = 0; $i < $s['documents']; $i++) { ?>
                                                <a target="_blank" href="../uploads/<?php echo ($s['numClient']); ?>_<?php echo ($s['immatriculation']); ?>_<?php echo ($s['dateSinistre']); ?>_DOC_<?php echo ($i); ?>.pdf">Document <?php echo ($i); ?> |</a>
                                                <?php }} ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Les sinistres #3</h4>
                                <p class="category">Vol</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>N° Client</th>
                                    	<th>Immatriculation</th>
                                    	<th>Date</th>
                                    	<th>Details</th>
                                        <th>Documents</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sts3 = $bdd->prepare('SELECT * FROM sinistre WHERE typeSinistre = "Vol"');
                                            $sts3->execute();
                                            $lSin = $sts3->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($lSin as $s){
                                        ?>
                                        <tr>
                                        	<td><?php echo ($s['id']); ?></td>
                                        	<td><?php echo ($s['numClient']); ?></td>
                                        	<td><?php echo ($s['immatriculation']); ?></td>
                                        	<td><?php echo ($s['dateSinistre']); ?></td>
                                        	<td><?php echo ($s['details']); ?></td>
                                            <td>
                                                <?php 
                                                if($s['documents'] > 1){
                                                    for($i = 0; $i < $s['documents']; $i++) { ?>
                                                <a target="_blank" href="../uploads/<?php echo ($s['numClient']); ?>_<?php echo ($s['immatriculation']); ?>_<?php echo ($s['dateSinistre']); ?>_DOC_<?php echo ($i); ?>.pdf">Document <?php echo ($i); ?> |</a>
                                                <?php }} ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Les sinistres #4</h4>
                                <p class="category">Incendie</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>ID</th>
                                    	<th>N° Client</th>
                                    	<th>Immatriculation</th>
                                    	<th>Date</th>
                                    	<th>Details</th>
                                        <th>Documents</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sts4 = $bdd->prepare('SELECT * FROM sinistre WHERE typeSinistre = "Incendie"');
                                            $sts4->execute();
                                            $lSin = $sts4->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($lSin as $s){
                                        ?>
                                        <tr>
                                        	<td><?php echo ($s['id']); ?></td>
                                        	<td><?php echo ($s['numClient']); ?></td>
                                        	<td><?php echo ($s['immatriculation']); ?></td>
                                        	<td><?php echo ($s['dateSinistre']); ?></td>
                                        	<td><?php echo ($s['details']); ?></td>
                                            <td>
                                                <?php 
                                                if($s['documents'] > 1){
                                                    for($i = 0; $i < $s['documents']; $i++) { ?>
                                                <a target="_blank" href="../uploads/<?php echo ($s['numClient']); ?>_<?php echo ($s['immatriculation']); ?>_<?php echo ($s['dateSinistre']); ?>_DOC_<?php echo ($i); ?>.pdf">Document <?php echo ($i); ?> |</a>
                                                <?php }} ?>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                       
                                    </tbody>
                                </table>

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
