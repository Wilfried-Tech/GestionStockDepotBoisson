<?php
function check_response(array $names) {
  foreach ($names as $key => $name) {
    $err = isset($_SESSION['erreurs'][$name])?$_SESSION['erreurs'][$name]:"";
    $result = isset($_SESSION['reponse'][$name])?$_SESSION['reponse'][$name]:"";
    if (!empty($result)||!empty($err)) {
      $_SESSION['response'][$name] = "";
      $_SESSION['erreurs'][$name] = "";
      ob_start();
      $received = empty($err)? 'success' : 'error';
      echo "<div class='alert alert-$received' onclick='this.remove()'>";
      echo $received == 'error'? $err : $result;
      echo "</div>";
      echo "<script>initSection($key)</script>";
      return ob_get_clean();
    }
  }
}

function isset_all(array $variable, array $names){
  foreach ($names as $name) {
    if(!isset($variable[$name])){
      return false;
    }
  }
  return true;
}

function fetch_all($res){
  $rows = [];
  while($row = $res->fetch(PDO::FETCH_ASSOC)) $rows[] = $row;
  return $rows;
}

?>
