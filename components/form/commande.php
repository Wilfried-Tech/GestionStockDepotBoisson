<form class="commandes">
  <h2>bon de commande</h2>
  <p><input type="text" name="nom" placeholder="nom Boisson" required></p>
  <p><input type="number" name="p_unit" placeholder="prix unitaire" min="1" required></p>
  <p><input type="number" name="qte" placeholder="quantité" min="1" required></p>
  <p><input type="number" name="min" placeholder="nombre niminal" min="0" required></p>
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
            echo "<option name='".$value['id']."'>".$value['nom']."</option>";
          }
        }
        
      ?>
    </select>
  </p>
  <p><input type="submit"></p>
</form>
