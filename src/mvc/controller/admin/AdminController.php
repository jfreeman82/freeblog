<?php
namespace freest\blog\mvc\controller\admin;

use freest\blog\mvc\controller\Controller as Controller;

use freest\blog\mvc\model\admin\AdminModel as AdminModel;
use freest\blog\mvc\view\admin\AdminView as AdminView;

use freest\blog\mvc\controller\admin\FrontAdminController as FrontAdminController;
use freest\blog\mvc\controller\admin\ArticleAdminController as ArticleAdminController;
use freest\blog\mvc\controller\admin\UserAdminController as UserAdminController;

use freest\blog\mvc\model\admin\ArticleAdminModel as ArticleAdminModel;
use freest\blog\mvc\view\admin\FrontAdminView as FrontAdminView;

use freest\blog\modules\auth;
/* 
 * Controller.php
 */

class AdminController extends Controller 
{
    public function invoke() 
    {
        $this->setModel(new AdminModel());
        $this->setView(new AdminView());
        
        if (auth\isLoggedIn()) {
    
            if ($this->router->getUri(1)) {
                switch ($this->router->getUri(1)) {
                    case "articles":
                    case "article":
                        $ac = new ArticleAdminController();
                        $ac->setRouter($this->router);
                        $ac->invoke();
                        break;
                    case "users":
                    case "user":
                        $uc = new UserAdminController();
                        $uc->setRouter($this->router);
                        $uc->invoke();
                        break;
                    case "logout":
                        auth\logout();
                        header("Location: ".BASE_URL.'fbadmin');
                        //$this->login();
                        break;
                    default: 
                        $fc = new FrontAdminController();
                        $fc->setRouter($this->router);
                        $fc->invoke();
                }
            }
            else {
                //echo 'get: '.$this->router->get();
                $this->setModel(new ArticleAdminModel());
                $this->setView(new FrontAdminView());
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
                //echo 'uid: '.$_SESSION['uid'];
                header("Location: ".ADMIN_URL);
                break;
            default:
                $warning = $check['warning'];
                $this->view->setWarning($warning);
                $loginArr = $this->model->formArray_login();
                $this->view->login($loginArr);
            
        }
    }
    
}

