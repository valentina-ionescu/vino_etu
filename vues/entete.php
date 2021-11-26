<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Un petit verre de vino</title>

	<meta charset="utf-8">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, minimum-scale=0.5, initial-scale=1.0, user-scalable=yes">


	<meta name="description" content="Un petit verre de vino">

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
		<link rel="stylesheet" href="css/infoUser.css" type="text/css" media="screen">
		<link rel="stylesheet" href="css/pageLoader.css" type="text/css" media="screen">


		<link rel="shortcut icon" type="image/png" href="./assets/img/logo/logo-verre-white-circle.png">

		<link rel="stylesheet" href="./css/grilles.css" type="text/css" media="screen">
		


		<!-- Iconnes importees  -->
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">

		<base href="<?php echo BASEURL; ?>">
		<script src="./js/main.js"></script>
		<script src="./js/ripple.js"></script>
		<script src="./js/tricelliers.js"></script>
		<script src="./js/filtresBouteilles.js"></script>
		<script src="./js/recherche.js"></script>
		
	</head>
	<body class="relative" >

	<div class="loader ">
		<ul>
			<li></li>
			<li></li>
			<li></li>
		</ul>
		<div>
			<div class="wineglass left">
				<div class="top"></div>
			</div>
			<div class="wineglass right">
				<div class="top"></div>
			</div>
		</div>
	</div>


	<header class="header__wrapper">
		<nav class="nav__wrapper flex" role="navigation">
			<div id="menuToggle">
				<input type="checkbox" />
				<span></span>
				<span></span>
				<span></span>
				<ul class="header__menu__links" id="menu">
					<?php if (isset($_SESSION['nom'])) { ?>
						<li><a href="?requete=home">Accueil</a></li>
						<li><a href="?requete=profile">Gérer mes celliers</a></li>
						<li><a href="?requete=paramUsager">Mon profile</a></li>

						<?php
						if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1) {
						?>

							<li><a href="?requete=getCatalogue">Admin - tableau de bord </a></li>
						<?php
						}
						?>
					<?php } else { ?>
						<li><a href="?requete=profile">Se connecter</a></li>
					<?php } ?>
				</ul>
			</div>
			<a href="?requete=home" class="flex link_logo1"><img class="header__logo" src="assets/img/logo/logo.svg" alt=""></a>
			<a href="?requete=home" class="flex link_logo2"><img class="header__logo2" src="assets/img/logo/logo_blanc.svg" alt=""></a>

			<?php if (isset($_SESSION['nom'])) { ?>
				<div class="u__profile_img flex col">

					<div class="u__img">
						<img src="img/abstract-user.svg" style="color:var(--bg-primaire);" alt="">

					</div>

					<!-- <span class="petit"><?php echo $_SESSION['initiales']; ?></span> -->

					<div class="u__profile-toggle  col">
						<div class="u__user">Bienvenue, <?php echo ucfirst($_SESSION['prenom']); ?> <?php echo ucfirst($_SESSION['nom']); ?></div>
						<a class="u__user-p" href="?requete=paramUsager"><i class="far fa-user-circle"></i>Mon profile</a>
						<form method="POST" action="index.php?requete=profileConnexion">
							<button name="status" value="deconnexion">Déconnexion</button>
						</form>
					</div>
				<?php
			} ?>
			
				<span class="petit"><?php //echo $_SESSION['initiales'];?></span>

				<div class="u__profile-toggle  col">
					<div class="u__user">Bienvenue, <?php echo ucfirst($_SESSION['prenom']);?> <?php echo ucfirst($_SESSION['nom']);?></div>
					<a class="u__user-p" href="?requete=paramUsager"><i class="far fa-user-circle"></i>Mon profile</a>
					<form  method="POST" action="index.php?requete=profileConnexion">
					<button  name="status" value="deconnexion">Déconnexion</button>
                    </form>
				</div>
		</nav>
	</header>
	<main>