<?php

session_start();

require_once("../redirection.php");
require_once('../database.php');
require_once("../utils.php");

if(!isset_all($_POST,["tel","nom","categorie"])){
  $_SESSION['erreurs']['fournisseur'] = "vérifier que tout les champs sont remplis et reessayer !";
  header('Location: ../../'.$_SESSION['utilisateur']);
}

$reponse = $db->query("SELECT * FROM fournisseurs");

$fourniseurs = fetch_all($reponse);

   for ($i = 0; $i < count($fourniseurs); $i++) {
      if ($fourniseurs[$i]['tel'] == trim($_POST['tel'])) {
         $_SESSION['erreurs']['fournisseur'] = 'ce contact existe déjà dans nos serveurs en tant que <br> '.$fourniseurs[$i]["nom"];
         header('Location: ../../'.$_SESSION['utilisateur']);
         break;
      }
   }
   $requete = $db->prepare("INSERT INTO fournisseurs (nom,tel,categorie) VALUES (:nom, :tel, :categorie)");
   $requete->execute(array(
      'nom' => htmlspecialchars($_POST['nom']),
      'tel' => trim($_POST['tel']),
      'categorie' => htmlspecialchars($_POST['categorie'])
   ));
   $_SESSION['reponse']['fournisseur'] = 'fournisseur ajouté avec succèss';
   header('Location: ../../'.$_SESSION['utilisateur']);

