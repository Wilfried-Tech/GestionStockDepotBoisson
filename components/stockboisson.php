<?php
require_once("../php/database.php");
require_once("../php/utils.php");

$response = $db->query("SELECT boissons.*,DATE_FORMAT(boissons.date_livraison,'%d/%m/%Y %h:%i:%s') as date_livraison,fournisseurs.categorie as categorie FROM boissons LEFT JOIN fournisseurs ON boissons.categorie = fournisseurs.categorie");

$rows = fetch_all($response);

echo " 
  <caption>
    <h1>Inventaire du Stock</h1>
  </caption>
  <thead>
    <th>alerte</th>
    <th>designation</th>
    <th>categorie</th>
    <th>prix unitaire</th>
    <th>quantite</th>
    <th>capacite (cl)</th>
    <th>minimum</th>
    <th>quantite entré</th>
    <th>date</th>
    <th>heure</th>
    <th>montant total</th>
    <th>options</th>
  </thead>
";

if (count($rows) == 0) {
  echo "<tr><td colspan='11'>La table des stock est vide </td></tr>";
} else {
  $gains = 0;
  $total = 0;
  foreach ($rows as $row) {
    echo "<tr>";
    if (intval($row['quantite']) <= intval($row['minimum'])) {
      echo "<td class='qte-less'><span><i class='mdi mdi-alert-outline'></i></span></td>";
    } else {
      echo "<td class='qte-normal'><span><i class='mdi mdi-check-all'></i></span></td>";
    }
    $total = intval($row["quantite"])*intval($row["prix_unitaire"]);
    $gains += $total;
    echo "<td>".$row["nom"]."</td>";
    echo "<td>".$row["categorie"]."</td>";
    echo "<td>".$row["prix_unitaire"]."</td>";
    echo "<td>".$row["quantite"]."</td>";
    echo "<td>".$row["litre"]."</td>";
    echo "<td>".$row["minimum"]."</td>";
    echo "<td>".$row["quantite_livrer"]."</td>";
    echo "<td>".preg_split("# #",$row["date_livraison"])[0]."</td>";
    echo "<td>".preg_split("# #",$row["date_livraison"])[1]."</td>";
    echo "<td>".$total."</td>";
    echo "<td><a href='../php/form-action/livraison.php?id=".$row['id']."'><button>supprimer</button></a></td>";
    echo "</tr>";
  }
  echo "
    <tr>
      <td colspan='10'>total</td>
      <td>$gains</td>
      <td></td>
    </tr>";
}
?>
