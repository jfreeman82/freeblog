<?php
namespace FreeBlog\Admin\Model;

use FreeBlog\Articles\Article as Article;
use FreeBlog\Admin\Modules\User\User as User;
/**
 * Description of Model
 *
 * @author myrmidex
 */
class Model {

  public function __construct() {}
  
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
            $user = new User($row['id']);
            $data[] = array($row['id'], $user->getUsername(),'action');
        }    
        $out['title'] = 'articles';
        $out['table-class'] = 'table table-bordered';
        $out['data'] = $data;
        $out['footer'] = '  
      <a href="index.php?page=user&action=new" class="btn btn-primary">Add New User</a>';
    
        return $out;
  }
  
  /* FORM PROCESSORS */
  
  /* fp_login
   * 
   *  processes login form
   */
    public function fp_login() {
        if (filter_input(INPUT_POST, 'loginform') == "go") {
            $email = filter_input(INPUT_POST, 'lf_email');
            $password = hash('sha256',filter_input(INPUT_POST, 'lf_password'));
            $sql = "SELECT id FROM users WHERE email = '$email' AND password = '$password';";
            global $dbc;
            $q = $dbc->query($sql) or die("ERROR Model / fp_login - ".$dbc->error());
            if ($q->num_rows == 0) {
                return array('warning' => 'Username / Password combination not found.');
            }
            else {
                $uid = $q->fetch_assoc()['id'];
                $_SESSION['uid'] = $uid;
                return 1;
            }
        }
        else {
            return 0;
        }
    }
  
}
