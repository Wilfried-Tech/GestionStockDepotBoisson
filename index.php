<?php
  session_start();
  if (!isset($_SESSION['connecter'])) {
    $_SESSION['connecter'] = false;
    $_SESSION['errors'] = array();
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <!-- Responsive Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta name="theme-color" content="indigo" />
  <!-- <meta http-equiv="refresh" content="1">-->

  <!-- Page Informations -->
  <meta property="og:title" content="Wilfried-Tech">
  <meta name="author" content="Wilfried-Tech" />
  <meta property="og:image" content="assets/images/favicon/favicon.png">
  <meta property="og:description" content="Plateforme de Gestion de Stock d'un dépôt de boissons">
  <meta name="description" content="Plateforme de Gestion de Stock d'un dépôt de boissons" />
  <meta name="keywords" content="Depot, boisson, Gestion Stock" />

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="icon" type="icon" href="assets/images/favicon/favicon.png">

  <title>Depot de Paul | Gestion de Stock | Depot Boissons</title>
</head>

<body>
  <div class="container">
    <section>
      <form action="php/connexion.php" method="post">
        <p class="errors">
          <?php
            if(isset($_SESSION['errors']['login'])){
              echo $_SESSION['errors']['login'];
            }
          ?>
        </p>
        <p>
          <label for="login">statut</label>
          <select name="login" id="login">
            <option value="admin">admin</option>
            <option value="secretaire">secrétaire</option>
            <option value="caissier">caissier(e)</option>
          </select>
        </p>
        <p>
          <label for="password">mot de passe</label>
          <input required type="password" name="password" id="password" placeholder="Votre mot de passe" />
        </p>
        <p>
          <input type="submit" value="se connecter">
        </p>
      </form>
    </section>
  </div>
  <!-- JavaScript -->
  <script type="text/javascript" src="js/main.js"></script>
</body>

</html>
