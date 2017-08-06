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
        case "article":
          if (isset($this->routes[1])) {
            $aid = $this->routes[1];
            $art_data = $this->model->article($aid);
            $this->view->article($art_data);
          }
          else {
            $this->view->warning('No AID set.');
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

