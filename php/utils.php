<?php
  function check_response(array $names){
   foreach ($names as $key => $name) {
    $err = $_SESSION['erreurs'][$name];
    $result = $_SESSION['response'][$name];
    if(!empty($result)||!empty($err)){
      $_SESSION['response'][$name] = "";
      $_SESSION['erreurs'][$name] = "";
      ob_start();
      $received = empty($err)? 'success' : 'error';
      echo "<div class='alert alert-$received' onclick='this.remove()'>";
      echo $received=='error'? $err : $result;
      echo "</div>";
      echo "<script>initSection($key)</script>";
      return ob_get_clean();
    }
  }
  }
?>
