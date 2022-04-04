<?php

session_start();

if (!isset($_SESSION['connecter']) || $_SESSION['connecter'] == false) {
   header('Location: ../..');
}

require_once('../database.php');
require_once('../Table.php');

$boisson = (new Table($db,'Boissons','nom'))->recuperer();

if ($_POST['action'] == 'ajouter') {
   for ($i = 0; $i < count($boisson); $i++) {
      if ($boisson[$i]["nom"] == trim($_POST['nom'])) {
         $boissonCommander = $boisson[$i];
         break;
      }
   }
   $requete = $db->prepare("INSERT INTO Commandes (boisson,fournisseur) VALUES (:boisson, :fournisseur)");
   $requete->execute(array(
      'boisson' => htmlspecialchars($_POST['nom']),
      'fournisseur' => trim($_POST['fournisseur'])
   ));
   $requete = $db->prepare("UPDATE Boissons SET quantite=:qte,fournisseur=:fournisseur,quantite_livrer=:qte_livrer WHERE nom=:nom");
      $requete->execute(array(
         'nom' => htmlspecialchars($_POST['nom']),
         'fournisseur' => trim($_POST['fournisseur']),
         'qte' => intval($boissonCommander['quantite'])+intval($_POST['qte']),
         'qte_livrer' => intval($_POST['qte'])
      ));
   $_SESSION['reponse']['commande'] = 'commande ajouté avec succèss';
   header('Location: ../../'.$_SESSION['utilisateur']);
}

