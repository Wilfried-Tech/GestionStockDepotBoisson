<?php
  require_once("../php/database.php");
  require_once("../php/Table.php");
  
  $stock = new Table($db,'Boissons','nom');
  
  $rows = $stock->recuperer();
  $keys = $stock->keys();
  
  if(count($rows)==0){
    $TableStock = "<tr><td>La table des stock est vide </td></tr>";
    
  }else{
  
  ob_start();
  echo "<thead>";
  foreach ($keys as $key) {
    echo "<th>".str_replace("_"," ",$key)."</th>";
  }
  echo "</thead>";
  
  foreach ($rows as $row){
    echo "<tr>";
    foreach ($row as $field) {
      echo "<td>$field</td>";
    }
    echo "</tr>";
  }
  $TableStock = ob_get_clean();
  }
?>
