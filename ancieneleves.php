<!DOCTYPE html>
<?php
/*Connection BDD*/
try{
	/*variable de bdd*/
	$localhostBdd = 'mysql:host=localhost;dbname=ens_eleves;charset=utf8';
	$rootAccount = 'root';
	$rootMdp = "!jBEuKe8";
	
	$bdd = new PDO($localhostBdd,$rootAccount, $rootMdp);
	
	
	/*colonne de la bdd*/
	$BDDTable1 = "eleves";
	$BDDTable2 = "cursus";
	
	$BDDmail = 'mail';
	$BDDnom = 'nom';
	$BDDmdp = "pwd";
	$BDDprenom = "prenom";
	$BDDpromo = "promotion";
	$BDDcursus = "cursus";
}
catch (Exception $e){
	die('Erreur : '.$e->getMessage());
}
$connec=0;
session_start();

/*Vérification de l'ouverture de session*/
if(isset($_SESSION['open'])) {
	$connec =1;
	/*Récupération des variables de session*/
	$nom = $_SESSION['nom'];
	$prenom = $_SESSION['prenom'];
	$mail = $_SESSION['mail'];
}						
else{
	$connec=0;
}

/*Gestion de la liste déroulante des années de promotion*/
$cap=2019;
if(isset($_GET['cap']))
{
	$cap = ceil($_GET['cap']);
}

/*Modification des valeurs cursus et Promo si l'utilisateur clique sur le bouton*/
$userValue = 0;
if(isset($_POST['clicMode'])){						
	if(!empty($_POST['année_promo'])){

		$newPromo = htmlspecialchars($_POST['année_promo']);	
		switch (!empty($_POST['cursus'])){
			case 0 :
				$userValue=1;
				break;
			case 1 :
				$newCursus = htmlspecialchars($_POST['cursus']);
				$sql = "INSERT INTO ".$BDDTable2."(".$BDDpromo.", ".$BDDcursus.",".$BDDmail.") VALUES (".$newPromo.",'".$newCursus."', '".$mail."')";
				$stmt = $bdd->prepare($sql);
				$stmt->execute();
				break;			
		}
	}
	else {
		$userValue=1;
	}
}

/*Suppression de la valeur cursus si l'utilisateur clique sur le bouton*/
if(isset($_POST['clic'])){
	if(isset($_POST['choix'])){
		foreach ( $_POST['choix'] as $row ) {
			$sql = " DELETE FROM ".$BDDTable2." WHERE ".$BDDmail."='".$mail."' AND ".$BDDcursus."='".$rowCursus[$row][2]."'";
			$stmt = $bdd->prepare($sql);
			$stmt->execute();
		}
	}
}	
				
?>

<html>

	<head>
		<title>ens rennes</title>
		<meta charset= 'utf-8'> 
		<link rel="stylesheet" href="anel.css"/>
		<link href='http://fonts.googleapis.com/css?family=Ubuntu:bold' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
	</head>

	<body id="bodyancieneleves">
	
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
			
		<div id="main_ancien_eleve">
			<aside id="navpromotion"> 
				<div class="boutonpromotion">
					<h4 id='titrepromo'>Promotion : </h4>
					<div class="annee_promotion">
						<form action="ancieneleves.php" method="get">
							<select class="choix_annee_promotion" name='cap' onChange="this.form.submit();">
								
								<?php
								for ($a = 1994; $a <= 2019; $a++)
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
					$sql = "SELECT eleves.mail, eleves.nom, eleves.prenom, cursus.cursus, cursus.promotion FROM eleves LEFT JOIN cursus ON eleves.mail = cursus.mail WHERE ".$BDDpromo." = ".$cap."";
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
									<td><?=$row[$BDDnom]?></td>
									<td><?=$row[$BDDprenom]?></td>
									<td><?=$row[$BDDpromo]?></td>
									<td><?=$row[$BDDmail]?></td>
									<td><?=$row[$BDDcursus]?></td>
									
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
					
				<div <?php if($connec == 0){echo 'style="display:none"';}?> id='modificationcursus'>
					<p id="userText">Bonjour, <?=$prenom?> <?=$nom?> , voici votre cursus :</p>
					<!--Formulaire pour supprimer les cursus-->
					<div id="deletCursus">
						<?php
						/*Préparation de l'affichage des cursus de l'utilisateur*/
							if ($connec == 1){
								$cursusSql = "SELECT ".$BDDmail." , ".$BDDpromo.", ".$BDDcursus." FROM ".$BDDTable2." WHERE ".$BDDmail."= '".$mail."'";
								$CursusStmt = $bdd->prepare($cursusSql);
								$CursusStmt->execute();
								
								$NbrCursus = $CursusStmt->rowCount();
								$rowCursus = $CursusStmt->fetchAll();
							}
							if ($NbrCursus == 0) {
						?>
						<p> Vous n'avez pas renseigné votre parcours universitaire <br> </p>
							<?php } ?>
							
						<form action="ancieneleves.php" method="post" id="FDeletCursus">
							
							<?php
								if ($NbrCursus >0) 
								{
									$a=0;
									
									foreach ( $rowCursus as $row ) {
							?>
								<input type="checkbox" name="choix[]" value=<?=$a?>> <?=$row[$BDDcursus]?> en <?=$row[$BDDpromo]?><br>
							<?php
								$a++;
									}
								}
							?>
							<input type="submit" name="clic" value="Supprimer" id="BDeletCursus"/>
						</form>	
					</div>
					<!--Formulaire pour modifier les cursus-->
					<form action="ancieneleves.php" method="post" id="cursusBoxInsert">
						<div id="promo">
							<p id='titlepromo'> Promotion </p>
							<input type="text" name="année_promo" id="année_promo" />
						</div>
						
						<div id="cursus">
							<p id='titlecursus'> Cursus </p>						
							<input type="text" name="cursus" id="cursus" />
						</div>
						
						<input type="submit" value="Ajouter" id="sendMaj" name="clicMode" />
					</form>
					<?php 
						if($userValue==1){
							?>
							<p id='errorMessage'> Erreur : Veuillez renseigner les DEUX champs indiqués ci-dessus </p>
						<?php
						}?>
				</div>
			</div>
		</div>
	</body>

</html>