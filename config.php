<?php

  // Include class
  include_once('classes/Todo.php');
  include_once('classes/Paging.php');
  include_once('utility/functions.php');

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