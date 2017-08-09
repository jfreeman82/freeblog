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
    
    protected $router;
   
    public function __construct() 
    {
        $this->model = new Model();
        $this->view = new View();
        
        $router = new Router();
        $router->route('',          '0');
        $router->route('index.php', '0');
        $router->route('articles',  '1');
        $router->route('fbadmin',     '2');
        $this->router = $router;
    }

    public function invoke() 
    {
        switch ($this->router->get()) {
            case '0':
                //echo 'home';
                //echo 0;
                //echo $this->router->get();
                $fc = new FrontController();
                $fc->setRouter($this->router);
                $fc->invoke();
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
                echo 'articles';
                $ac = new ArticleController();
                $ac->setRouter($this->router);
                $ac->invoke();
            case '2':
                echo 'admin';
            default:
                //echo $this->router->get();
                //echo 'prrr';
        }
        
    }
    protected function setRouter(Router $router) {
        $this->router = $router;
    }
}
