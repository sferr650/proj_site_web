<?php 

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
session_start() ;
/*Fermeture de session*/
if(isset($_SESSION['open'])){
	$_SESSION['open'] =0;
	session_destroy();	
}

$email = 0 ;
$password = 0;

if (isset($_POST['submit']))
{
	
	$sql = "SELECT ".$BDDmail." , ".$BDDmdp.", ".$BDDnom.",".$BDDprenom." FROM ".$BDDTable1."";
	$result = $conn->query($sql);	
	$rowt = $result->fetchAll();
	$NbreData = $result->rowCount();
					
	foreach ($rowt as $row)
	{
		if (strcmp($row[$BDDmail] , $_POST['email']) == 0) // vérifie si le mail est dans la base de donnée
		{
			$email = 1 ;
					
			if ( password_verify($_POST['password'], $row[$BDDmdp]) ) // vérifie si le H du mot de passe est identique à celui de la base de donnée 
			{
				$password = 1 ;
				$nom = $row[$BDDnom] ;
				$prenom = $row[$BDDprenom] ;
				$mail = $row[$BDDmail];
				break;
			}
			else
			{
				$password = 3 ;
			}
		}
		else
		{
			$email = 3;
		}
	}
}

$authentification = $email + $password ;

?> 
<html> 

<?php if ($authentification == 2){ // initalisation des variables de session 
	
	$_SESSION['nom'] = $nom ;
	$_SESSION['prenom'] = $prenom ;
	$_SESSION['mail'] = $mail;
	$_SESSION['open'] = 1;
	
	?>
	
	<head/>
		<title>connexion</title>
		<meta charset= 'utf-8'> 
		<link  rel="stylesheet" href="connexion.css"/>
		<meta http-equiv="refresh" content="0; URL=acceuil.php"> <!--redirige l'utilisteur vers la page d'acceuil-->
	</head>
<?php }?>

	<head/>
		<title>connexion</title>
		<meta charset= 'utf-8'> 
		<link  rel="stylesheet" href="connexion.css"/>
	</head>
	

	<body>
		<div id = "page">
			<header>
				<div id="bandeau_du_haut">
					<ul id="connexion_inscription">
							<li><a class = "texte_bandeau" href="connexion.php" name="deco">Connexion</a></li>
							<li><a class = "texte_bandeau" href="inscription.php">Inscription</a></li>
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
		<section> 
			<form method = "post" action = "connexion.php">
			
				<fieldset>
					<legend> Veuillez renseigner les informations suivantes </legend>
					
					<label> e-mail </label><br />
					<input type = "email" name = "email" id = "email" /><br/>
					
					<label> mot de passe </label><br />
					<input type = "password" name = "password" id = "password" /><br/>
					
				</fieldset>
			
			<p><input type="submit" value="se connecter" name="submit" /></p>
			<p class = "lien_inscription"> pas encore inscrit ? <a href="formulaire_dinscription.html">(Lien vers la page d'inscription)</a></p>
			<?php if ($authentification >= 3) { echo "<p>mot de passe ou email invalide</p>" ;} ?>
			</form>
			
	</body>
</html>