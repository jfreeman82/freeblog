<?php
namespace freest\blog\mvc\controller;

use freest\blog\mvc\model\ArticleModel as ArticleModel;
use freest\blog\mvc\view\FrontView as FrontView;

/**
 * Description of FrontController
 *
 * @author myrmidex
 */
class FrontController extends Controller{
    
    private $model;
    private $view;
    
    public function __construct()
    {
        $this->model = new ArticleModel();
        $this->view = new FrontView();
    }
    
    public function invoke()
    {
        $arts = $this->model->articles_lastx(5);
        $this->view->front($arts);
                
    }
    
}
