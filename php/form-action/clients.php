<?php

session_start();

if (!isset($_SESSION['connecter']) || $_SESSION['connecter'] == false) {
   header('Location: ..');
}

if (!isset($_POST['action']) || !isset($_POST['nom']) || !isset($_POST['tel'])) {
   $_SESSION['erreurs']['client'] = 'Veillez bien remplir les informations';
   header('Location: ../'.$_SESSION['utilisateur'].'/');
}

require_once('database.php');

$clients = [];

$reponse = $db->query("SELECT * FROM Clients");

while ($data = $reponse->fetch(PDO::FETCH_OBJ)) {
   $clients[] = $data;
}

if ($_POST['action'] == 'ajouter') {
   for ($i = 0; $i < count($clients); $i++) {
      if ($clients[$i]->tel == trim($_POST['tel'])) {
         $_SESSION['erreurs']['client'] = 'ce contact existe déjà dans nos serveurs en tant que \n '.$clients[$i]->nom;
         header('Location: ../'.$_SESSION['utilisateur']);
         break;
      }
   }
   $requete = $db->prepare("INSERT INTO Clients (nom,tel) VALUES (:nom, :tel)");
   $requete->execute(array(
      'nom' => htmlspecialchars($_POST['nom']),
      'tel' => $_POST['tel']
   ));
   $_SESSION['reponse']['client'] = 'client ajouté avec succèss';
   header('Location: ../'.$_SESSION['utilisateur']);
}

if ($_POST['action'] == 'supprimer') {
   for ($i = 0; $i < count($clients); $i++) {
      if ($clients[$i]->tel == trim($_POST['tel'])) {
         $requete = $db->prepare("DELETE FROM clients WHERE tel=:tel");
         $requete->execute(array(
            'tel' => $_POST['tel']
         ));
         $_SESSION['reponse']['client'] = 'client supprimée avec succèss';
         header('Location: ../'.$_SESSION['utilisateur']);
         break;
      }
   }
   $_SESSION['erreurs']['client'] = 'ce client existe déjà dans nos serveurs en tant que \n '.$clients[$i]->nom;
   header('Location: ../'.$_SESSION['utilisateur']);
   break;
}
