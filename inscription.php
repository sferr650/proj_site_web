<?php 
session_start() ;
/*Connection BDD*/
try{
	/*variable de bdd*/
	$localhostBdd = 'mysql:host=localhost;dbname=ens_eleves;charset=utf8';
	$rootAccount = 'root';
	$rootMdp = "!jBEuKe8";
	
	$conn = new PDO($localhostBdd,$rootAccount, $rootMdp);
	
	
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

if (isset($_POST['submit']))
{

$nom = htmlspecialchars($_POST['nom']) ;
$prenom = htmlspecialchars($_POST['prenom']) ;
$promotion = htmlspecialchars($_POST['promotion']) ;
$email = htmlspecialchars($_POST['email']) ;

/*hachage du mot de passe*/
$password = htmlspecialchars($_POST['password']) ;
$passwordHash = password_hash($password,PASSWORD_BCRYPT);

/*Enregistrement de l'utilisateur dans la BDD*/
$sql = "INSERT INTO ".$BDDTable1." (".$BDDnom.", ".$BDDprenom.", ".$BDDmail.", ".$BDDmdp.") VALUE ('".$nom."','".$prenom."','".$email."','".$passwordHash."')";
$req = $conn -> prepare($sql);
$req->execute();

}
?>

<html>
	<head/>
		<title>formulaire d'inscription</title>
		<meta charset= 'utf-8'> 
		<link  rel="stylesheet" href="connexion.css"/>
	</head>
	
	<body>
		<div id = "page">
			<header>
				<div id="bandeau_du_haut">
					<ul id="connexion_inscription">
						<li><a class = "texte_bandeau" href="connexion.php">Connexion</a></li>
						<li><a class = "texte_bandeau" href="inscription.php">Inscription</a></li>
					</ul>
				</div>
				
				<div id="bandeau_du_bas">
						<a href="acceuil.php"><img class ="logo" src ="ENS_logo.png" alt ="logo header"/></a>
					<nav id = "menu" >
						<ul>
							<li><a class = "texte_bandeau" href="acceuil.php">Acceuil</a></li>
							<li><a class = "texte_bandeau" href="ancieneleves.php">Anciens élèves</a></li>
						</ul>
					</nav>
				</div>

			</header>		
	
	
	<section>
	
	<!--<form method = "post" action = "acceuil.php">-->
	<form method = "post" action = "">
		<fieldset>
			<legend> Veuillez renseigner les informations suivantes </legend>
		
			<label> Votre nom </label><br />
			<input type = "text" name = "nom" id = "nom"/><br/>
			
			<label> Votre prénom </label><br/>
			<input type = "text" name = "prenom" id = "prenom" /><br/>
			
			<label> Votre promo </label><br />
			<select class="choix_annee_promotion" name='promotion' onChange="this.form.submit();">
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
			</select><br />
			
			<label> Votre mail </label><br />
			<input type = "email" name = "email" id = "email" /><br/>
			
			<label> Votre mot de passe </label><br />
			<input type = "password" name = "password" id = "password" /><br/>
			
			<input type="submit" value="Envoyer" name ="submit"/>
		</fieldset>
			
		<p class = "lien_connexion">déjà inscrit ?<a href="connexion.php">(Lien vers la page de connexion)</a></p>
	</form>
	</section>
	
	</body>
</html>