<?php
session_start();
if(isset($_POST['valider'])) {
   extract($_POST);
   $nom=htmlspecialchars($_POST['username']);
   $prenom=htmlspecialchars($_POST['userfirstname']);
   $telephone=htmlspecialchars($_POST['phonumber']);
   $mail=htmlspecialchars($_POST['mail']);
   $genre=htmlspecialchars($_POST['genre']);
   $pays=htmlspecialchars($_POST['pais']);
   $naissance=htmlspecialchars($_POST['naissance']);
   $mdp=sha1(trim($mdp));
   $mdp_=sha1(trim($mdp_));
   if (!empty($_POST['username']) AND !empty($_POST['userfirstname']) AND !empty($_POST['phonumber']) AND !empty($_POST['mail']) AND !empty($_POST['genre']) AND !empty($_POST['pais']) AND !empty($_POST['naissance']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp_'])){
      if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
         include 'PDO.php';
         $reqmail = $connexion->prepare("SELECT * FROM compte WHERE Mail = ? limit 1");
         $reqmail->execute(array($mail));
         $mailexist = $reqmail->rowCount();
         if($mailexist == 0) {
            if ($mdp==$mdp_) {
               $q = $connexion->prepare("INSERT INTO compte(Nom, Prenom, Telephone, Mail, genre, pays, date_naissance, mdp, mdp_ ) VALUES(:Nom,:Prenom,:Telephone,:Mail,:genre,:pays,:date_naissance,:mdp,:mdp_)");
               $q->execute(array(':Nom' => $nom,':Prenom' => $prenom, ':Telephone' => $telephone, ':Mail' => $mail, ':genre' => $genre, ':pays' => $pays, ':date_naissance' => $naissance, ':mdp' => $mdp, ':mdp_' => $mdp_));
               header('location:..\connexion\connexion.php');
            } else {
               echo "<span class='red'>Vos mots de passes ne correspondent pas !</span>";
               exit();
            }
         } else {
            $erreur = "<span class='red'>Adresse e-mail déjà utilisée !</span>";
            echo $erreur;
            exit();
         }
      } else {
         $erreur = "<span class='red'>Oups votre adresse mail n'est pas valide !</span>";
         exit();
      }
      echo 'Bonjour, votre inscription est une reussite';
      header("location:liste.php");
   }
}
?>
