<?php

class Paginate{
  private $db;
  private $items = 5;
  private $page_current = 1;
  private $filter_by_page = 0;
  private $page_count = 0;
  private $query = "";

  function __construct($DB_CON, $items){
    $this->db = $DB_CON;
    $this->items = $items;

    if(isset($_GET['page']) && intval($_GET['page']) > 0){
      $this->page_current = intval($_GET['page']);
      $this->filter_by_page = ($this->page_current * $this->items) - $this->items;
    }
  }

  public function Execute($sql){
    $this->query = $sql;
    $sqlExecute = $this->query . " LIMIT {$this->filter_by_page}, {$this->items}";
    $stmt = $this->db->prepare($sqlExecute);
    $stmt->execute();
    return $stmt;

  }

  public function getPagingLink(){
    try {
      $html = "";
      $stmt = $this->db->prepare($this->query);
      $stmt->execute();
      $num_row = $stmt->rowCount();

      $this->page_count = ceil($num_row / $this->items);
      
      if($this->page_count > 1){
        $item_page = "";
        $prev_page = $this->page_current - 1;
        $next_page = $this->page_current + 1;
        $prev_link = ($prev_page > 0) ? "<li class=\"page-item\"><a class=\"page-link\" href=\"/{$prev_page}/\">«</a></li>" : '';
        $next_link = ($next_page <= $this->page_count) ? "<li class=\"page-item\"><a class=\"page-link\" href=\"/{$next_page}/\">»</a></li>" : '';
        
        $item_page .= $prev_link;
        for($i=1; $i<=$this->page_count; $i++){
          if( $i >= ($this->page_current -3 ) && $i <= ($this->page_current +3 )){
            $active = ($this->page_current == $i) ? " active" : "";
            $item_page .= "<li class=\"page-item{$active}\"><a class=\"page-link\" href=\"/{$i}/\">{$i}</a></li>";
          }
        }
        $item_page .= $next_link;

        $html = <<<HTML
          <div class="mb-3">
            <nav aria-label="Page navigation example" class="justify-content-between">
              <div class="row justify-content-between">
                <div class="col-auto mr-auto">
                  <ul class="pagination">
                    {$item_page}
                  </ul>
                </div>
                <div class="col-auto">
                  <small>Page {$this->page_current} of {$this->page_count}</small>
                </div>
              </div>
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