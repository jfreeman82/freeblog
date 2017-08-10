<?php
namespace freest\blog\modules;

use freest\modules\DB\DBC as DBC;

/**
 * Description of User
 *
 * @author myrmidex
 */
class User {

  private $id;
  private $username;
  private $email;
  private $password;
  private $gendate;
  
  public function __construct($uid) {
    $this->id = $uid;
    $sql = "SELECT username, email, password, gendate "
            . "FROM users "
            . "WHERE id = '$uid';";
    $dbc = new DBC();
    $q = $dbc->query($sql) or die("ERROR: User - ".$dbc->error());
    $row = $q->fetch_assoc();
    $this->username = $row['username'];
    $this->email = $row['email'];
    $this->password = $row['password'];
    $this->gendate = $row['gendate'];
  }
  public function getId() {
      return $this->id;
  }
  public function getUsername() {
    return $this->username;
  }
  public function getPassword() {
    return $this->password;
  }
  public function getGenDate() {
    return $this->gendate;
  }
  public function getEmail() {
      return $this->email;
  }
  
  // new getters:
  public function id()       { return $this->id;       }
  public function username() { return $this->username; }
  public function email()    { return $this->email;    }
  public function password() { return $this->password; }
  public function gendate()  { return $this->gendate;  }
  
  
  public function dataArray() {
    return array(
        'id'        => $this->id,
        'username'  => $this->username,
        'password'  => $this->password,
        'gendate'   => $this->gendate
    );
  }
}
