<?php
namespace FreeBlog\Admin\Controller;

use FreeBlog\Admin\Model\UserModel as UserModel;
use FreeBlog\Admin\View\UserView as UserView;

use FreeBlog\Admin\Modules\User\User as User;

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
            if (filter_input(INPUT_GET, 'id')) {
                // view user profile
                $uid = filter_input(INPUT_GET, 'id');
                if (filter_input(INPUT_GET, 'action') == "edit") {
                    $this->editUser($uid);
                }
                elseif (filter_input(INPUT_GET, 'action') == "delete") {
                    $this->deleteUser($uid);
                }
                else {                
                    $this->view->user( $this->model->user($uid) );
                }
            }
            else {
                if (filter_input(INPUT_GET, 'action') == "new") {
                    $this->newUser();
                }
                // view all users
                $this->allUsers();
            }
        }
        else { // users
            $this->allUsers();
        }
    }
    
    private function allUsers() 
    {
        $this->view->tableArray( $this->model->arraytable_all_users() );
    }
    
    private function newUser()
    {
        $check = $this->model->fp_userNew();
        switch ($check['status']) {
            case '0':
                echo 'status: '.$check['status'];
                $this->view->user_newForm();
                break;
            case '1':
                $users = $this->model->arraytable_all_users();
                $this->view->tableArray($users);
                break;
            default:
                $this->view->user_newForm($check['warning']);                
        }
    }
    private function editUser($uid)
    {
        $user = new User($uid);
        $check = $this->model->fp_userEdit();
        switch ($check['status']) {
            case '0':
                $this->view->user_editForm($user);
                break;
            case '1':
                $users = $this->model->arraytable_all_users();
                $this->view->tableArray($users);
                break;
            default:
                $this->view->user_editForm($user, $check['warning']);                
        }
    }
    private function deleteUser($uid) 
    {
        $check = $this->model->fp_userDelete();
        switch ($check['status']) {
            case '0':
                $this->view->user_deleteForm();
                break;
            case '1':
                $users = $this->model->arraytable_all_users();
                $this->view->tableArray($users);
                break;
            default:
                $this->view->user_deleteForm($check['warning']);                
        }
    }
}
