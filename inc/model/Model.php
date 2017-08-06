<?php

/**
 * Description of Model
 *
 * @author myrmidex
 */
class Model {

  private $dbc;
  
  public function __construct() {}
  
  private function dbConnect() {
    $this->dbc = new mysqli('localhost', MYSQL_USER, MYSQL_PASS, MYSQL_DB);
  }
  
  public function articles_lastx($x) {
    $this->dbConnect();
    $sql = "SELECT id,title,article,date_created FROM articles ORDER BY date_created DESC LIMIT '$x';";
    $q = $this->dbc->query($sql) or die("ERROR Model - ".$this->dbc->error());
    
  }
  
}
