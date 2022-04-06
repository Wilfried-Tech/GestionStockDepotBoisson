<?php
require_once("../php/database.php");
require_once("../php/utils.php");

$boissons = fetch_all($db->query("SELECT * FROM boissons"));
$clients = fetch_all($db->query("SELECT * FROM clients"));

?>

<form action="../php/form-action/commandeclient.php" method="post">
  <h2>Commande client</h2>
  <p>
    <label>boisson</label>
    <select name="boisson" required>
      <?php
        foreach ($boissons as $value) {
          echo "<option value='".$value['id']."'>".$value['nom']."</option>";
        }
      ?>
    </select>
  </p>
  <p><input type="number" name="quantite" placeholder="quantité" required></p>
  <p><input type="number" name="payer" placeholder="prix client" required></p>
  <p>
    <label>client</label>
    <select name="client" required>
      <?php
        foreach ($clients as $value) {
          echo "<option value='".$value['tel']."'>".$value['nom']."</option>";
        }
      ?>
    </select>
  </p>
  <p><input type="submit" value="acheter" ></p>
</form>
