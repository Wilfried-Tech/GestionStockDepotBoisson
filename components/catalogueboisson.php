<?php
require_once("../php/database.php");
require_once("../php/utils.php");

$response = $db->query("SELECT boissons.*,DATE_FORMAT(boissons.date_livraison,'%d/%m/%Y %h:%i:%s') as date_livraison,fournisseurs.categorie as categorie FROM boissons LEFT JOIN fournisseurs ON boissons.categorie = fournisseurs.categorie");

$rows = fetch_all($response);

echo " 
  <caption>
    <h1>catalogue des produits</h1>
  </caption>
  <thead>
    <th>designation</th>
    <th>categorie</th>
    <th>prix unitaire</th>
    <th>quantite</th>
    <th>capacite (cl)</th>
    <th>minimum</th>
  </thead>
";

if (count($rows) == 0) {
  echo "<tr><td colspan='6'>Le catalogue est vide </td></tr>";
} else {
  $gains = 0;
  $total = 0;
  foreach ($rows as $row) {
    echo "<tr>";
    echo "<td>".$row["nom"]."</td>";
    echo "<td>".$row["categorie"]."</td>";
    echo "<td>".$row["prix_unitaire"]."</td>";
    echo "<td>".$row["quantite"]."</td>";
    echo "<td>".$row["litre"]."</td>";
    echo "<td>".$row["minimum"]."</td>";
    echo "</tr>";
  }
}
?>
