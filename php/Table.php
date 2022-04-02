<?php

class Table {
  
  protected $db;
  protected $table;
  protected $donnees;
  protected $keys;
  protected $id;
  
  public function __construct($db,$table,$id){
    $this->db = $db;
    $this->table = $table;
    $this->id = $id;
    $this->recuperer();
  }
  
  protected function recuperer(){
    $this->donnees = [];
    $reponse = $this->db->query("SELECT * FROM $this->table");
    while($row = $reponse->fetch(PDO::FETCH_ASSOC)){
      $this->donnees[] = $row;
    }
    $this->keys = array_keys($row);
  }
  
  protected function existe($donnees){
    for ($i = 0; $i < count($this->donnees); $i++) {
       if($this->donnees[$i][$id] == $donnees[$id]){
         return true;
       }
    }
    return false;
  }
  
  protected function keylist(){
    return join($this->keys,', ');
  }
  
  protected function keyparam($donnees){
    return join(array_map(function($key){ return ':'.$key;},array_keys($donnees)),',');
  }
  
  protected function keyparam_value(){
    return join(array_map(function($key){ return "$key = :$key";},array_keys($this->donnees[0])),',');
  }
  
  protected function ajouter($donnees){
    if($this->existe($donnees)) return false;
    $reponse = $this->db->prepare("INSERT INTO $this->table (".$this->keylist().") VALUES(".$this->keyparam($donnees).")");
    $reponse->execute($donnees);
    $this->recupere();
  }
  
  protected function syntroniser(){
    for ($i = 0; $i < count($this->donnees); $i++) {
      $response = $this->db->prepare("UPDATE $this->table SET ".$this->keyparam_value()." WHERE $this->id = :$this->id");
      $response->execute($this->donnees[$i]);
    }
  }
  
}


print_r(array_map(function ($a){
  return -1*$a;
},array(6,7,8,9)));