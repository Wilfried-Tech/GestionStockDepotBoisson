<?php
  if (!isset($_POST['login'])||!isset($_POST['password'])) {
    header('Location: ..');
    exit;
  }
  session_start();
  require_once('database.php');
  
  $reponse = $db->query("SELECT * FROM Utilisateurs");
  
  $utilisateurs = [];
  
  while($champ = $reponse->fetch(PDO::FETCH_OBJ)){
    $utilisateurs[] = $champ;
  }
  
  for ($i = 0; $i < count($utilisateurs); $i++) {
    if ($utilisateurs[$i]->nom == $_POST['login']) {
      if($utilisateurs[$i]->mot_de_passe == $_POST['password']){
        $_SESSION['connecter'] = true;
        $_SESSION['utilisateur'] = $_POST['login'];
        header('Location: ../'+$_POST['login']+'/');
        exit;
      }else{
        $_SESSION['errors']['login'] = "le mot de passe entré est incorrect !";
        header('Location: ..');
        exit;
      }
    }
  }
  
  // arriver a ce niveau on est sur qu'une
  // erreur aie survenu
  
  $_SESSION['errors']['login'] = "une erreur s'est survenu !";
  header('Location: ..');
  exit;
  