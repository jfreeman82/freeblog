<?php

/* 
 * Controller.php
 */

class Controller {

  private $model;
  private $view;
   
  public function __construct() {
    $this->model = new Model();
    $this->view = new View();
  }

  public function invoke() {
    
    if (filter_input(INPUT_GET, 'page')) {
      $page = filter_input(INPUT_GET, 'page');
      switch ($page) {
        case "articles":
          if (filter_input(INPUT_GET, 'id')) {
            $aid = filter_input(INPUT_GET, 'id');
            $art_data = $this->model->article($aid);
            $this->view->article($art_data);
          }
          else {
            $art_data = $this->model->articles_all();
            $this->view->articles($arts);
          }
          break;
        default: 
          $arts = $this->model->articles_lastx(5);
          $this->view->articles($arts);
      }
    }
    else {
          $arts = $this->model->articles_lastx(5);
      $this->view->front($arts);
      
    }
  }

}

