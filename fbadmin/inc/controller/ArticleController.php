<?php
namespace FreeBlog\Admin\Controller;

use FreeBlog\Admin\Model\ArticleModel as ArticleModel;
use FreeBlog\Admin\View\ArticleView as ArticleView;

use FreeBlog\Articles\Article as Article;

/**
 * Description of ArticleController
 *
 * @author myrmidex
 */
class ArticleController 
{
    private $model;
    private $view;
    
    public function __construct()
    {
        $this->model = new ArticleModel();
        $this->view = new ArticleView();
    }
    
    public function invoke() 
    {
        $page = filter_input(INPUT_GET, 'page');
        if ($page == 'articles') {
            $this->articles_list();
        }
        else { // article       
            if (filter_input(INPUT_GET, 'id') > 0) {
                $art = $this->model->article(filter_input(INPUT_GET,'id'));
                if (filter_input(INPUT_GET, 'action') == "edit") {
                    $this->article_edit($art);
                }
                elseif (filter_input(INPUT_GET, 'action') == "delete") {
                    $this->article_delete($art);
                }
                else {                
                    $this->view->article($art);              
                }
            }
            else {
                if (filter_input(INPUT_GET, 'action') == "new") {
                    $this->article_new();
                }
                else {
                    $this->view->error('No ArticleID Set.');
                }
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
                $this->articles_list();
                break;
            default:
                $this->view->article_newForm($check['warning']);
        }
    }

    private function article_edit(Article $art)
    {
        $check = $this->model->fp_articleedit();
        switch($check['status']) {
            case '0':
                $this->view->article_editForm($art);
                break;  
            case '1':
                $this->articles_list();
                break;
            default:
                $this->view->article_editForm($check['warning']);
        }
    }
    
    
    private function article_delete(Article $art): void
    {
        $check = $this->model->fp_articledelete();
        switch($check['status']) {
            case '0':
                $this->view->article_deleteForm($art);
                break;
            case '1':
                $this->articles_list();
                break;
            default:
                $this->view->article_deleteForm($check['warning']);
        }
    }

    
}
