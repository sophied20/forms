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
	$code=$_GET['id'];
	$req = $connexion->prepare('DELETE FROM compte WHERE ID = ? limit 1');
	$req ->execute(array($_REQUEST['id']));
	if ($req) {
		echo 'le compte a ete supprime';
	} 
	else{
		echo 'la suppression a rencontre un probleme';
	}
?>
