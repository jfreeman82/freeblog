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
    if (filter_input(INPUT_GET,'action') == "logout") {
      logout();
    }
    
    
    if (isLoggedIn()) {
    
      if (filter_input(INPUT_GET,'page')) {
        $page = filter_input(INPUT_GET, 'page');
        switch ($page) {
          case "articles":
            $arts = $this->model->articles_all();
            $this->view->articlesList($arts);
            break;
          case "article":
            if (filter_input(INPUT_GET, 'id') > 0) {
              $art = $this->model->article(filter_input(INPUT_GET,'id'));
              if (filter_input(INPUT_GET, 'action') == "edit") {
                $this->view->article_edit($art);
              }
              else {                
                $this->view->article($art);              
              }
            }
            else {
              $this->view->error('No ArticleID Set.');
            }
            break;
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
          $this->view->dashboard();
          break;
        default:
          echo 'default'; 
          $warning = $check['warning'];
          $this->view->login($warning);
      }      
    }
  }

  
}

