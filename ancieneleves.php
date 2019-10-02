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
	
		<header>
				<div id="bandeau_du_haut">
					<ul id="connexion_inscription">
						<li><a class = "texte_bandeau" href="#">Connexion</a></li>
						<li><a class = "texte_bandeau" href="#">Inscription</a></li>
					</ul>
				</div>
				
				<div id="bandeau_du_bas">
						<a href="acceuil.html"><img class ="logo" src ="ENS_logo.png" alt ="logo header"/></a>
					<nav id = "menu" >
						<ul>
							<li><a class = "texte_bandeau" href="acceuil.html">Acceuil</a></li>
							<li><a class = "texte_bandeau" href="ancieneleves.php">Anciens élèves</a></li>
						</ul>
					</nav>
				</div>

			</header>


		<div id="navpromotion"> 
			<div class="boutonpromotion">Promotion
				<span class="annee_promotion">
				<form action="ancieneleves.php" method="post">
					<select class="choix_annee_promotion" name='cap' onChange="this.form.submit();">
						<?php
						$cap=1900;
						for ($a = 1900; $a <= 2019; $a++){
							echo '<option value="'.$a.'">'.$a.'</option>';
							$cap = ceil($_POST['cap']);
							echo $cap ;
						}
						?>		 
					</select>
				
				</form>
				</span>
			</div>
			<div id="navpromotion-child">
				 <a><?php echo $cap-2; ?></a>
				 <a><?php echo $cap-1; ?></a>
				 <a><?php echo $cap; ?></a>
				 <a><?php echo $cap+1; ?></a>
				 <a><?php echo $cap+2; ?></a>
			</div>
		</div>
		
		<section id="tableau"> test test ettstststts 
			<?php 
				$bdd = new PDO('mysql:host=localhost;dbname=ancien_eleves;charset=utf8', 'root', '!jBEuKe8');
				$reponse = $bdd->query('Tapez votre requête SQL ici');
				$donnees = $reponse->fetch();
				echo $reponse;
			?>
		</section>


		<footer id="footer">
			<p> pied de page </p>	
	</footer>
	
	</body>

</html>