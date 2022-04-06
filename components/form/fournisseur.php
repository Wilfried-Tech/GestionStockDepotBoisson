<?php require_once('../php/utils.php'); ?>

<form action="../php/form-action/fournisseur.php" method="post" >
  <h2>fournisseur</h2>
  <p><input type="text" name="nom" placeholder="nom du fournisseur" required></p>
  <p><input type="tel" name="tel" placeholder="telephone" required></p>
  <p><input type="text" name="categorie" placeholder="categorie de produits" required></p>
  <p><input type="submit" value="Enregistrer"></p>
</form>
