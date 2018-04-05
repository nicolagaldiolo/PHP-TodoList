<?php
class Todo{
    
    private $db;
    protected $id = null;
    protected $status = null;

    function __construct($DB_CON){
      $this->db = $DB_CON;
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
      
      $item_for_page = 3;
      $pager_count = $filter_page = 0;
      
      try {
        $query = "SELECT id, todo, completed, created FROM todo ORDER BY created DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $num_row = $stmt->rowCount();

        
        $pager_count = ceil($num_row / $item_for_page);

        //echo '<hr>';

        //echo 'Elementi per pagina: ' , var_dump($item_for_page), '<br>';
        echo 'Pagine totali: ' , var_dump($pager_count), '<br>';

        $filter_page = 0;
        if(isset($_GET['page']) && $_GET['page'] > 0){
          $page_current = intval($_GET['page']);
          $filter_page = ($page_current * $item_for_page) - $item_for_page;
        }

        $query = "SELECT id, todo, completed, created FROM todo ORDER BY created DESC LIMIT {$filter_page}, {$item_for_page}";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        
        function createPath($params){
          $current_url = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
          if($_SERVER['QUERY_STRING']){
            $concat_prm = "&";
          }else{
            $concat_prm = "?";
          }
          
          return "http://" . $current_url . $concat_prm . $params;
        }


        // display each returned rows
        $list = "";
        while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($result);
          
          if( $completed == 1) {
            $todo = "<strike>{$todo}</strike>";
            $action = "<a class=\"btn btn-link\" href=\"/?id={$id}&std=0\"><i class=\"fas fa-check-circle fa-lg\"></i></a>";
          }else{
            $action = "<a class=\"btn btn-link\" href=\"/?id={$id}&std=1\"><i class=\"far fa-check-circle fa-lg\"></i></a>";
          }

          $deletePath = createPath("id=" . $id . "&delete");
          

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
                <a class="btn btn-link" href="{$deletePath}"><i class="far fa-trash-alt fa-lg"></i></a>
              </div>
            </li>
HTML;
        }

        $html = <<<HTML
          <form method="POST">
            <ul>
              {$list}
              <li class="list-group-item d-flex justify-content-between lh-condensed align-items-center list-group-item-secondary">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="selectAllBoxes">
                  <label class="form-check-label" for="selectAllBoxes">Seleziona tutti</label>
                </div>
                <div class="checkAction" style="display:none;">
                  <button type="submit" class="btn btn-link" name="std" value="1"><i class="fas fa-check-circle fa-lg"></i></button>
                  <button type="submit" class="btn btn-link" name="std" value="0"><i class="far fa-check-circle fa-lg"></i></button>
                  <button type="submit" class="btn btn-link" name="delete"><i class="far fa-trash-alt fa-lg"></i></button>
                </div>
              </li>
            </ul>
          </form>
HTML;
        if($pager_count > 1){
          $item_page = "";
          for($i=1; $i<=$pager_count; $i++){
            $item_page .= "<li class=\"\"><a href=\"?page={$i}\">{$i}</a></li>";
          }

          $html .= <<<HTML
          <nav aria-label="Page navigation example">
                <ul class="pagination">
                  
                  {$item_page}
                  <!--<li class="page-item"><a class="page-link" href="#">Next</a></li>-->
                </ul>
              </nav>
HTML;
        }

        /*
        <% for ( int i = 1; i <= nPage; i++ ) { 
								if ( Math.abs(aPage - i) < 3 ){
								%>
								<li<% if (aPage == i) { %> class="active"<% } %>><a href="<%= url %><%= i %>"><%= i %></a></li>
							<% }
              } %>
              */

        $data = array(
          'result' => $num_row,
          'data'   => $html
        );

        return $data;

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
          $query = "DELETE FROM todo WHERE id IN (" . implode(',', $this->id) . ")";
          $stmt = $this->db->prepare($query);
          $stmt->execute();
        }else{
          $query = "DELETE FROM todo WHERE id = :id";
          $stmt = $this->db->prepare($query);
          $stmt->bindParam(':id',$this->id);
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
          $query = "UPDATE todo SET completed = {$this->status} WHERE id IN (" . implode(',', $this->id) . ")";
          $stmt = $this->db->prepare($query);
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