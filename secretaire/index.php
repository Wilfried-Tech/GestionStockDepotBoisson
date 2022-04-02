<?php
  require_once('../php/redirection.php');
  require_once('../php/database.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <!-- Responsive Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="theme-color" content="#3f51b5" />
  <!-- <meta http-equiv="refresh" content="1">-->

  <!-- Page Informations -->
  <meta property="og:title" content="Wilfried-Tech">
  <meta name="author" content="Wilfried-Tech" />
  <meta property="og:image" content="assets/images/favicon/favicon.png">
  <meta property="og:description" content="">
  <meta name="description" content="" />
  <meta name="keywords" content="" />

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="icon" type="icon" href="assets/images/favicon/favicon.png">
  <!-- JavaScript -->
  <script src="../libs/eruda.min.js"></script>
  <script>
    eruda.init();
    eruda.get().config.set('displaySize', 60);
    eruda.remove('info');
    eruda.remove('sources');
    eruda.remove('snippets');
    eruda.remove('settings');
  </script>
  <title>Secrétaire | Depot Wamba Paul | Gestion Stock Depot Boissons</title>
</head>

<body>
  <div class="container">
    <?php
      $headerItems = array(
        'gerer le bon de commande' => ['mi','add_shopping_cart']
       );
      include_once('../components/header.php');
    ?>
    <section class="container-inner">
      
    </section>
  </div>
  <!-- JavaScript -->
  <script type="text/javascript" src="../js/setup.js"></script>
  <script type="text/javascript" src="js/main.js"></script>
</body>

</html>
