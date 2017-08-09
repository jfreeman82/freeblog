<?php
namespace freest\blog\admin\modules;

use freest\modules\DB\DBC as DBC;
/**
 * Description of User
 *
 * @author myrmidex
 */
class User 
{

    private $id;
    private $username;
    private $password;
    private $email;
    private $gendate;
  
    public function __construct($uid) 
    {
        $this->id = $uid;
        $sql = "SELECT username, password, email, gendate "
                . "FROM users "
                . "WHERE id = '$uid';";
        $dbc = new DBC();
        $q = $dbc->query($sql) or die("ERROR: User - ".$dbc->error());
        $row = $q->fetch_assoc();
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->email    = $row['email'];
        $this->gendate  = $row['gendate'];
    }
  
    public function id(): int 
    {
      return $this->id;
    }
    public function username(): string 
    {
        return $this->username;
    }
    public function password(): string 
    {
        return $this->password;
    }
    public function email() {
        return $this->email;
    }
    public function genDate(): string 
    {
        return $this->gendate;
    }
  
    /* Obsolete getters */
    public function getUsername(): string 
    {
        return $this->username();
    }
    public function getPassword(): string 
    {
        return $this->password();
    }
    public function getEmail(): string
    {
        return $this->email();
    }
    public function getGenDate(): string
    {
        return $this->genDate();
    }
  
  
    public function dataArray(): Array 
    {
        return array(
            'id'        => $this->id,
            'username'  => $this->username,
            'password'  => $this->password,
            'gendate'   => $this->gendate
        );
    }
}
