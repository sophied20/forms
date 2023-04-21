<?php
	define('HOST','127.0.0.1');
	define('DB_NAME','reselform');
	define('USER','root');
	define('PASS','');
	try{
		$connexion=new PDO("mysql:host=" .HOST. ";dbname=" . DB_NAME .";charset=UTF8",USER,PASS);
		$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		echo 'Erreur la connexion echoue !'.$e->getMessage();
		exit();
	}
	if(isset($_POST['valider'])){
		extract($_POST);
		if(isset($Nom) AND !empty($Nom) AND $Nom != $affiche['Nom']){
			$modifier = $connexion->prepare("UPDATE compte SET Nom = ? WHERE ID = ? ");
			$modifier ->execute(array($Nom,$_GET['modif']));
			header('location:liste.php');
		}
		if(isset($Prenom) AND !empty($Prenom) AND $Prenom != $affiche['Prenom']){
			$modifier = $connexion->prepare("UPDATE compte SET Prenom = ? WHERE ID = ? ");
			$modifier ->execute(array($Prenom,$_GET['modif']));
			header('location:liste.php');
	    }
	   if(isset($Tel) AND !empty($Tel) AND $Tel != $affiche['Telephone']){
			$modifier = $connexion->prepare("UPDATE compte SET Telephone = ? WHERE ID = ? ");
			$modifier ->execute(array($Tel,$_GET['modif']));
			header('location:liste.php');
	    }
	   if(isset($Mail) AND !empty($Mail) AND $Mail != $affiche['Mail']){
			$modifier = $connexion->prepare("UPDATE compte set Mail = ? WHERE ID = ? ");
			$modifier ->execute(array($Mail,$_GET['modif']));
			header('location:liste.php');
	    }
		if(isset($genre) AND !empty($genre) AND $genre != $affiche['genre']){
			$modifier = $connexion->prepare("UPDATE compte SET genre = ? WHERE ID = ? ");
			$modifier ->execute(array($genre,$_GET['modif']));
			header('location:liste.php');
	    }
	   if(isset($pais) AND !empty($pais) AND $pais != $affiche['pays']){
		   $modifier = $connexion->prepare("UPDATE compte SET pays = ? WHERE ID = ? ");
		   $modifier ->execute(array($pais,$_GET['modif']));
		   header('location:liste.php');
	  	}
		if(isset($naissance) AND !empty($naissance) AND $naissance != $affiche['date_naissance']){
		   $modifier = $connexion->prepare("UPDATE compte SET date_naissance = ? WHERE ID = ? ");
		   $modifier ->execute(array($naissance,$_GET['modif']));
		   header('location:liste.php');
		}
	}
	$code =$_GET['modif'];      
    $modification = $connexion->prepare('SELECT * FROM compte WHERE ID = ? limit 1');
	$modification->execute(array($_GET['modif']));
	$affiche = $modification->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Modif_compte</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="formulaire.css">
</head>
<body>
<div id="media-2" class="form-center" align="center">
<h1>Update des comptes</h1>
  <form method="POST">
    <label for="lname">Nom*</label><br>
    <input type="text" id="lname" name="Nom" value="<?php echo $affiche['Nom']; ?>" required><br>
    <label for="xxx-x">Prenom*</label><br>
    <input type="text" id="xxx-xx" name="Prenom" value="<?php echo $affiche['Prenom']; ?>" required><br>
    <label for="lname">Telephone*</label><br>
    <input type="text" id="lname" name="Tel" value="<?php echo $affiche['Telephone']; ?>" required><br>
    <label for="xxx-x">Email*</label><br>
    <input type="text" id="xxx-x" name="Mail" value="<?php echo $affiche['Mail']; ?>" required><br>
	<label for="lname">genre*</label><br>
    <input type="text" id="lname" name="genre" value="<?php echo $affiche['genre']; ?>" required><br>
    <label for="xxx-x">Pays*</label><br>
    <input type="text" id="xxx-xx" name="pais" value="<?php echo $affiche['pays']; ?>" required><br>
    <label for="lname">Date de naissance*</label><br>
    <input type="text" id="lname" name="naissance" value="<?php echo $affiche['date_naissance']; ?>" required><br>    
	<br>
	<input type="submit" value="Update" name="valider">&nbsp;&nbsp;
  </form>
</div>
</body>
</html>
