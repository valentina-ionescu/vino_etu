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
	<script src="./js/admin.js"></script>
</head>

<body class="relative admin_body">

	<!-- (B) NOW LOADING SPINNER -->
	<div id="page-loader">
		<img id="page-loader-spin" src="public/cube-loader.svg">
	</div>


	<!-- (C) SIDE BAR -->
	<nav id="page-sidebar" class="tabs">
		<a href="#">
			<span class="ico">&#9880;</span> Add Modules Here
		</a>
	</nav>


	<!-- (D) MAIN CONTENTS -->
	<div id="page-main">

		<!-- (D1) NAVIGATION BAR -->
		<nav id="page-nav">
			<div id="page-button-side" onclick="adm.side();">&#9776;</div>
			<div id="page-button-out" onclick="adm.bye();">&#9747;</div>
		</nav>


		<!-- (D2) PAGE CONTENTS -->
		<main id="page-contents" class="admin_main">