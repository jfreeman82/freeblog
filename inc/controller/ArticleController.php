<?php
namespace freest\blog\mvc\controller;

use freest\router\Router as Router;
use freest\blog\mvc\model\ArticleModel as ArticleModel;
use freest\blog\mvc\view\ArticleView as ArticleView;

/**
 * Description of ArticleController
 *
 * @author myrmidex
 */
class ArticleController 
{
    private $model;
    private $view;
            
    private $router;
    
    public function setRouter(Router $router) {
        $this->model = new ArticleModel();
        $this->view = new ArticleView();
        $this->router = $router;
    }
    
    public function invoke()
    {
        if ($this->router->second()) {
            $aid = $this->router->second();
            $art_data = $this->model->article($aid);
            $this->view->article($art_data);
        }
        else {
            $art_data = $this->model->articles_all();
            $this->view->articles($art_data);
        }
    }
    
    
}
