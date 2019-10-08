<!DOCTYPE html>
<?php


try{
	$bdd = new PDO('mysql:host=localhost;dbname=ancien_eleves;charset=utf8', 'root', '!jBEuKe8');
}
catch (Exception $e){
	die('Erreur : '.$e->getMessage());
}
session_start();

?>




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
						<li><a class = "texte_bandeau" href="connexion.php">Connexion</a></li>
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
			<div id="main_ancien_eleve">
				<aside id="navpromotion"> 
					<div class="boutonpromotion">
						<div id='titrepromo'>Promotion : </div>
						<div class="annee_promotion">
						<form action="ancieneleves.php" method="post">
							<select class="choix_annee_promotion" name='cap' onChange="this.form.submit();">
								<?php
								for ($a = 1950; $a <= 2019; $a++){
									echo '<option value="'.$a.'"selected="selected">'.$a.'</option>';
										if(isset($_POST['cap']))
										{
										$cap = ceil($_POST['cap']);
										}
									else {
										$cap=2019;
									}
								}
								?>		 
							</select>
						
						</form>
						</div>
					</div>
					<!--Pas fini-->
				
					<nav id="navpromotion-child">
						<?php
							$affichercap = $cap;
							 echo "<a href=''> ".$affichercap--." </a>";
							 echo "<a href=''> ".++$affichercap." </a>";
							 echo "<a href=''> ".++$affichercap." </a>";
							 echo "<a href=''> ".++$affichercap." </a>";
							 echo "<a href=''> ".$affichercap."   </a>"; ?>
					</nav>
				</aside>
		
				<div id="section_tableau">
					<?php
						$NbrCol = 5; // nombre de colonnes
						$entetetab = array('Nom','Prénom','Promotion','Mail','Cursus');
						
						$compt=0;
				
						$result = $bdd->query('SELECT * FROM ancien_eleve1 WHERE Promotion = '.$cap.'');
						
						$NbreData = $result->rowCount();
						$rowAll = $result->fetchAll();
						if($NbreData != 0){
					?>
					<table id="tableau">
						<thead>
							<tr>
								<?php
									for ($c=0; $c<$NbrCol; $c++) {
								?>
								<th><?php echo $entetetab[$c]; ?></th>
								<?php
									} 
								?>
							</tr>
						</thead>
						
						<tbody>
							<?php
								// pour chaque ligne (chaque enregistrement)
								foreach ( $rowAll as $row ) 
								{
									// DONNEES A AFFICHER dans chaque cellule de la ligne
							?>
									<tr>
										<td><?php echo $row['Nom']; ?></td>
										<td><?php echo $row['Prénom']; ?></td>
										<td><?php echo $row['Promotion']; ?></td>
										<td><?php echo $row['mail']; ?></td>
										<td><?php echo $row['cursus']; ?></td>
									</tr>
										<?php
								} // fin foreach
							?>
						</tbody>
					</table>
						<?php
						} else { ?>
							Aucune personne ne correspond à votre recherche, veuillez essayer avec une autre année.
						<?php
						}
						?>
						
						<?php 
						if(!$_SESSION) {
							$connec =0;

						} 							
						else {
							$connec=1;
						}
						
						;?>
						
					<div <?php if($connec == 0){echo 'style="display:none"';}?> id='modificationcursus'>
						<p>Bonjour, (nom à récupérer) de la promotion XXXX, voici votre cursus : 
							<?php echo 'requet sql'?>
						</p>
						<form action="ancieneleves.php" method="post" id="cursus_box_insert">
							<label> Promotion </label><br/>						
							<input type="text" name="année_promo" id="année_promo" /> 
							
							<input type="text" name="cursus" id="cursus" /> 
							
							<input type="submit" value="Ajouter" id="send_cursus" />
							<?php
								if(isset($_POST['année_promo'])){
									$name = "PT";
									$newPromo = $_POST['année_promo'];
									$result = $bdd->query("UPDATE ancien_eleve1 SET Promotion = ".$newPromo." WHERE Prénom= 'PT'");
								}
								if(isset($_POST['cursus'])){
									$name = "PT";
									$newCursus = $_POST['cursus'];
									$result = $bdd->query("UPDATE ancien_eleve1 SET cursus = ".$newCursus ." WHERE Prénom= 'PT'");
								}						
							?>
					</div>
				</div>
			</div>

		<footer id="footer">
			<p> pied de page </p>	
	</footer>
	
	</body>

</html>