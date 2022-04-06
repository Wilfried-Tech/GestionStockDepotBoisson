<form method="post" action="../php/form-action/commande.php">
  <h2>bon de commande</h2>
  <p><input type="text" name="boisson" placeholder="boisson" required></p>
  <p><input type="number" name="quantite" placeholder="quatitée" min="1" required></p>
  <p>
    <label>fournisseur</label>
    <select name="fournisseur" required >
      <?php
        require_once("../php/database.php");
        require_once("../php/utils.php");
        
        $response = $db->query("SELECT * FROM fournisseurs");
        $fournissers = fetch_all($response);
        foreach ($fournissers as $field) {
          echo "<option value='".$field['id']."'>".$field['nom']."</option>";
        }
      ?>
    </select>
  </p>
  <p><input type="submit"></p>
</form>
