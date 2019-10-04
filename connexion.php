<?php 

$conn = new mysqli ("localhost" , "root" , "", "informations");
if ($conn -> connect_error) {
	die ("Connexion failed: " . $conn -> connect_error);
}
$email = 0 ; 
$password = 0 ;
?>

<html>
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
			<form method = "post" <?php if (($password == 0) AND ($email == 0) {?> action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" <?php} elseif(($password == 0) AND ($email == 0)) {?> action = "acceuil.php" <?php}?>>
	
				<fieldset>
					<legend> Veuillez renseigner les informations suivantes </legend>
	
	
					<label> e-mail </label><br />
					<input type = "email" name = "email" id = "email" /><br/>
					<?php if ($email == 0) {?><p>email invalide</p> <?php } ?>

					<label> mot de passe </label><br />
					<input type = "password" name = "password" id = "password" /><br/>
					<?php if ($password == 0) {?><p>email invalide</p> <?php } ?>
				</fieldset>
	
				<p> 
				<input type="submit" value="se connecter" name="submit" /> 
				</p>
				
				<?php if (isset($_POST['submit']))
				{
					
					$sql = "SELECT email, mdp FROM informations";
					$result = $conn -> query($sql) ;
					
					while ($row = $result -> fetch_assoc())
					{
						if (($row['email'] == $_POST['email']) AND ($row['mdp'] = $_POST['password']))
						{
							$email = 1 ;
							$password = 1;
						}
					}
					
				}?>
				
				<p class = "lien_inscription"> pas encore inscrit ? <a href="formulaire_inscription.html">(Lien vers la page d'inscription)</a></p>
	
			</form>
	
		</section>
	
	</body>
</html>