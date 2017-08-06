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
            $arts = $this->model->articles_arraytable();
            $this->view->tableArray($arts);
            break;
          case "article":
            if (filter_input(INPUT_GET, 'id') > 0) {
              $art = $this->model->article(filter_input(INPUT_GET,'id'));
              if (filter_input(INPUT_GET, 'action') == "edit") {
                $check = $this->model->fp_articleedit();
                switch($check) {
                  case 0:
                    $this->view->article_editForm($art);
                    break;
                  case 1:
                    $art = $this->model->article(filter_input(INPUT_GET,'id'));
                    $this->view->article($art);
                    break;
                  default:
                    $this->view->article_editForm($check['warning']);
                }
              }
              elseif (filter_input(INPUT_GET, 'action') == "delete") {
                $check = $this->model->fp_articledelete();
                switch($check) {
                  case 0:
                    $this->view->article_deleteForm($art);
                    break;
                  case 1:
                    $arts = $this->model->articles_all();
                    $this->view->articlesList($arts);
                    break;
                  default:
                    $this->view->article_deleteForm($check['warning']);
                }
              }
              else {                
                $this->view->article($art);              
              }
            }
            else {
              if (filter_input(INPUT_GET, 'action') == "new") {
                $check = $this->model->fp_articleNew();
                switch($check) {
                  case 0:
                    $this->view->article_newForm();
                    break;
                  case 1:
                    $arts = $this->model->articles_all();
                    $this->view->articlesList($arts);
                    break;
                  default:
                    $this->view->article_newForm($check['warning']);
                }
              }
              else {
                $this->view->error('No ArticleID Set.');
              }
            }
            break;
          default: 
            //echo 'route1: '.$route1;
            $this->view->setBase('dashboard');
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
          //echo 0;
          $this->view->login();
          break;
        case 1:
          $this->view->front();
          break;
        default:
          //echo 'default'; 
          $warning = $check['warning'];
          $this->view->setWarning($warning);
          $this->view->login();
      }      
    }
  }

  
}

