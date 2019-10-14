<!DOCTYPE html>
<?php
/*Connection BDD*/
try{
	$bdd = new PDO('mysql:host=localhost;dbname=ancien_eleves;charset=utf8', 'root', '!jBEuKe8');
}
catch (Exception $e){
	die('Erreur : '.$e->getMessage());
}

session_start();
/*Vérification de l'ouverture de session*/
if(isset($_SESSION['open'])) {
	$connec =1;
} 							
else {
	$connec=1;
}
/*Récupération des variables de session*/
/*$nom = $_SESSION['nom'];
$prenom = $_SESSION['prenom'];
$cursust = $_SESSION['cursus'];
$promo = $_SESSION['promotion'];
$mail = $_SESSION['mail'];
*/
$nom="tes";
$prenom="test";
$cursust="méca tro";
$promo=2016;
$mail="pouet@ens.fr";

/*Gestion de la liste déroulante des années de promotion*/
$cap=2019;
if(isset($_GET['cap']))
{
	$cap = ceil($_GET['cap']);
}

/*Modification des valeurs cursus et Promo si l'utilisateur clique sur le bouton*/							
if(!empty($_POST['année_promo'])){
	
	$newPromo = htmlspecialchars($_POST['année_promo']);
	$mail="pouet@ens.fr";
	
	switch (!empty($_POST['cursus'])){
		case 0 :
			$sql = "UPDATE ancien_eleve1 SET Promotion = ".$newPromo." WHERE mail= '".$mail."'";
			$stmt = $bdd->prepare($sql);
			$stmt->execute();
			break;
		case 1 :
			$newCursus = htmlspecialchars($_POST['cursus']);
			$sql = "UPDATE ancien_eleve1 SET Promotion = ".$newPromo.",cursus = '".$newCursus."'  WHERE mail= '".$mail."'";
			$stmt = $bdd->prepare($sql);
			$stmt->execute();
			break;			
	}
}
else {
	switch (!empty($_POST['cursus'])){
		case 0 :
			break;
		case 1 :
			$newCursus = htmlspecialchars($_POST['cursus']);
			$sql = "UPDATE ancien_eleve1 SET cursus = '".$newCursus."' WHERE mail= '".$mail."'";
			$stmt = $bdd->prepare($sql);
			$stmt->execute();
			break;
	}
}

/*Suppression de la valeur cursus si l'utilisateur clique sur le bouton*/
if(isset($_POST['clic'])){
	$mail ="pouet@ens.fr";								
	$sql = "UPDATE ancien_eleve1 SET Cursus = NULL WHERE mail= '".$mail."'";
	$stmt = $bdd->prepare($sql);
	$stmt->execute();	
	echo "niquer";
}					
?>

<html>

	<head>
		<title>ens rennes</title>
		<meta charset= 'utf-8'> 
		<link rel="stylesheet" href="acceuil_css.css"/>
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
					<h4 id='titrepromo'>Promotion : </h4>
					<div class="annee_promotion">
						<form action="ancieneleves.php" method="get">
							<select class="choix_annee_promotion" name='cap' onChange="this.form.submit();">
								
								<?php
								for ($a = 1950; $a <= 2019; $a++)
								{?>
									<option value="<?=$a?>" <?php if($cap == $a){echo 'selected="selected"';}?>><?=$a?></option>;
								<?php	
								}
								?>	
								 
							</select>
						</form>
					</div>
				</div>
				<!--Pas fini-->
			
				<nav id="navpromotion-child">
					<a href='ancieneleves.php?cap=<?=$cap-2?>'><?=$cap-2?></a>
					<a href='ancieneleves.php?cap=<?=$cap-1?>'><?=$cap-1?></a>
					<a href='ancieneleves.php?cap=<?=$cap?>'><?=$cap?></a>
					<a href='ancieneleves.php?cap=<?=$cap+1?>'><?=$cap+1?></a>
					<a href='ancieneleves.php?cap=<?=$cap+2?>'><?=$cap+2?></a>
				</nav>
			</aside>
	
			<div id="section_tableau">
				<?php
					$NbrCol = 5; // nombre de colonnes
					$entetetab = array('Nom','Prénom','Promotion','Mail','Cursus');
					
					$compt=0;
					
					$sql = "SELECT * FROM ancien_eleve1 WHERE Promotion = ".$cap."";
					$result = $bdd->prepare($sql);
					$result->execute();
					
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
									<td><?=$row['Nom']?></td>
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
					
					
					?>
					
				<div <?php if($connec == 0){echo 'style="display:none"';}?> id='modificationcursus'>
					<p id="userText">Bonjour, <?=$prenom?> <?=$nom?> de la promotion <?=$promo?>, voici votre cursus :</p>
					<div id="deletCursus">
						<p id="userCursus"><?=$cursust?></p>
						<form action="ancieneleves.php" method="post" id="FDeletCursus">
							<input type="submit" name="clic" value="Supprimer" id="BDeletCursus"/>
						</form>	
					</div>
					
					<form action="ancieneleves.php" method="post" id="cursusBoxInsert">
						<div id="promo">
							<p id='titlepromo'> Promotion </p>
							<input type="text" name="année_promo" id="année_promo" />
						</div>
						
						<div id="cursus">
							<p id='titlecursus'> Cursus </p>						
							<input type="text" name="cursus" id="cursus" />
						</div>
						
						<input type="submit" value="Ajouter" id="sendMaj" />
						
					</form>
				</div>
			</div>
		</div>

		<footer id="footer">
			<p> pied de page </p>	
	</footer>
	
	</body>

</html>