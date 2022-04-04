<?php

session_start();

if (!isset($_SESSION['connecter']) || $_SESSION['connecter'] == false) {
   header('Location: ../..');
}

require_once('../database.php');

$fourniseurs = [];

$reponse = $db->query("SELECT * FROM Fournisseurs");

while ($data = $reponse->fetch(PDO::FETCH_OBJ)) {
   $fourniseurs[] = $data;
}

if ($_POST['action'] == 'ajouter') {
   for ($i = 0; $i < count($fourniseurs); $i++) {
      if ($fourniseurs[$i]->tel == trim($_POST['tel'])) {
         $_SESSION['erreurs']['fournisseur'] = 'ce contact existe déjà dans nos serveurs en tant que <br> '.$fourniseurs[$i]->nom;
         header('Location: ../../'.$_SESSION['utilisateur']);
         break;
      }
   }
   $requete = $db->prepare("INSERT INTO Fournisseurs (nom,tel) VALUES (:nom, :tel)");
   $requete->execute(array(
      'nom' => htmlspecialchars($_POST['nom']),
      'tel' => trim($_POST['tel'])
   ));
   $_SESSION['reponse']['fournisseur'] = 'fournisseur ajouté avec succèss';
   header('Location: ../../'.$_SESSION['utilisateur']);
}

