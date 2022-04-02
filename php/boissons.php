<?php

require_once('Table.php');

class Boissons extends Table{
  
  public function __construct($db,$table)
  {
    parent::__construct($db,$table,'nom');
    
  }
  
  
}
