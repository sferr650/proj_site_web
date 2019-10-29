<?php

$connec=0;
session_start();

/*Vérification de l'ouverture de session*/
if(isset($_SESSION['open'])) {
	$connec =1;
	$nom = $_SESSION['nom'];
	$prenom = $_SESSION['prenom'];
}
					
else{
	$connec=0;
}
if( isset($_GET['DECO'])){
	echo 'coucou';
	session_destroy();
}
					
?>

<html>

	<head>
		<title> ens rennes </title>
		<meta charset= 'utf-8'> 
		<link  rel="stylesheet" href="acceuil_css.css"/>
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:bold' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
	</head>
	
	<body id = "bodyacceuil">
		
		<header>
				<div id="bandeau_du_haut">
					<ul id="connexion_inscription">
						<?php 
							if($connec == 0){?>
							<li><a class = "texte_bandeau" href="connexion.php" name="deco">Connexion</a></li>
							<li><a class = "texte_bandeau" href="inscription.php">Inscription</a></li>
						<?php 
							}
							else {
						?>
							<li class = "texte_bandeau" name="deco1">Hello <span class = 'nom_session'> <?=$_SESSION['nom']?></span></li> 
							<li><a class = "texte_bandeau" href="connexion.php">Déconnexion</a></li>
							<?php }?>
					</ul>
				</div>
				
				<div id="bandeau_du_bas">
						<a href="acceuil.html"><img class ="logo" src ="ENS_logo.png" alt ="logo header"/></a>
					<nav id = "menu" >
						<ul>
							<li><a class = "texte_bandeau" href="acceuil.php">Acceuil</a></li>
							<li><a class = "texte_bandeau" href="ancieneleves.php">Anciens élèves</a></li>
						</ul>
					</nav>
				</div>
			</header>
		
		<div id="imagebackground">
			 <p>Bienvenue sur le site des anciens élèves de l'ENS Rennes</p>
		</div>
		
		<footer id="footer">
			<p> pied de page </p>	
		</footer>
		
	</body>
</html>