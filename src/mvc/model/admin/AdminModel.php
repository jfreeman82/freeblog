<?php
namespace freest\blog\mvc\model\admin;

use freest\modules\DB\DBC;
use freest\blog\mvc\model\Model as Model;

use freest\blog\modules\User as User;

/**
 * Description of Model
 *
 * @author myrmidex
 */
class AdminModel extends Model {
 
  
  /* FORM PROCESSORS */
  
  /* fp_login
   * 
   *  processes login form
   */
    public function fp_login() 
    {
        if (filter_input(INPUT_POST, 'loginform') == "go") {
            $email = filter_input(INPUT_POST, 'lf_email');
            $password = hash('sha256',filter_input(INPUT_POST, 'lf_password'));
            $sql = "SELECT id FROM users WHERE email = '$email' AND password = '$password';";
            $dbc = new DBC();
            $q = $dbc->query($sql) or die("ERROR Model / fp_login - ".$dbc->error());
            if ($q->num_rows == 0) {
                //echo 'fout.';
                echo 'this pwd: '.$password;
                $sql = "SELECT id FROM users WHERE email = '$email';";
                $q = $dbc->query($sql) or die("ERROR!");
                $id = $q->fetch_assoc()['id'];
                $user = new User($id);
                echo '// db pass: '.$user->password();
                return array('status' => 'warning', 
                    'warning' => 'Username / Password combination not found.');
            }
            else {
                $uid = $q->fetch_assoc()['id'];
                $_SESSION['uid'] = $uid;
                return array('status' => '1');
            }
        }
        else {
            return array('status' => '0');
        }
    }
  
   
    
    
}
