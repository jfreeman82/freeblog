<?php
namespace freest\blog\mvc\controller;

use freest\blog\mvc\model\Model as Model;
use freest\blog\mvc\view\View as View;
use freest\router\Router as Router;

use freest\blog\mvc\controller\admin\AdminController as AdminController;

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
        
    }

    public function router() 
    {        
        $router = new Router();
        $router->route('',          '0');
        $router->route('index.php', '0');
        $router->route('articles',  '1');
        $router->route('fbadmin',   '2');
        $this->router = $router;
    }
    
    public function invoke() 
    {
        $this->router();
        
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
                // Articles
                $ac = new ArticleController();
                $ac->setRouter($this->router);
                $ac->invoke();
            case '2':
                //echo 'admin';
                require '../admin.config.php';
                $am_con = new AdminController();
                $am_con->setRouter($this->router);
                $am_con->invoke();
                break;
            default:
                //echo $this->router->get();
                //echo 'prrr';
                // front
                $fc = new FrontController();
                $fc->setRouter($this->router);
                $fc->invoke();
        }
        
    }
    protected function setRouter(Router $router) {
        $this->router = $router;
    }
}
