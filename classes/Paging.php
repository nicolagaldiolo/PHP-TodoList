<?php

class Paginate{
  private $db;
  private $items = 5;

  function __construct($DB_CON){
    $this->db = $DB_CON;
  }

  public function pagingLink(){
    try {

      $query = "SELECT id, todo, completed, created FROM todo ORDER BY created DESC";
      $stmt = $this->db->prepare($query);
      $stmt->execute();
      $num_row = $stmt->rowCount();

      $pager_count = ceil($num_row / $item_for_page);

      if($pager_count > 1){
        $item_page = "";
        for($i=1; $i<=$pager_count; $i++){
          $active = ( (!isset($page_current) && $i==1) || (isset($page_current) && $page_current == $i)) ? " active" : "";
          $item_page .= "<li class=\"page-item{$active}\"><a class=\"page-link\" href=\"/{$i}/\">{$i}</a></li>";
        }

        $html = <<<HTML
          <div class="mb-3">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                {$item_page}
                <!--<li class="page-item"><a class="page-link" href="#">Next</a></li>-->
              </ul>
            </nav>
          </div>
HTML;
      }

      return $html;
      
    }catch(PDOExeption $e){
      echo "Error: " . $e->getMessage();
      return false;
    }

  }

}

?>