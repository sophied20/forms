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
    $select = $connexion->prepare("SELECT * FROM pays");
    $select->execute(array());
    $result = $select->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULAIRE</title>
    <link rel="stylesheet" href="formulaire.css">
</head>
<body>
    <form action="formulaire.php" method="post">
        <h2>Creer Un compte</h2>
        <label for="Nom">Nom:</label>
        <input type="text" id="Nom" name="username" required>
        <label for="Prenom">Prenom:</label>
        <input type="text" id="Prenom" name="userfirstname" required>
        <br>
        <br>
        <label for="phonumber">Telephone:</label>
        <input type="number" name="phonumber" id="phonumber" required>
        <br>
        <br>
        <label for="mail">MAIL:</label>
        <input type="email" name="mail" id="mail" required>
        <br>
        <br>
        <label for="genre">Masculin</label>
        <input type="radio" name="genre" id="genre" value="M" required>
        <label for="genre">Feminin</label>
        <input type="radio" name="genre" id="genre" value="F" required>
        <br>
        <br>
        <label for="pais">Pays:</label>
        <select name="pais" id="pais" required>
            <option selected disabled>Choisissez votre pays:</option>
			<?php foreach ($result as $key):; ?>
			<option value="<?php echo $key['id'];?>"><?php echo $key['pais']; ?></option>
			<?php endforeach;?>
        </select>
        <br>
        <br>
        <label for="naissance">Date de naissance:</label>
        <input type="date" name="naissance" id="naissance" required>
        <br>
        <br>
        <input type="submit"  value="valider" name="valider"> 
    </form>
</body>
</html>