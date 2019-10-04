<!DOCTYPE html>
<html>

	<head>
		<title> ens rennes </title>
		<meta charset= 'utf-8'> 
		<link  rel="stylesheet" href="acceuil_css.css"/>
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:bold' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
	</head>

	<body id="bodyancieneleves">
	
		<header id="header">
		
			<div id="conteneur">
			
				<div id="boxelogo">
					<a href = "acceuil.html"> <img class='logoens' src ='ENS_logo.png' alt ='logo header'/> </a>
				</div>
		
				<div id="menutool">
					<div id='menu'>
						<div><a href ="acceuil.html">Acceuil</a></div>
						<div><a href ="ancieneleves.php">Anciens élèves</a></div>
						<div><a href ="departements.html">Évènements</a></div>
						<div><a href ="annonce.html">Annonces</a></div>
					</div>
				</div>
				
				<div id="connexion">
					<a href = "connexion.html"> Connexion </a>
				</div>
				
			</div>
		
		</header>


		<nav id="navpromotion"> 
		<?php
			/* mon premier script, au menu :
			- première chaîne de caractères
			- date et heure du jour
			*/
			echo 'Texte généré par PHP. 1er script'; // chaîne à écrire via PHP
			echo '<br />Date du jour = <font color="red"><strong>'.date("d/m/y - H:i:s").'</strong></font>';
		?>
		</nav>


		<footer id="footer">
			<p> pied de page </p>	
	</footer>
	
	</body>

</html>