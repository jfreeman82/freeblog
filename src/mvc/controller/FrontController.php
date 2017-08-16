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
        
        $this->twigarr['articles'] = ArticleModel::articles_lastx_obj(5);
        $template = $this->twig->load('front.twig');
        echo $template->render($this->twigarr);
    }
    
}
