<?php

session_start();

if (!isset($_SESSION['connecter']) || $_SESSION['connecter'] == false) {
   header('Location: ..');
}

if (!isset($_POST['action']) || !isset($_POST['nom']) || !isset($_POST['tel'])) {
   $_SESSION['erreurs']['fournisseur'] = 'Veillez bien remplir les informations';
   header('Location: ../'.$_SESSION['utilisateur'].'/');
}

require_once('database.php');

$fourniseurs = [];

$reponse = $db->query("SELECT * FROM Fournisseurs");

while ($data = $reponse->fetch(PDO::FETCH_OBJ)) {
   $fourniseurs[] = $data;
}

if ($_POST['action'] == 'ajouter') {
   for ($i = 0; $i < count($fourniseurs); $i++) {
      if ($fourniseurs[$i]->tel == trim($_POST['tel'])) {
         $_SESSION['erreurs']['fourniseur'] = 'ce contact existe déjà dans nos serveurs en tant que \n '.$fourniseurs[$i]->nom;
         header('Location: ../'.$_SESSION['utilisateur']);
         break;
      }
   }
   $requete = $db->prepare("INSERT INTO Fournisseurs (nom,tel) VALUES (:nom, :tel)");
   $requete->execute(array(
      'nom' => htmlspecialchars($_POST['nom']),
      'tel' => $_POST['tel']
   ));
   $_SESSION['reponse']['fournisseur'] = 'fournisseur ajouté avec succèss';
   header('Location: ../'.$_SESSION['utilisateur']);
}

if ($_POST['action'] == 'supprimer') {
   for ($i = 0; $i < count($fourniseurs); $i++) {
      if ($fourniseurs[$i]->tel == trim($_POST['tel'])) {
         $requete = $db->prepare("DELETE FROM Fournisseurs WHERE tel=:tel");
         $requete->execute(array(
            'tel' => $_POST['tel']
         ));
         $_SESSION['reponse']['fournisseur'] = 'fournisseur supprimée avec succèss';
         header('Location: ../'.$_SESSION['utilisateur']);
      }
   }
   $_SESSION['erreurs']['fourniseur'] = 'ce contact existe déjà dans nos serveurs en tant que \n '.$fourniseurs[$i]->nom;
   header('Location: ../'.$_SESSION['utilisateur']);
   break;
}
