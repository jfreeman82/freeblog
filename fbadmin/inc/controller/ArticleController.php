<?php
namespace FreeBlog\Admin\Controller;

use FreeBlog\Admin\Model\ArticleModel as ArticleModel;
use FreeBlog\Admin\View\ArticleView as ArticleView;

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
            $arts = $this->model->articles_arraytable();
            $this->view->tableArray($arts);
        }
        else { // article       
            if (filter_input(INPUT_GET, 'id') > 0) {
                $art = $this->model->article(filter_input(INPUT_GET,'id'));
                if (filter_input(INPUT_GET, 'action') == "edit") {
                    $this->userform_edit();
                }
                elseif (filter_input(INPUT_GET, 'action') == "delete") {
                    $this->userform_delete();
                }
                else {                
                    $this->view->article($art);              
                }
            }
            else {
                if (filter_input(INPUT_GET, 'action') == "new") {
                    $this->userform_new();
                }
                else {
                    $this->view->error('No ArticleID Set.');
                }
            }
        }
    }
    
    private function userform_new(): void
    {
        $check = $this->model->fp_articleNew();
        switch($check) {
            case 0:
                $this->view->article_newForm();
                break;
            case 1:
                $arts = $this->model->articles_all();
                $this->view->articlesList($arts);
                break;
            default:
                $this->view->article_newForm($check['warning']);
        }
    }

    private function userform_edit(): void
    {
        $check = $this->model->fp_articleedit();
        switch($check) {
            case 0:
                $this->view->article_editForm($art);
                break;  
            case 1:
                $art = $this->model->article(filter_input(INPUT_GET,'id'));
                $this->view->article($art);
                break;
            default:
                $this->view->article_editForm($check['warning']);
        }
    }
    
    
    private function userform_delete(): void
    {
        $check = $this->model->fp_articledelete();
        switch($check) {
            case 0:
                $this->view->article_deleteForm($art);
                break;
            case 1:
                $arts = $this->model->articles_all();
                $this->view->articlesList($arts);
                break;
            default:
                $this->view->article_deleteForm($check['warning']);
        }
    }

    
}
