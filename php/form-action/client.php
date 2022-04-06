<?php

session_start();

require_once('../redirection.php');
require_once('../database.php');
require_once('../utils.php');

if(!isset_all($_POST,["tel","nom"])){
  $_SESSION['erreurs']['client'] = "vérifier que tout les champs sont remplis et reessayer !";
  header('Location: ../../'.$_SESSION['utilisateur']);
}

$clients = fetch_all($db->query("SELECT * FROM clients"));

   for ($i = 0; $i < count($clients); $i++) {
      if ($clients[$i]['tel'] == trim($_POST['tel'])) {
         $_SESSION['erreurs']['client'] = 'ce contact existe déjà dans nos serveurs en tant que <br> '.$clients[$i]['nom'];
         header('Location: ../../'.$_SESSION['utilisateur']);
         break;
      }
   }
   $requete = $db->prepare("INSERT INTO clients (nom,tel) VALUES (:nom, :tel)");
   $requete->execute(array(
      'nom' => htmlspecialchars($_POST['nom']),
      'tel' => $_POST['tel']
   ));
   $_SESSION['reponse']['client'] = 'client ajouté avec succèss';
   header('Location: ../../'.$_SESSION['utilisateur']);
