<?php

session_start();

if (!isset($_SESSION['connecter']) || $_SESSION['connecter'] == false) {
   header('Location: ../..');
}

require_once('../database.php');
require_once('../Table.php');

$boisson = (new Table($db,'Boisson','nom'))->recuperer();

if ($_POST['action'] == 'ajouter') {
   for ($i = 0; $i < count($boisson); $i++) {
      if ($boisson[$i]["nom"] == trim($_POST['nom'])) {
         $boissonCommander = $boisson[$i];
         break;
      }
   }
   $requete = $db->prepare("INSERT INTO Commandes (nom,tel) VALUES (:nom, :tel)");
   $requete->execute(array(
      'nom' => htmlspecialchars($_POST['nom']),
      'tel' => trim($_POST['tel'])
   ));
   $_SESSION['reponse']['fournisseur'] = 'fournisseur ajouté avec succèss';
   header('Location: ../../'.$_SESSION['utilisateur']);
}

