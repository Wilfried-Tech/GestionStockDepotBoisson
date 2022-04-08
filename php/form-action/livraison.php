<?php
   
session_start();
   
require_once('../redirection.php');
require_once('../database.php');
require_once('../utils.php');

if(isset($_GET['id'])){
  $requete = $db->prepare("DELETE FROM boissons WHERE id = :id");
  $requete->execute(array(
    'id' => $_GET['id']
  ));
  $_SESSION['reponse']['livraison'] = 'boisson supprimé avec succès';
  header('Location: ../../'.$_SESSION['utilisateur']);
  exit;
}

if(!isset_all($_POST,["boisson","quantite","categorie","prix_unit","litre","minimum"])){
   $_SESSION['erreurs']['livraison'] = "vérifier que tout les champs sont remplis et reessayer !";
   header('Location: ../../'.$_SESSION['utilisateur']);
}

$requete = $db->prepare("INSERT INTO livraisons (nom_produit,categorie,quantite,prix_unitaire,minimum) VALUES (:nom, :cat, :qte, :prix, :min)");
$requete->execute(array(
  'nom' => htmlspecialchars($_POST["boisson"]),
  'cat' => $_POST["categorie"],
  'qte' => intval($_POST["quantite"]),
  'prix' => intval($_POST["prix_unit"]),
  'min' => intval($_POST["minimum"])
));

$boisson = $db->query("SELECT * FROM boissons WHERE nom = '".strtolower($_POST['boisson'])."'")->fetch(PDO::FETCH_ASSOC);

if(!$boisson){
$requete = $db->prepare("INSERT INTO boissons (nom,categorie,quantite,prix_unitaire,minimum,litre,quantite_livrer) VALUES (:nom, :cat, :qte, :prix, :min, :litre, :qte_livrer)");
$requete->execute(array(
  'nom' => htmlspecialchars($_POST["boisson"]),
  'cat' => $_POST["categorie"],
  'qte' => intval($_POST["quantite"]),
  'prix' => intval($_POST["prix_unit"]),
  'min' => intval($_POST["minimum"]),
  'litre' => intval($_POST["litre"]),
  'qte_livrer' => intval($_POST["quantite"])
));
}else{
$requete = $db->prepare("UPDATE boissons SET quantite = :qte,prix_unitaire = :prix,minimum = :min,litre = :litre,quantite_livrer = :qte_livrer WHERE id = :id");
$requete->execute(array(
  'id' => intval($boisson['id']),
  'qte' => intval($_POST["quantite"]) + intval($boisson["quantite"]),
  'prix' => intval($_POST["prix_unit"]),
  'min' => intval($_POST["minimum"]),
  'litre' => intval($_POST["litre"]),
  'qte_livrer' => intval($_POST["quantite"])
));
}
$_SESSION['reponse']['livraison'] = 'livraison ajouté avec succèss';
header('Location: ../../'.$_SESSION['utilisateur']);
