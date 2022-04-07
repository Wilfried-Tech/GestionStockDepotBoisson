<?php
  require_once('redirection.php');
  require_once('database.php');
  require_once('utils.php');
  
  if(!isset($_GET['id'])){
    $_SESSION['erreurs']['facture'] = "";
    header('Location: ../'.$_SESSION['utilisateur']);
  }
?>
<?php
        $fact = fetch_all($db->query("SELECT * from factures WHERE id = ".$_GET['id']))[0];
        
        if(!$fact) {
          echo "facture indisponible !";
          exit;
        }
        
        $fact['client'] = fetch_all($db->query("SELECT * FROM clients WHERE tel = ".$fact['client']))[0];
        $fact['produit'] = fetch_all($db->query("SELECT boissons.*, fournisseurs.categorie as categorie FROM boissons LEFT JOIN fournisseurs ON boissons.categorie = fournisseurs.id WHERE boissons.id = ".$fact['produit']))[0];
      ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <!-- Responsive Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="theme-color" content="rgba( 0, 155, 200, 1.0)" />
  <!-- <meta http-equiv="refresh" content="1">-->
  <!-- Page Informations -->
  <meta property="og:title" content="Wilfried-Tech">
  <meta name="author" content="Wilfried-Tech" />
  <meta property="og:image" content="assets/images/favicon/favicon.png">
  <meta property="og:description" content="">
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="../css/print.css">
  <link rel="icon" type="icon" href="../assets/images/favicon/favicon.png">
  <!-- JavaScript -->
  <script src="../assets/fonts/icon/icons.js"></script>
  <script src="../libs/eruda.min.js"></script>
  <script>
    eruda.init();
    eruda.get().config.set('displaySize', 60);
    eruda.remove('info');
    eruda.remove('sources');
    eruda.remove('snippets');
    eruda.remove('settings');
  </script>
  <title>Facture | Depot Wamba Paul | Gestion Stock Depot Boissons</title>
</head>

<body>
  <div class="container">
    <section class="container-print">
      <p class="date"> Date: <?= preg_split("# \d+:#",preg_replace("#-#",' / ',$fact['date_achat']))[0] ?></p>
      <p class="img"><img src="../assets/images/favicon/favicon.png"></p>
      <p class="title"><h3>Depot wamba paul</h3></p>
      <div><div>nom client </div><div><?= $fact['client']['nom'] ?></div></div>
      <div><div>téléphone</div><div><?= $fact['client']['tel'] ?></div></div>
      <div><div>boisson</div><div><?= $fact['produit']['nom'] ?></div></div>
      <div><div>catégorie</div><div><?= $fact['produit']['categorie'] ?></div></div>
      <div><div>quantité</div><div><?= $fact['quantite'] ?></div></div>
      <div><div>prix unitaire</div><div><?= $fact['produit']['prix_unitaire'] ?></div></div>
      <div><div>total </div><div><?= $fact['produit']['prix_unitaire']*$fact["quantite"] ?></div></div>
      <div><div>payer</div><div><?= $fact['payer'] ?></div></div>
      <div><div>reste</div><div><?= $fact['reste'] ?></div></div>
      <div><div>dette</div><div><?= $fact['client']['dette'] ?></div></div>
    </section>
  </div>
  <!-- JavaScript -->
  <script type="text/javascript">
    print();
  </script>
</body>

</html>
