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
    
    if (isset($this->routes[0]) && $this->routes[0] != "") {
      $route1 = $this->routes[0];
      switch ($route1) {
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
          echo 'route1: '.$route1;
          $arts = $this->model->articles_lastx(5);
          $this->view->articles($arts);
      }
    }
    else {
          $arts = $this->model->articles_lastx(5);
      $this->view->front($arts);
      
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

