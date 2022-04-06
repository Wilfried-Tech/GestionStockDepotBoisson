<header id="main-header">
  <div id="menu">
    <div id="menu-line"></div>
  </div>
  <nav class="nav-bar">
    <h1 class="nav-title v-center"><?= $_SESSION['utilisateur'] ?></h1>
  </nav>
  <aside id="nav-menu">
    <header id="nav-menu-header">
      <img src="../assets/images/logo.png" alt="favicon">
      <h1 class="nav-menu-title v-center">Depot Wamba Paul</h1>
    </header>
    <article id="nav-menu-items">
      <?php
        if(isset($headerItems)) {
          $headerItems['deconnexion'] = ["mdi","exit-run"];
          foreach ($headerItems as $label => $info) {
            $icon = '';
            if($info[0]=='mi') $icon = "<i class='material-icons'>$info[1]</i>";
            else $icon = "<i class='$info[0] ".($info[0]=='mdi'? 'mdi' : 'fa')."-$info[1]'></i>";
            echo "<div class='nav-menu-item'><span class='nav-menu-item-icon'>$icon</span><a>$label</a></div>";
          }
        }
      ?>
    </article>
  </aside>
</header>
