<?php

/**
 * Description of Model
 *
 * @author myrmidex
 */
class Model {

  public function __construct() {}
  
  public function articles_all() {
    global $dbc;
    $sql = "SELECT id FROM articles ORDER BY gendate,title DESC;";
    $q = $dbc->query($sql) or die("ERROR Model - ".$dbc->error());
    $out = array();
    while ($row = $q->fetch_assoc()) {
      array_push($out, $this->article($row['id']));
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
      $email = filter_input(INPUT_POST, 'lf_email');
      $password = hash('sha256',filter_input(INPUT_POST, 'lf_password'));
      $sql = "SELECT id FROM users WHERE email = '$email' AND password = '$password';";
      global $dbc;
      $q = $dbc->query($sql) or die("ERROR Model / fp_login - ".$dbc->error());
      if ($q->num_rows == 0) {
        return array('warning' => 'Username: '.$email.' / Password ('.$password.') combination not found.');
      }
      else {
        $uid = $q->fetch_assoc()['id'];
        $_SESSION['uid'] = $uid;
        return 1;
      }
    }
    else {
      return 0;
    }
  }
  
  public function fp_articleNew() {
    if (filter_input(INPUT_POST, 'anform') == "go") {
      $title = filter_input(INPUT_POST, 'an_title');
      $article = filter_input(INPUT_POST, 'an_article');
      if ($title == "" || $article == "") { return array('warning' => 'Some fields were empty.');}
      $uid = $_SESSION['uid'];
      $sql = "INSERT INTO articles (title,article,uid,gendate) VALUES ('$title','$article','$uid',NOW());";
      global $dbc;
      if ($dbc->query($sql)) {
        return 1;
      }
      else {
        return array('warning' => $dbc->error());
      }      
    }
    else {
      return 0;
    }
  }
  public function fp_articleEdit() {
    if (filter_input(INPUT_POST, 'aeform') == "go") {
      if (!filter_input(INPUT_GET, 'id')) { return array('warning' => 'ArticleID missing.'); }
      $aid = filter_input(INPUT_GET, 'id');
      $title = filter_input(INPUT_POST, 'ae_title');
      $article = filter_input(INPUT_POST, 'ae_article');
      if ($title == "" || $article == "") {return array('warning' => 'Some fields were empty.');}
      $sql = "UPDATE articles  SET title = '$title', article = '$article'
              WHERE id = '$aid';";
      global $dbc;
      if ($dbc->query($sql)) {
        return 1;
      }
      else {
        return array('warning' => $dbc->error());
      }
    }
    else {
      return 0;
    }
  }
  public function fp_articleDelete() {
    if (filter_input(INPUT_POST, 'adform') == "go") {
      if (!filter_input(INPUT_GET, 'id')) { return array('warning' => 'articleID missing.'); }
      $aid = filter_input(INPUT_GET, 'id');
      $sql = "DELETE FROM articles WHERE id = '$aid';";
      global $dbc;
      if ($dbc->query($sql)) {
        return 1;
      }
      else {
        return array('warning' => $dbc->error());
      }
    }
    else {
      return 0;
    }
  }
  
  
}
