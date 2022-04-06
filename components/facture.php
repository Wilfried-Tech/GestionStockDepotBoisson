<h2>historique des achats </h2>

<p class="search">
  <label>Recherche client</label>
  <select>
    <option value="all">--</option>
  </select>
</p>
<table id='factures'>
  <thead>
    <th>clients</th>
    <th>tel</th>
    <th>boisson</th>
    <th>catégorie</th>
    <th>quantite</th>
    <th>prix U.</th>
    <th>prix net</th>
    <th>payer</th>
    <th>reste</th>
    <th>dette</th>
    <th>date</th>
    <th>heure</th>
    <th>imprimer</th>
  </thead>
</table>

<?php

require_once('../php/database.php');
require_once('../php/utils.php');

$factures = fetch_all($db->query("SELECT * FROM factures"));
$clients = fetch_all($db->query("SELECT * FROM clients"));
$boissons = fetch_all($db->query("SELECT boissons.id,boissons.nom,prix_unitaire, fournisseurs.categorie FROM boissons LEFT JOIN fournisseurs ON boissons.categorie = fournisseurs.id"));

$factures = json_encode($factures);
$clients = json_encode($clients);
$boissons = json_encode($boissons);


echo "
<script>
var Boissons = $boissons;
var Clients = $clients;
var Factures = $factures;
</script>
";

?>
