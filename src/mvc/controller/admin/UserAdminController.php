<?php
namespace freest\blog\mvc\controller\admin;

use freest\blog\mvc\controller\admin\AdminController as AdminController;

use freest\blog\mvc\model\admin\UserAdminModel as UserAdminModel;
use freest\blog\mvc\view\admin\UserAdminView as UserAdminView;

use freest\blog\modules\User as User;

/**
 * Description of UserController
 *
 * @author myrmidex
 */
class UserAdminController extends AdminController
{
    
    public function invoke() 
    {        
        $this->setModel(new UserAdminModel());
        $this->setView(new UserAdminView());
             
        if ($this->router->getUri(1) == "user") {
            if ($this->router->getUri(2) && is_numeric($this->router->getUri(2))) {
                // view user profile
                $uid = $this->router->getUri(2);
                $user = new User($uid);  
                if ($this->router->getUri(3)) {
                    $action = $this->router->getUri(3);
                    switch ($action) {
                        case "edit":
                            $this->editUser($user);
                            break;
                        case "delete":
                            $this->deleteUser($user);
                            break;
                        default:      
                            $this->view->user( $this->model->user($uid) );
                    }
                }
                else {
                    $this->view->user( $this->model->user($uid) );
                }
            }
            elseif ($this->router->getUri(2) == "new") {
                $this->newUser();
            }
            else {
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
                //echo 'status: '.$check['status'];
                $this->view->user_newForm();
                break;
            case '1':
                header("Location: ".ADMIN_URL."users/");
                break;
            default:
                $this->view->user_newForm($check['warning']);                
        }
    }
    private function editUser(User $user)
    {
        $check = $this->model->fp_userEdit($user);
        switch ($check['status']) {
            case '0':
                $this->view->user_editForm($user);
                break;
            case '1':                
                header("Location: ".ADMIN_URL."user/".$user->id().'/');
                break;
            default:
                $this->view->user_editForm($user, $check['warning']);                
        }
    }
    private function deleteUser(User $user) 
    {
        $check = $this->model->fp_userDelete($user);
        switch ($check['status']) {
            case '0':
                $this->view->user_deleteForm($user);
                break;
            case '1':
                header("Location: ".ADMIN_URL."users/");
                break;
            default:
                $this->view->user_deleteForm($user, $check['warning']);                
        }
    }
}
