<?php
class Todo{
    
    private $db;

    function __construct($DB_CON){
      $this->db = $DB_CON;
    }

    function getAll(){
      $query = "SELECT id, todo, completed, created FROM todo";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      
      $num_row = $stmt->rowCount();

      // display each returned rows
      $list = "";
      while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($result);

        $todo = ($completed == 1) ? "<strike>{$todo}</strike>" : $todo;

        $list .= <<<HTML
          <li class="list-group-item d-flex justify-content-between lh-condensed">
            <div>
              <h6 class="my-0">{$todo}</h6>
              <small class="text-muted">{$created}</small>
            </div>
            <span class="text-muted">$12</span>
          </li>
HTML;
      }

      $data = array(
        'result' => $num_row,
        'data'   => $list
      );

      return $data;
    }

}