<?php
namespace freest\blog\mvc\controller;

use freest\blog\mvc\model\ArticleModel as ArticleModel;
use freest\blog\mvc\view\ArticleView as ArticleView;

use freest\blog\mvc\controller\Controller as Controller;

/**
 * Description of ArticleController
 *
 * @author myrmidex
 */
class ArticleController extends Controller
{       
    public function invoke()
    {

        $this->model = new ArticleModel();
        $this->view = new ArticleView();

        if ($this->router->getUri(0) == "article") {
            
            if ($this->router->getUri(1)) {
                $aid = $this->router->getUri(1);
                $art_data = $this->model->article($aid);
                $this->view->article($art_data);            
            }
            else {
                // articles
                $art_data = $this->model->articles_all();
                $this->view->articles($art_data);
            }
        }
        else {
            // articles
            $art_data = $this->model->articles_all();
            $this->view->articles_olist($art_data);
        }
    }
    
    
}
