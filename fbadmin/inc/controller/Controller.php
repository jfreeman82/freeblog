<?php
namespace FreeBlog\Admin\Controller;

use FreeBlog\Admin\Model\Model as Model;
use FreeBlog\Admin\View\View as View;

use FreeBlog\Admin\Controller\UserController as UserController;

/* 
 * Controller.php
 */

class Controller {

    private $model;
    private $view;
  
  
    public function __construct() 
    {
        $this->model = new Model();
        $this->view = new View();
    }

    public function invoke() 
    {
        if (filter_input(INPUT_GET,'action') == "logout") { 
            logout();
        }
    
        if (isLoggedIn()) {
    
            if (filter_input(INPUT_GET,'page')) {
                $page = filter_input(INPUT_GET, 'page');
                switch ($page) {
                    case "articles":
                    case "article":
                        $ac = new ArticleController();
                        $ac->invoke();
                        break;
                    case "users":
                    case "user":
                        $uc = new UserController();
                        $uc->invoke();
                        break;
                    default: 
                        $this->view->front();
                }
            }
            else {
                $arts = $this->model->articles_all();
                $this->view->front($arts);
            }
        }
        else {
            $this->login();      
        }
    }
    
    private function login() {
        $check = $this->model->fp_login();
        switch($check['status']) {
            case '0':
                $loginArr = $this->model->formArray_login();
                $this->view->login($loginArr);
                break;
            case '1':
                $this->view->front();
                break;
            default:
                $warning = $check['warning'];
                $this->view->setWarning($warning);
                $loginArr = $this->model->formArray_login();
                $this->view->login($loginArr);
        }
    }
}

