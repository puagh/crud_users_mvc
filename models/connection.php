<?php
  class Connection{
    public function connect(){
      $link = new PDO("mysql:host=localhost;dbname=cursophp1", "root", "");
      return $link;
    }
  }
?>
