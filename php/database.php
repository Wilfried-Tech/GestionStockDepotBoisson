<?php

$host = ["0.0.0.0:3306", "localhost"];
$dbname = ["GestionStockDepotBoisson", "id17962202_wilfriedhelp"];
$user = ["root", "id17962202_wilfriedlarry"];
$password = ["root", "jtmlucie63@Webhost"];
$i = $_SERVER["REMOTE_ADDR"] != $_SERVER["SERVER_ADDR"]? 1 : 0;

try {
   $db = new PDO("mysql:host=$host[$i];dbname=$dbname[$i];charset=utf8", $user[$i], $password[$i], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}catch (Exception $e) {
   header("Content-type: text/plain", "error", 500);
   die("Erreur : " . $e->getMessage());
}
