<?php
session_start();

if(!isset($_SESSION['connecter'])||!isset($_SESSION['utilisateur'])){
  //header('Location: ..');
}
