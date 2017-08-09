<?php
namespace freest\blog\mvc\controller;

use freest\blog\mvc\model\Model as Model;
use freest\blog\mvc\view\View as View;
use freest\router\Router as Router;

/* 
 * Controller.php
 */

class Controller 
{
    private $model;
    private $view;
    
    private $router;
   
    public function __construct() 
    {
        $this->model = new Model();
        $this->view = new View();
        
        $this->router = new Router();
        $this->router->route('',          '0');
        $this->router->route('index.php', '0');
        $this->router->route('articles',  '1');
        $this->router->route('admin',     '2');
    }

    public function invoke() 
    {
        switch ($this->router->get()) {
            case '0':
                //echo 0;
                //echo $this->router->get();
                $arts = $this->model->articles_lastx(5);
                $this->view->front($arts);
                break;
            case '1':
                //echo 1;
                /*
                if ($this->router->second()) {
                    $aid = $this->router->second();
                    $art_data = $this->model->article($aid);
                    $this->view->article($art_data);
                }
                else {
                    $art_data = $this->model->articles_all();
                    $this->view->articles($art_data);
                }
                 */
                $ac = new ArticleController();
                $ac->setRouter($this->router);
                $ac->invoke();
            default:
                //echo $this->router->get();
                //echo 'prrr';
        }
        
        /*
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
                        $this->view->articles($art_data);
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
        */
    }
}
