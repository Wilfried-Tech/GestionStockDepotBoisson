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
  <meta http-equiv="refresh" content="2">

  <!-- Page Informations -->
  <meta property="og:title" content="Wilfried-Tech">
  <meta name="author" content="Wilfried-Tech" />
  <meta property="og:image" content="assets/images/favicon/favicon.png">
  <meta property="og:description" content="Plateforme de Gestion de Stock d'un dépôt de boissons">
  <meta name="description" content="Plateforme de Gestion de Stock d'un dépôt de boissons" />
  <meta name="keywords" content="Depot, boisson, Gestion Stock" />

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/styleindex.css">
  <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
  <link rel="icon" type="icon" href="assets/images/favicon/favicon.png">

  <title>Connexion | Depot de Paul | Gestion de Stock | Depot Boissons</title>
</head>

<body>
  <div class="container">
  <svg class="p" width="100px" height="100px"></svg>
        <svg class="d" width="85px" height="85px"></svg>
        <svg class="t" width="60px" height="60px"></svg>
        <svg class="q" width="110px" height="110px"></svg>
        <header>
            <img id="logo" src="assets/images/logo.png">
            <h1>Dépot Wamba Paul</h1>
        </header>
        <section>
            <form action="login.php" method="post">
                <p class="champ"><img class="user" src="assets/images/user.png"><label for="login"></label><input type="text" id="login" name="nom"  class="ident" placeholder="Utilisateur" required></p>
                <p class="champ"><img class="mdp" src="assets/images/mdp.png"><label for="password"></label><input type="password" id="password" name="motdepasse" class="ident" placeholder="Mot de passe" required></p>
                <p><input id="btn" type="submit" value="Connexion" title="Accéder à mon interface"></p>
            </form>
        </section>
        <p class="slogan">Retrouvez vos meilleurs boissons rapidement et facilement !</p>
  </div>
  <!-- JavaScript -->
  <script type="text/javascript" src="js/main.js"></script>
</body>

</html>
<?php
            if(isset($_SESSION['errors']['login'])){
              echo $_SESSION['errors']['login'];
            }
          ?>