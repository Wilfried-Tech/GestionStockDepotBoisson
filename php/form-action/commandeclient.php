<?php

session_start();

require_once('../redirection.php');
require_once('../database.php');
require_once('../utils.php');

if(!isset_all($_POST,["boisson","quantite","client","payer"])){
  $_SESSION['erreurs']['facture'] = "vérifier que tout les champs sont remplis et reessayer !";
  header('Location: ../../'.$_SESSION['utilisateur']);
}

$boisson = $db->query("SELECT * FROM boissons WHERE id = ".$_POST['boisson'])->fetch(PDO::FETCH_ASSOC);
$client = $db->query("SELECT * FROM clients WHERE tel = ".$_POST['client'])->fetch(PDO::FETCH_ASSOC);

if(intval($_POST['quantite'])>intval($boisson['quantite'])){
  $_SESSION['erreurs']['facture'] = "la quantité en stock est insuffisante !";
    header('Location: ../../'.$_SESSION['utilisateur']);
}

$dette = intval($client['dette']);
$prixnet = intval($_POST['quantite'])*intval($boisson['prix_unitaire']);
$payer = intval($_POST['payer']);
$reste = $payer - $prixnet;

if($dette>0){
  if($reste<$dette){
    $_SESSION['erreurs']['facture'] = "le client n'est pas solvable!";
      header('Location: ../../'.$_SESSION['utilisateur']);
  }else{
    $req = $db->prepare("UPDATE clients SET dette = :dette WHERE tel = :tel");
    $req->execute(array(
      'dette' => $reste > $dette? 0 : $dette - $reste,
      'tel' => $_POST['client']
    ));
    
    $req = $db->prepare("UPDATE boissons SET quantite = :quantite WHERE id = :id");
    $req->execute(array(
      'quantite' => intval($boisson['quantite']) - intval($_POST['quantite']),
      'id' => $_POST['boisson']
    ));
    
    $req = $db->prepare("INSERT INTO factures (client, produit,quantite,payer,reste) VALUES (:client, :produit, :quantite, :payer, :reste)");
    $req->execute(array(
      'client' => $client['tel'],
      'produit' => $boisson['id'],
      'quantite' => $_POST['quantite'],
      'payer' => $payer,
      'reste' => $reste
    ));
  }
}else{
  if($reste<0 && $reste > -500){
      $_SESSION['erreurs']['facture'] = "le client ne peut faire un crédit de plus de 500fr";
        header('Location: ../../'.$_SESSION['utilisateur']);
    }else{
      $req = $db->prepare("UPDATE clients SET dette = :dette WHERE tel = :tel");
      $req->execute(array(
        'dette' => $reste == 0? 0 : $reste * -1,
        'tel' => $_POST['client']
      ));
      
      $req = $db->prepare("UPDATE boissons SET quantite = :quantite WHERE id = :id");
      $req->execute(array(
        'quantite' => intval($boisson['quantite']) - intval($_POST['quantite']),
        'id' => $_POST['boisson']
      ));
      
      $req = $db->prepare("INSERT INTO factures (client, produit,quantite,payer,reste) VALUES (:client, :produit, :quantite, :payer, :reste)");
      $req->execute(array(
        'client' => $client['tel'],
        'produit' => $boisson['id'],
        'quantite' => $_POST['quantite'],
        'payer' => $payer,
        'reste' => $reste
      ));
    }
}
   
$_SESSION['reponse']['commande'] = 'commande ajouté avec succèss';
header('Location: ../../'.$_SESSION['utilisateur']);

