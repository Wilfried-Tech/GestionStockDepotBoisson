<?php
  require_once("../php/database.php");
  
  $response = $db->query('SELECT Boissons.*,Fournisseurs.nom as fournisseur FROM Boissons,Fournisseurs WHERE Boissons.fournisseur = Fournisseurs.id');
  
  $rows = [];
  while($row = $response->fetch(PDO::FETCH_ASSOC)) $rows[] = $row;
  
  $keys = array_keys($rows[0]?$rows[0]:[]);
  
  if(count($rows)==0){
    $TableStock = "<tr><td>La table des stock est vide </td></tr>";
    
  }else{
  
  ob_start();
  echo "<thead>";
  foreach ($keys as $key) {
    echo "<th>".str_replace("_"," ",$key)."</th>";
  }
  echo "<th>Alerte</th>";
  echo "</thead>";
  
  foreach ($rows as $row){
    echo "<tr>";
    foreach ($row as $field) {
      echo "<td>$field</td>";
    }
    if(intval($row['quantite'])<=intval($row['minimum'])){
      echo "<td class='qte-less'><span><i class='mdi mdi-alert-outline'></i></span></td>";
    }else{
      echo "<td><span><i class='mdi mdi-check-all'></i></span></td>";
    }
    echo "</tr>";
  }
  $TableStock = ob_get_clean();
  }
?>
