<?php

/**
 * Description of Model
 *
 * @author myrmidex
 */
class Model {

  public function __construct() {}
  
  public function articles_lastx($x) {
    global $dbc;
    $sql = "SELECT id FROM articles ORDER BY gendate,title DESC LIMIT $x ;";
    $q = $dbc->query($sql) or die("ERROR Model - ".$dbc->error());
    $out = array();
    while ($row = $q->fetch_assoc()) {
      $article = new Article($row['id']);
      //var_dump($article->dataArray());
      array_push($out, $article->dataArray());
    }    
    return $out;
  }
  
  public function article($aid) {
    $article = new Article($aid);
    return $article->dataArray();
  }
  
  /* FORM PROCESSORS */
  
  /* fp_login
   * 
   *  processes login form
   */
  public function fp_login() {
    if (filter_input(INPUT_POST, 'loginform') == "go") {
      $username = filter_input(INPUT_POST, 'lf_username');
      $password = filter_input(INPUT_POST, 'lf_password');
      return array('warning' => 'user & pass found.');
    }
    else {
      return 0;
    }
  }
  
}
