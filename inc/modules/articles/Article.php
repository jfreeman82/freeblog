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
  
  public function __construct($id) {
    $sql = "SELECT title,article,gendate 
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
  
  public function dataArray() {
    return array(
        'id' => $this->id,
        'title' => $this->title,
        'article' => $this->article,
        'gendate' => $this->gendate
    );
  }
}
