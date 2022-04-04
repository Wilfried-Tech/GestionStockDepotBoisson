<form action="../php/form-action/boisson.php" method="post">
  <h2>Boissons</h2>
  <input type="hidden" name="action" value="ajouter" />
  <p><input type="text" name="nom" placeholder="nom de la boisson" required></p>
  <p><input type="number" name="prix_unit" placeholder="prix unitaire" min="0" required></p>
  <p><input type="number" name="min" placeholder="quantite minimale" min="0" required></p>
  <p>
    <label>fournisseur</label>
    <select name="fournisseur" required >
      <?php
        require_once('../php/database.php');
        require_once('../php/Table.php');
        
        $Fournisseurs = new Table($db,'Fournisseurs','id');
        
        $rows = $Fournisseurs->recuperer();
        
        if (count($rows)) {
          foreach ($rows as $value) {
            echo "<option value='".$value['id']."'>".$value['nom']."</option>";
          }
        }
        
      ?>
    </select>
  </p>
  <p><input type="submit"></p>
</form>
