<?php
namespace FreeBlog\Admin\Controller;

use FreeBlog\Admin\Model\UserModel as UserModel;
use FreeBlog\Admin\View\UserView as UserView;

/**
 * Description of UserController
 *
 * @author myrmidex
 */
class UserController 
{
    private $model;
    private $view;    
    
    public function __construct()
    {
        $this->model = new UserModel();
        $this->view = new UserView();
    }
    
    public function invoke() 
    {        
        $page = filter_input(INPUT_GET, 'page');
        if ($page == "user") {
            // view user profile
            
        }
        else { // users
            $users = $this->model->arraytable_all_users();
            $this->view->tableArray($users);
        }
    }
    
}
