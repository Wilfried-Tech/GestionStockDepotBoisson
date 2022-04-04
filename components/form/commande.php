<form method="post" action="../php/form-action/commande.php">
  <h2>bon de commande</h2>
  <input type="hidden" name="action" value="ajouter" />
  <p>
    <label>nom boisson</label>
    <select name="nom" required >
      <?php
        require_once('../php/database.php');
        require_once('../php/Table.php');
        
        $boisson = new Table($db,'Boissons','nom');
        
        $rows = $boisson->recuperer();
        
        if (count($rows)) {
          foreach ($rows as $value) {
            echo "<option value='".$value['nom']."'>".$value['nom']."</option>";
          }
        }
        
      ?>
    </select>
  </p>
  <p><input type="number" name="qte" placeholder="quantité" min="1" required></p>
  <p>
    <label>fournisseur</label>
    <select name="fournisseur" required >
      <?php
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
