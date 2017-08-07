<?php
namespace FreeBlog\Admin\Modules\User;
/**
 * Description of User
 *
 * @author myrmidex
 */
class User {

  private $id;
  private $username;
  private $password;
  private $gendate;
  
  public function __construct($uid) {
    $this->id = $uid;
    $sql = "SELECT username, password, gendate "
            . "FROM users "
            . "WHERE id = '$uid';";
    global $dbc;
    $q = $dbc->query($sql) or die("ERROR: User - ".$dbc->error());
    $row = $q->fetch_assoc();
    $this->username = $row['username'];
    $this->password = $row['password'];
    $this->gendate = $row['gendate'];
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
  
  public function dataArray() {
    return array(
        'id'        => $this->id,
        'username'  => $this->username,
        'password'  => $this->password,
        'gendate'   => $this->gendate
    );
  }
}
