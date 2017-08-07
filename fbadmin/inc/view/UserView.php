<?php

namespace FreeBlog\Admin\View;

use FreeBlog\Admin\Modules\User\User as User;

/**
 * Description of UserView
 *
 * @author myrmidex
 */
class UserView extends View 
{
    
    public function user(User $user)
    {
        $this->title = 'User';
        $this->content = '
      <article>
        <h2>'.$user->getUsername().'</h2>
        <div>email: '.$user->getEmail().'</div>
        <div>Date Joined: '.date("d/m/Y",strtotime($user->getGenDate())).'</div>
        <div class="art-buttons">
          <a href="index.php?page=user&id='.$user->id().'&action=edit"    class="btn btn-warning">Edit  </a>
          <a href="index.php?page=user&id='.$user->id().'&action=delete"  class="btn btn-danger"> Delete</a>
        </div>
      </article>';
        $this->dashboard();
    }
  
    public function user_newForm($warning = "")
    {
        $this->title = 'New User';
        $this->content = '
      <div class="row">
        <div class="col-lg-8">';
        if ($warning != "") {
            $this->content .= '
        <div class="alert alert-danger">'.$warning.'</div>';
        }
        $this->content .= ' 
      <form action="index.php?page=user&action=new" method="POST">
        <div class="form-group">
          <label for="un_username">Username</label>
          <input type="text" name="un_username" id="un_username" class="form-control" placeholder="Username" required />
        </div>
        <div class="form-group">
          <label for="un_password1">Password</label>
          <input type="password" name="un_password1" id="un_password1" class="form-control" placeholder="Password" required />
        </div>
        <div class="form-group">
          <label for="un_password2">Password Again</label>
          <input type="password" name="un_password2" id="un_password2" class="form-control" placeholder="Password" required />
        </div>
        <div class="form-group">
          <label for="un_email">Email</label>
          <input type="email" name="un_email" id="un_email" class="form-control" placeholder="Article" required />
        </div>
        <input type="hidden" name="unform" value="go" />
        <input type="submit" value="Add User" class="btn btn-primary"/>
      </form>
      </div>
      </div>';
        $this->dashboard();
    }
  
    public function user_editForm(User $user, $warning = ""): void 
    {
        $this->title = 'Edit User';
        $this->content = '
      <div class="row">
        <div class="col-lg-8">';
        if ($warning != "") {
            $this->content .= '
        <div class="alert alert-danger">'.$warning.'</div>';
        }
        $this->content .= ' 
      <form action="index.php?page=user&id='.$user->id().'&action=edit" method="POST">
        <div class="form-group">
          <label for="ue_username">Username</label>
          <input type="text" name="ue_username" id="ue_username" class="form-control" value="'.$user->username().'"/>
        </div>
        <div class="form-group">
          <label for="ue_password1">Password</label>
          <input type="password" name="ue_password1" id="ue_password1" class="form-control" value="'.$user->password().'"/>
        </div>
        <div class="form-group">
          <label for="ue_password2">Password again</label>
          <input type="password" name="ue_password2" id="ue_password2" class="form-control" value="'.$user->password().'"/>
        </div>
        <div class="form-group">
          <label for="ue_email">Email</label>
          <input type="email" name="ue_email" id="ue_email" class="form-control" value="'.$user->email().'" />
        </div>
        <input type="hidden" name="ueform" value="go" />
        <input type="submit" value="Edit User" class="btn btn-primary"/>
      </form>
      </div>
      </div>';
        $this->dashboard();
    }
    public function user_deleteForm(User $user, $warning = ""): void 
    {
        $this->title = 'Delete User';
        $this->content = '';
        if ($warning != "") {
            $this->content .= '
        <div class="alert alert-danger">'.$warning.'</div>';
        }
        $this->content .= ' 
      <article>
        <table>
          <tr><td>username</td><td>'.$user->username().'</td></tr>
          <tr><td>email   </td><td>'.$user->email()   .'</td></tr>
        </table>    
        <form action="index.php?page=user&id='.$user->id().'&action=delete" method="POST">
          <input type="hidden" name="udform" value="go" />
          <div class="alert alert-danger">Are you sure you want to delete this user?</div>
          <input type="submit" value="Yes, Delete" class="btn btn-danger"/>
        </form>
      </article>';
        $this->dashboard();
    }
}
