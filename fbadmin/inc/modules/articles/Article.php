<?php

/**
 * Description of Article
 *
 * @author myrmidex
 */
class Article {

  private $id;
  private $title;
  private $article;
  private $gendate;
  private $uid;
  
  public function __construct($id) {
    $sql = "SELECT title,article,gendate,uid 
            FROM articles 
            WHERE id = '$id';";
    global $dbc;
    $q = $dbc->query($sql) or die("ERROR Article - ".$dbc->error());
    if ($q->num_rows == 0) { die("Article does not exist.");}
    $row = $q->fetch_assoc();
    $this->id = $id;
    $this->title = $row['title'];
    $this->article = $row['article'];
    $this->gendate = $row['gendate'];
    $this->uid = $row['uid'];
  }
  
  public function getTitle() {
    return $this->title;
  }
  public function getArticle() {
    return $this->article;
  }
  public function getGenDate() {
    return $this->gendate;
  }
  public function getUid() {
    return $this->uid;
  }
  public function getUser() {
    return new User($this->uid);
  }
  
  public function dataArray() {
    return array(
        'id'      => $this->id,
        'title'   => $this->title,
        'article' => $this->article,
        'gendate' => $this->gendate,
        'uid'     => $this->uid,
        'username' => $this->getUser()->getUsername()
    );
  }
}