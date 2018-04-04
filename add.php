<?php
  include 'config.php';

  if(isset($_POST['todo'])){
    $todo_data = addslashes(trim($_POST['todo']));

    $todo->addTodo($todo_data);
  }

  header("Location: /");
?>