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
if(isset($_POST['valider'])) {
    extract($_POST);
    $mail = htmlspecialchars($_POST['mail']); 
    $mdp = sha1($_POST['mdp']);
    if(!empty($_POST['mail']) AND !empty($_POST['mdp'])) {
       $q = $connexion->prepare("SELECT * FROM compte WHERE Mail = ? AND mdp = ? limit 1");
       $q->execute(array($mail,$mdp));
       $userexist = $q->rowCount();
       if($userexist > 0) {
            $_SESSION['mail'] = $mail;
            $_SESSION['mdp'] = $mdp;
            $_SESSION['ID'] = $q->fetch()['ID'];
            header('location:../formulaire/test.php');
       }else {
            $erreur = "<span class='red'>Mauvais email ou mot de passe !</span>";
       }
    }else {
       $erreur = "<span class='red'>Tous les champs doivent être complétés !</span>";
    }
 }
?>



