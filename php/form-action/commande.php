<?php

session_start();

require_once('../redirection.php');
require_once('../database.php');
require_once('../utils.php');

if(!isset_all($_POST,["boisson","quantite","fournisseur"])){
  $_SESSION['erreurs']['commande'] = "vérifier que tout les champs sont remplis et reessayer !";
  header('Location: ../../'.$_SESSION['utilisateur']);
}

   $requete = $db->prepare("INSERT INTO commandes (boisson,fournisseur, quantite) VALUES (:boisson, :fournisseur, :quantite)");
   $requete->execute(array(
      'boisson' => htmlspecialchars($_POST['boisson']),
      'fournisseur' => trim($_POST['fournisseur']),
      'quantite' => intval($_POST["quantite"])
   ));
   
   $_SESSION['reponse']['commande'] = 'commande ajouté avec succèss';
   header('Location: ../../'.$_SESSION['utilisateur']);

