<?php
  include 'config.php';
  
  //echo var_dump($_GET);

  /* Ricevo via GET il singolo ID da aggiornare */
  if(isset($_GET['id'])){
    $todo_id = intval($_GET['id']);
    $todo->setId($todo_id);
  }

  if(isset($_GET['delete'])){
    $todo->deleteTodo();
  }

  if(isset($_GET['std'])){
    $todo_status = intval($_GET['std']);
    $todo->setStatus($todo_status);
    $todo->updateTodo();
  }

  /* Ricevo via POST una collezione di ID da aggiornare */
  if(isset($_POST['checkboxArrTodo'])){
    $todo_id = array_map('intvalFunction', $_POST['checkboxArrTodo']);
    $todo->setId($todo_id);
  }

  if(isset($_POST['std'])){
    $todo_status = intval($_POST['std']);
    $todo->setStatus($todo_status);
    $todo->updateTodo();
  }

  if(isset($_POST['delete'])){
    $todo->deleteTodo();
  }

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="https://getbootstrap.com/favicon.ico">

    <title>PHP-TodoList</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/style.css">
  
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h2>PHP-TodoList</h2>
        <p class="lead">PHP-TodoList in Object Orientied Programming</p>
      </div>

      <div class="row">
        <div class="col-md-12 mb-4">
          <?php echo $todo->getAll(); ?>
          <!--<div class="mb-3">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
              </ul>
            </nav>
          </div>-->

          <form action="/add.php" class="card p-2" method="post">
            <div class="input-group">
              <input type="text" class="form-control" name="todo" placeholder="Add new todo">
              <div class="input-group-append">
                <button type="submit" class="btn btn-secondary">Aggiungi</button>
              </div>
            </div>
          </form>

        </div>
      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="script.js"></script>
  </body>
</html>
