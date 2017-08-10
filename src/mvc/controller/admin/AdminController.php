<?php
namespace freest\blog\mvc\controller\admin;

use freest\blog\mvc\controller\Controller as Controller;

use freest\blog\mvc\model\admin\AdminModel as AdminModel;
use freest\blog\mvc\view\admin\AdminView as AdminView;

use freest\blog\mvc\controller\admin\ArticleController as ArticleController;
use freest\blog\mvc\controller\admin\UserController as UserController;

use freest\blog\modules\auth;
/* 
 * Controller.php
 */

class AdminController extends Controller {

    private $model;
    private $view;
  
  
    public function __construct() 
    {
        $this->model = new AdminModel();
        $this->view = new AdminView();
    }

    public function invoke() 
    {
        if (filter_input(INPUT_GET,'action') == "logout") { 
            auth\logout();
        }
    
        if (auth\isLoggedIn()) {
    
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
                $artmodel = new \freest\blog\admin\mvc\model\ArticleModel();
                $arts = $artmodel->articles_all();
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

