<?php
namespace FreeBlog\Admin\Model;

use FreeBlog\Admin\Modules\User\User as User;

/**
 * Description of UserModel
 *
 * @author myrmidex
 */
class UserModel extends Model 
{
    // arraytable_all_users
    public function arraytable_all_users(): Array 
    {
        global $dbc;
        $sql = "SELECT id FROM users ORDER BY gendate,username DESC;";
        $q = $dbc->query($sql) or die("ERROR Model - ".$dbc->error());
        $data = array();
        $data[] = array(
                array('value' => 'id',        'class' => 'col-lg-2'),
                array('value' => 'username',  'class' => 'col-lg-8'),
                array('value' => 'actions',   'class' => 'col-lg-2')
              );
        
        while ($row = $q->fetch_assoc()) {
            $uid = $row['id'];
            $user = new User($uid);
            $action = ' 
            <a href="index.php?page=user&id='. $uid .'&action=edit">  Edit  </a>&nbsp;
            <a href="index.php?page=user&id='. $uid .'&action=delete">Delete</a>';
            $username = '<a href="index.php?page=user&id='.$uid.'">'.$user->getUsername().'</a>';
            $data[] = array($uid, $username,$action);
        }    
        $out['title'] = 'articles';
        $out['table-class'] = 'table table-bordered';
        $out['data'] = $data;
        $out['footer'] = '  
      <a href="index.php?page=user&action=new" class="btn btn-primary">Add New User</a>';
    
        return $out;
    }
    
    public function user(int $uid): User 
    {
        return new User($uid);
    }
}
