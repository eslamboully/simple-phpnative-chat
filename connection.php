<?php

  try {
      $db = new PDO('mysql:host=localhost;dbname=native_chat', 'root', '');

  } catch (PDOException $e) {
      print "Error!: " . $e->getMessage() . "<br/>";
      die();
  }


 ?>
