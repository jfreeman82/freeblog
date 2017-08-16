<?php
namespace freest\blog\mvc\controller;

use freest\blog\mvc\model\ArticleModel as ArticleModel;

/**
 * Description of FrontController
 *
 * @author myrmidex
 */
class FrontController extends Controller{
    
    public function invoke()
    {
        $this->setModel(new ArticleModel());

        $this->twigarr['blogheaderset'] = true;   
        $this->twigarr['articles'] = ArticleModel::articles_lastx_obj(5);
        $template = $this->twig->load('front.twig');
        echo $template->render($this->twigarr);
    }
    
}
