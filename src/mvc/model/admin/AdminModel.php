<?php
namespace freest\blog\mvc\model\admin;

use freest\modules\DB\DBC;

/**
 * Description of Model
 *
 * @author myrmidex
 */
class AdminModel {

  public function __construct() {}
  
  
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
                return array('warning' => 'Username / Password combination not found.');
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
  
    /*
     * Form Arrays
     * 
     * returns the build-array of the form function
     */
    public function formArray_login(): Array
    {
        return array(
            'form-class'    => 'form-signin',
            'form-action'   => ADMIN_URL,
            'form-title'    => 'Please sign in',
            'form-title-class' => 'form-signin-heading',
            'elements'      => array(
                array(
                    'type'          => 'email',
                    'name'          => 'lf_email',
                    'id'            => 'lf_email',
                    'class'         => 'form-control',
                    'setlabel'      => 1,
                    'label'         => 'Email Address',
                    'label-class'   => 'sr-only'
                ),
                array(
                    'type'          => 'password',
                    'name'          => 'lf_password',
                    'id'            => 'lf_password',
                    'class'         => 'form-control',
                    'setlabel'      => 1,
                    'label'         => 'Password',
                    'label-class'   => 'sr-only'
                ),
                array(
                    'type'  => 'hidden',
                    'name'  => 'loginform',
                    'value' => 'go'
                ),
                array(
                    'type'  => 'submit',
                    'class' => 'btn btn-lg btn-primary btn-block',
                    'value' => 'Sign in'
                )
            )
        );
    }
    
}
