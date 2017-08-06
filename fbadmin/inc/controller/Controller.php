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
    
      if (isset($this->routes[0]) && $this->routes[0] != "") {
        $route1 = $this->routes[0];
        switch ($route1) {
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

  /*
   * routes
   * 
   * returns url routes array, exploded by '/'
   */
  private function getCurrentUri() {
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) {
      $uri = substr($uri, 0, strpos($uri, '?'));
    }
    $uri = '/' . trim($uri, '/');
    return $uri;
  }

  private function routes() {
    $base_url = $this->getCurrentUri();
    $this->routes = array();
    $this->routes = explode('/', $base_url);
    foreach($this->routes as $route) {
      if(trim($route) != '') {
        array_push($this->routes, trim($route));
      }
    }
    array_pop($this->routes);
    if (in_array('index.php', $this->routes)) {
      array_pop($this->routes);
    }
  }
  
}

