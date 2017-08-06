<?php

/* 
 * Controller.php
 */

class Controller {

  private $model;
  private $view;
  
  private $routes;
  
  public function __construct() {
    $this->model = new Model();
    $this->view = new View();
    $this->routes();
  }

  public function invoke() {
    
    if (isLoggedIn()) {
    
      if (filter_input(INPUT_GET,'page')) {
        $page = filter_input(INPUT_GET, 'page');
        switch ($page) {
          case "articles":
            $arts = $this->model->articles_all();
            $this->view->articles($arts);
          default: 
            //echo 'route1: '.$route1;
            $this->view->front();
        }
      }
      else {
        $arts = $this->model->articles_all();
        $this->view->front($arts);
      }
    }
    else {
      $check = $this->model->fp_login();
      switch($check) {
        case 0:
          echo 0;
          $this->view->login();
          break;
        case 1:
          echo 1;
          $this->view->home();
          break;
        default:
          echo 'default'; 
          $warning = $check['warning'];
          $this->view->login($warning);
      }      
    }
  }

  
}

