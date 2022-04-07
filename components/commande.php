<?php
require_once("../php/database.php");
require_once("../php/utils.php");

$commandes = fetch_all($db->query("SELECT commandes.*,DATE_FORMAT(date_commande,'%d/%m/%Y') as date_f,DATE_FORMAT(date_commande,'%H:%i:%s') as date_t, fournisseurs.categorie FROM commandes INNER JOIN fournisseurs ON fournisseur = fournisseurs.id")); 
?>
<thead>
  <th>Boisson</th>
  <th>quantité</th>
  <th>catégorie</th>
  <th>date</th>
  <th>heure</th>
</thead>
<?php
  foreach($commandes as $cmd) {
     echo "
      <tr>
  <td>".$cmd['boisson']."</td>
  <td>".$cmd['quantite']."</td>
  <td>".$cmd['categorie']."</td>
  <td>".$cmd['date_f']."</td>
  <td>".$cmd['date_t']."</td>
</tr>
     ";
  }
?>
