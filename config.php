<?php

  // Include class
  include_once('Classes/Todo.php');

  $user = 'root';
  $password = '';
  $host = 'localhost';
  $db_name = 'phptodolist';

  // connect to database
  try {
    $db = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);
  }catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    exit;
  }

  $todo = new Todo($db);

?>