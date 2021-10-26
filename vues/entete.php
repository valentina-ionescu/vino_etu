<?php
    /*Just for your server-side code*/
	//  header('Content-Type: text/html; charset=ISO-8859-1');
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Un petit verre de vino</title>

		<meta charset="utf-8">
		<meta http-equiv="cache-control" content="no-cache">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
		<meta name="viewport" content="width=device-width, minimum-scale=0.5, initial-scale=1.0, user-scalable=yes">


		<meta name="description" content="Un petit verre de vino">

		<meta name="author" content="DFV">
		<!-- Iconnes importees  -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<link rel="stylesheet" href="css/normalize.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/base_h5bp.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/utilitaires.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/main.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/header.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/footer.css" type="text/css" media="screen">


		<link rel="shortcut icon" type="image/png" href="./img/logo-verre-white-circle.png">

		<link rel="stylesheet" href="./css/grilles.css" type="text/css" media="screen">



		<!-- Iconnes importees  -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

		<base href="<?php echo BASEURL; ?>">
		<!--<script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
		<!-- <script src="./js/plugins.js"></script> -->
		<script src="./js/main.js"></script>
	</head>
	<body >
		<header class="header__wrapper">
			<nav class="nav__wrapper flex" role="navigation">
				<div id="menuToggle">
					<input type="checkbox" />
					<span></span>
					<span></span>
					<span></span>
					<ul class="header__menu__links" id="menu">
						<li><a href="?requete=accueil">Mon cellier</a></li>
						<li><a href="?requete=ajouterNouvelleBouteilleCellier">Ajouter une bouteille au cellier</a></li>
						<li><a href="./updateSAQ.php">Importation du SAQ</a></li>
					</ul>
				</div>
				<img class="header__logo" src="assets/img/logo.svg" alt="">
				<i class="fa fa-user-circle header__icon__user"></i>
			</nav>
		</header>
		<main>
