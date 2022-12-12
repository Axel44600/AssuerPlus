<div class="wrapper">
    <div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="#" class="simple-text">
                <?php echo($sitename); ?>
                </a>
            </div>

            <ul class="nav">
                <li id="tb" class="active">
                    <a href="dashboard.php">
                        <i class="pe-7s-graph"></i>
                        <p>Tableau de bord</p>
                    </a>
                </li>
        
                <li id="si">
                    <a href="sinistre.php">
                        <i class="pe-7s-note2"></i>
                        <p>Sinistres</p>
                    </a>
                </li>

                <li id="ga">
                    <a href="garage.php">
                        <i class="pe-7s-news-paper"></i>
                        <p>Garages partenaires</p>
                    </a>
                </li>
               
				<li class="active-pro">
                    <a href="../home.php">
                        <i class="pe-7s-rocket"></i>
                        <p>Retourner sur le site</p>
                    </a>
                </li>
            </ul>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <div class="collapse navbar-collapse">
            
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="../logout.php">
                                <p>Déconnexion</p>
                            </a>
                        </li>
						<li class="separator hidden-lg"></li>
                    </ul>
                </div>
            </div>
        </nav>