<?php
require_once("../php/database.php");
require_once("../php/utils.php");

$boissons = fetch_all($db->query("SELECT commandes.boisson, fournisseurs.categorie FROM commandes INNER JOIN fournisseurs ON fournisseur = fournisseurs.id")); 
?>

<form action="../php/form-action/livraison.php" method="post">
  <p>
    <label>boisson</label>
    <select name="boisson" required>
      <?php
        foreach ($boissons as $produit) {
          echo "<option value='".$produit['boisson']."'>".$produit['boisson']."</option>";
        }
      ?>
    </select>
  </p>
  <p>
    <label>categorie</label>
        <select name="categorie" required>
          <?php
            foreach ($boissons as $produit) {
              echo "<option value='".$produit['categorie']."'>".$produit['categorie']."</option>";
            }
          ?>
        </select>
  </p>
  <p><input type="number" name="quantite" placeholder="quantitée" min="0" required></p>
  <p><input type="number" name="prix_unit" placeholder="prix unitaire" min="0" required></p>
  <p><input type="number" name="minimum" placeholder="minimum" min="0" required></p>
  <p><input type="number" name="litre" placeholder="capacité (cl)" min="0" required></p>
  <p><input type="submit" value="Envoyer"></p>
</form>
