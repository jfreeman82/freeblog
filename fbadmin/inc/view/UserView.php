<?php

namespace FreeBlog\Admin\View;

/**
 * Description of UserView
 *
 * @author myrmidex
 */
class UserView extends View 
{

    public function usersList($users): void
    {
        $this->title = 'Users';
        $this->content .= '
      <table class="table table-bordered">
        <tr class="row">
          <th class="col-lg-1">id</th>
          <th class="col-lg-1">username</th>
          <th class="col-lg-6">email</th>
          <th class="col-lg-2">date joined</th>
          <th class="col-lg-2">actions</th>
        </tr>';
    
        foreach ($users as $user) {
        $this->content .= '
        <tr class="row">
          <td><a href="index.php?page=user&id='. $user['id'] .'">'. $user['id']                               .'</a></td>
          <td><a href="index.php?page=user&id='. $user['id'] .'">'. $user['username']                         .'</a></td>
          <td><a href="index.php?page=user&id='. $user['id'] .'">'. $user['email']                            .'</a></td>
          <td><a href="index.php?page=user&id='. $user['id'] .'">'. date("d/m/Y",strtotime($user['gendate'])) .'</a></td>
          <td>
            <a href="index.php?page=user&id='. $user['id'] .'&action=edit">  Edit  </a>&nbsp;
            <a href="index.php?page=user&id='. $user['id'] .'&action=delete">Delete</a>
          </td>
        </tr>';      
        }
    
        $this->content .= ' 
      </table>
      <a href="index.php?page=user&action=new" class="btn btn-primary">Add New User</a>';
        $this->dashboard();
    }
  
    public function user($user): void 
    {
        $this->title = 'User';
        $this->content = '
      <article>
        <h2>'.$user['username'].'</h2>
        <div>email: '.$user['email'].'</div>
        <div>Date Joined: '.date("d/m/Y",strtotime($user['gendate'])).'</div>
        <div class="art-buttons">
          <a href="index.php?page=user&id='.$user['id'].'&action=edit"    class="btn btn-warning">Edit  </a>
          <a href="index.php?page=user&id='.$user['id'].'&action=delete"  class="btn btn-danger"> Delete</a>
        </div>
      </article>';
        $this->dashboard();
    }
  
    public function user_newForm($warning = ""): void 
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
          <label for="un_email">Email</label>
          <textarea name="un_email" id="un_email" class="form-control" placeholder="Article" required></textarea>
        </div>
        <input type="hidden" name="unform" value="go" />
        <input type="submit" value="Add User" class="btn btn-primary"/>
      </form>
      </div>
      </div>';
        $this->dashboard();
    }
  
    public function user_editForm($user, $warning = ""): void 
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
      <form action="index.php?page=user&id='.$user['id'].'&action=edit" method="POST">
        <div class="form-group">
          <label for="ue_username">Username</label>
          <input type="text" name="ue_username" id="ue_username" class="form-control" value="'.$user['username'].'"/>
        </div>
        <div class="form-group">
          <label for="ue_email">Email</label>
          <textarea name="ue_email" id="ue_email" class="form-control">'.$user['email'].'</textarea>
        </div>
        <input type="hidden" name="ueform" value="go" />
        <input type="submit" value="Edit User" class="btn btn-primary"/>
      </form>
      </div>
      </div>';
        $this->dashboard();
    }
    public function user_deleteForm($user, $warning = ""): void 
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
          <tr><td>username</td><td>'.$user['username'].'</td></tr>
          <tr><td>email   </td><td>'.$user['email']   .'</td></tr>
        </table>    
        <form action="index.php?page=user&id='.$user['id'].'&action=delete" method="POST">
          <input type="hidden" name="udform" value="go" />
          <div class="alert alert-danger">Are you sure you want to delete this user?</div>
          <input type="submit" value="Yes, Delete" class="btn btn-danger"/>
        </form>
      </article>';
        $this->dashboard();
    }
  
}