<?php

class Todo{
    private $db;
    private $id = null;
    private $status = null;
    private $item_for_page = 4;

    function __construct($DB_CON){
      $this->db = $DB_CON;
    }

    private function getIdCollecton($arr){
      $collection = array();
      foreach($arr AS $key=>$value){
        $collection[':id'.$key] = $value;
      }
      return $collection;
    }

    public function setId($id){
      $this->id = $id;
    }

    public function getId(){
      return $this->id;
    }

    public function setStatus($status){
      $this->status = $status;
    }

    public function getStatus(){
      return $this->status;
    }

    public function getAll(){
      
      $paging = new Paginate($this->db, $this->item_for_page);
      
      try {
        
        $stmt = $paging->Execute("SELECT id, todo, completed, created FROM todo ORDER BY created DESC");
        
        // display each returned rows
        $list = "";
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($result);
          
          if( $completed == 1) {
            $todo = "<strike>{$todo}</strike>";
            $action = "<a class=\"btn btn-link\" href=\"?id={$id}&std=0\"><i class=\"fas fa-check-circle fa-lg\"></i></a>";
          }else{
            $action = "<a class=\"btn btn-link\" href=\"?id={$id}&std=1\"><i class=\"far fa-check-circle fa-lg\"></i></a>";
          }

          $list .= <<<HTML
            <li class="list-group-item d-flex justify-content-between lh-condensed align-items-center">
              <div>
                <div class="form-check">
                  <input class="form-check-input checkAllBoxes" type="checkbox" name="checkboxArrTodo[]" value="{$id}">
                  <label class="form-check-label">
                    <h6 class="my-0">{$todo}</h6>
                    <small class="text-muted">{$created}</small>
                  </label>
                </div>
              </div>
              <div>
                {$action}
                <a class="btn btn-link" href="?id={$id}&delete"><i class="far fa-trash-alt fa-lg"></i></a>
              </div>
            </li>
HTML;
        }

        if($list != ''){
          $list .= <<<HTML
            <li class="list-group-item d-flex justify-content-between lh-condensed align-items-center list-group-item-secondary">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="selectAllBoxes">
                <label class="form-check-label" for="selectAllBoxes">Select All</label>
              </div>
              <div class="checkAction" style="display:none;">
                <button type="submit" class="btn btn-link" name="std" value="1"><i class="fas fa-check-circle fa-lg"></i></button>
                <button type="submit" class="btn btn-link" name="std" value="0"><i class="far fa-check-circle fa-lg"></i></button>
                <button type="submit" class="btn btn-link" name="delete"><i class="far fa-trash-alt fa-lg"></i></button>
              </div>
            </li>
HTML;
        }

        $html = <<<HTML
          <div class="mb-3">
            <form method="POST">
              <ul>
                {$list}
              </ul>
            </form>
          </div>
HTML;

        $html .= $paging->getPagingLink();
        
        return $html;

      }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        exit;
      }
    }
    
    public function addTodo($data){
      try{
        $query = "INSERT INTO todo (todo) VALUES(:todo)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':todo',$data);
        $stmt->execute();
        return true;
      }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        return false;
      }
    }

    public function deleteTodo(){
      try{
        if(is_array($this->id)){
          
          $idCollection = $this->getIdCollecton($this->id);

          $query = "DELETE FROM todo WHERE id IN (" . implode(',', array_keys($idCollection)) . ")";
          $stmt = $this->db->prepare($query);
          
          foreach($idCollection as $key=>&$value){//bindParam ha bisogno che il valore venga passato per referenza
            $stmt->bindParam($key,$value);  
          }

          $stmt->execute();

        }else{
          $query = "DELETE FROM todo WHERE id = ?";
          $stmt = $this->db->prepare($query);
          $stmt->bindParam(1,$this->id);
          $stmt->execute();
        }
        return true;
      }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        return false;
      }
    }

    public function updateTodo(){
      try{
        if(is_array($this->id)){

          $idCollection = $this->getIdCollecton($this->id);
          
          $query = "UPDATE todo SET completed = :status WHERE id IN (" . implode(',', array_keys($idCollection)) . ")";
          $stmt = $this->db->prepare($query);
          $stmt->bindParam(':status',$this->status);
          
          foreach($idCollection as $key=>&$value){//bindParam ha bisogno che il valore venga passato per referenza
            $stmt->bindParam($key,$value);  
          }
          $stmt->execute();
          
        }else{
          $query = "UPDATE todo SET completed = :status WHERE id = :id";
          $stmt = $this->db->prepare($query);
          $stmt->bindParam(':status',$this->status);
          $stmt->bindParam(':id',$this->id);
          $stmt->execute();
        }
        return true;
      }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        return false;
      }
    }

}