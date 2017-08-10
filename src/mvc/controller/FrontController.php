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
    
    public function invoke()
    {
        $this->setModel(new ArticleModel());
        $this->setView(new FrontView());
        
        $arts = $this->model->articles_lastx_obj(5);
        $this->view->front($arts);            
    }
    
}
