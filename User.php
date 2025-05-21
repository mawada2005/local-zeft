<?php
class User {
protected $userID;
protected $name;
protected $password;
protected $email;
 
 public function __construct($userID,$name,$email,$password) {
    $this->userID= $userID;
    $this->name = $name;
     $this->password = $password; 
    $this->email = $email;
   
}
 public function login(){
    echo "{$this->name} logged in ";
}
public function logout()
{
    echo "{$this->name} logged out";
}
}








?>