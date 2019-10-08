<?php 

$conn = new mysqli ("localhost" , "root" , "", "informations");
if ($conn -> connect_error) {
	die ("Connexion failed: " . $conn -> connect_error);
}

$email = 0 ;
$password = 0;

if (isset($_POST['submit']))
{
	
	$sql = "SELECT mail , mdp , nom , prenom FROM informations";
	$result = $conn -> query($sql) ;
					
	while ($row = $result -> fetch_assoc())
	{
		if (strcmp($row['mail'] , $_POST['email']) == 0)
		{
			$email = 1 ;
			
			if (strcmp($row['mdp'] , $_POST['password']) == 0)
			{
				$password = 1 ;
				$nom = $row['nom'] ;
				$prenom = $row['prenom'] ;
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

<?php if ($authentification == 2){ 

	session_start() ; 
	
	$_SESSION['authentification'] = $authentification ;
	$_SESSION['nom'] = $nom ;
	$_SESSION['prenom'] = $prenom ;
	
	?>
	
	<head/>
		<title>connexion</title>
		<meta charset= 'utf-8'> 
		<link  rel="stylesheet" href="connexion.css"/>
		<meta http-equiv="refresh" content="0; URL=acceuil.html">
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
						<li><a class = "texte_bandeau" href="#">Connexion</a></li>
						<li><a class = "texte_bandeau" href="#">Inscription</a></li>
					</ul>
				</div>
				
				<div id="bandeau_du_bas">
						<a href="acceuil.html"><img class ="logo" src ="ENS_logo.png" alt ="logo header"/></a>
					<nav id = "menu" >
						<ul>
							<li><a class = "texte_bandeau" href="#">Acceuil</a></li>
							<li><a class = "texte_bandeau" href="#">Anciens élèves</a></li>
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