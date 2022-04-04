<?php

session_start();

if (!isset($_SESSION['connecter']) || $_SESSION['connecter'] == false) {
   header('Location: ../..');
}

require_once('../database.php');
require_once('../Table.php');




$boissons = [];

$reponse = (new Table($db,'Boissons','nom'))->recuperer();

if ($_POST['action'] == 'ajouter') {
   for ($i = 0; $i < count($boissons); $i++) {
      if ($boissons[$i]["nom"] == trim($_POST['nom'])) {
         $_SESSION['erreurs']['boisson'] = 'cette boisson existe deja';
         header('Location: ../../'.$_SESSION['utilisateur']);
         break;
      }
   }
   $requete = $db->prepare("INSERT INTO Boissons (nom,prix_unitaire,fournisseur, minimum) VALUES (:nom,:pu,:fournisseur, :min)");
   $requete->execute(array(
      'nom' => htmlspecialchars($_POST['nom']),
      'min' => $_POST['min'],
      'pu' => $_POST['prix_unit'],
      'fournisseur' => $_POST['fournisseur']
   ));
   $_SESSION['reponse']['boisson'] = 'boisson ajouté avec succèss';
   header('Location: ../../'.$_SESSION['utilisateur']);
}

