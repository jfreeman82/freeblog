<?php
namespace freest\blog\mvc\controller\admin;

use freest\blog\mvc\controller\admin\AdminController as AdminController;

use freest\blog\mvc\model\admin\ArticleAdminModel as ArticleAdminModel;
use freest\blog\mvc\view\admin\ArticleAdminView as ArticleAdminView;

use freest\blog\modules\articles\Article as Article;

/**
 * Description of ArticleController
 *
 * @author myrmidex
 */
class ArticleAdminController extends AdminController
{    
    public function invoke() 
    {
        $this->setModel(new ArticleAdminModel());
        $this->setView(new ArticleAdminView());
        
        $page = $this->router->getUri(1);
        if ($page == 'articles') {
            $arts = $this->model->articles_all();
            $this->view->articlesList($arts);
        }
        else { 
            // Single Article
            if ($this->router->getUri(2) && is_numeric($this->router->getUri(2))) {
                $aid = $this->router->getUri(2);
                //echo 'aid: '.$aid;
                $art = $this->model->article($aid);
                if ($this->router->getUri(3)) {
                    $action = $this->router->getUri(3);                
                    switch ($action) {
                        case "edit":
                            $this->article_edit($art);
                            break;
                        case "delete":
                            $this->article_delete($art);
                            break;
                        default:                    
                            $this->view->article($art);              
                    }
                }
                else {
                    $this->view->article($art);              
                }
            }
            elseif ($this->router->getUri(2) == "new") {
                $this->article_new();
            }
            else {
                $this->view->error('No ArticleID Set.');
            }
            
        }
    }
    
    private function articles_list() 
    {
        $arts = $this->model->articles_arraytable();
        $this->view->tableArray($arts);
    }
    
    private function article_new()
    {
        $check = $this->model->fp_articleNew();
        switch($check['status']) {
            case '0':
                $this->view->article_newForm();
                break;
            case '1':
                header("Location: ".ADMIN_URL.'articles/');
                break;
            default:
                $this->view->article_newForm($check['warning']);
        }
    }

    private function article_edit(Article $art)
    {
        $check = $this->model->fp_articleedit($art);
        switch($check['status']) {
            case '0':
                $this->view->article_editForm($art);
                break;  
            case '1':
                header("Location: ".ADMIN_URL.'article/'.$art->id().'/');
                break;
            default:
                $this->view->article_editForm($art, $check['warning']);
        }
    }
    
    
    private function article_delete(Article $art)
    {
        $check = $this->model->fp_articledelete($art);
        switch($check['status']) {
            case '0':
                $this->view->article_deleteForm($art);
                break;
            case '1':
                header("Location: ".ADMIN_URL.'articles/');
                break;
            default:
                $this->view->article_deleteForm($art, $check['warning']);
        }
    }
}
