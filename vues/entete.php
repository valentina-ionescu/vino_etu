<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Un petit verre de vino</title>

		<meta charset="utf-8">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, minimum-scale=0.5, initial-scale=1.0, user-scalable=yes">


		<meta name="description" content="Un petit verre de vino">

		<meta name="author" content="DFV">

		<!-- Iconnes importees  -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<!-- Styles CSS  -->
		<link rel="stylesheet" href="css/normalize.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/base_h5bp.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/utilitaires.css" type="text/css" media="screen">
		<link rel="stylesheet" href="./css/forms.css">
		<link rel="stylesheet" href="css/main.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/header.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/footer.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/tables.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/profile.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/admin.css" type="text/css" media="screen">


		<link rel="shortcut icon" type="image/png" href="./assets/img/logo/logo-verre-white-circle.png">

		<link rel="stylesheet" href="./css/grilles.css" type="text/css" media="screen">
		<!-- <link rel="stylesheet" href="./css/utilitaires.css">
		<link rel="stylesheet" href="./css/utilitaires.css" type="text/css" media="screen"> -->


		<!-- Iconnes importees  -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

		<base href="<?php echo BASEURL; ?>">
		<!--<script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
		<!-- <script src="./js/plugins.js"></script> -->
		<script src="./js/main.js"></script>
	</head>
	<body class="relative" >
		<header class="header__wrapper">
			<nav class="nav__wrapper flex" role="navigation">
				<div id="menuToggle">
					<input type="checkbox" />
					<span></span>
					<span></span>
					<span></span>
					<ul class="header__menu__links" id="menu">
							<?php if (isset($_SESSION['nom'])) { ?>
							<li><a href="?requete=accueil">Mon cellier</a></li>
							<li><a href="?requete=ajouterNouvelleBouteilleCellier">Ajouter une bouteille au cellier</a></li>
							<li><a href="?requete=profile">Gérer mes celliers</a></li>
							
							<?php
								if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1){
							?>
							<!-- <li><a href="?requete=updateSAQ">Importation du SAQ</a></li> -->
							<li><a href="?requete=admin">Admin - tableau de bord </a></li>

							<?php
								}
							?>
					<?php }else { ?>
						<li><a href="?requete=profile">Se connecter</a></li>
					<?php } ?>
						</ul>
				</div>
				<a href="?requete=accueil" class="flex"><img class="header__logo" src="assets/img/logo/logo.svg" alt=""></a>
				<?php if (isset($_SESSION['nom'])) { ?>
				<a class="u__profile_img flex col">
					<!-- <i class="fa fa-user-circle header__icon__user"></i> -->
					<div class="u__img">
						<img src="https://source.unsplash.com/featured/?profile" alt="">
					</div>
				<!-- <span class="petit"><?php echo $_SESSION['nom'];?></span> -->
				<span class="petit"><?php echo $_SESSION['initiales'];?></span>

				<div class="u__profile-toggle flex col">
					<div class="u__user">Bienvenue, <?php echo ucfirst($_SESSION['prenom']);?> <?php echo ucfirst($_SESSION['nom']);?></div>
					<a class="u__user-p" href="">Mon profile</a>
					<a class="u__user-s" href=""><i class="fas fa-cog"></i>Paramètres</a>
					<form  method="POST" action="index.php?requete=profileConnexion">
					<button  name="status" value="deconnexion">Déconnexion</button>
                    </form>
				</div>
				<?php 
				}?>
			    </a>
			</nav>
		</header>
		<main >	
