<?php
if(isset($_REQUEST['valider'])){
	extract($_REQUEST);
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
}
if (isset($_SESSION['ID'])){
	header('Location: test.php');
	exit;
}
?>