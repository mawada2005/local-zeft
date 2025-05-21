<?php
class User {
    protected $userID;
    protected $name;
    protected $password;
    protected $email;

    public function __construct($userID, $name, $email, $password) {
        $this->userID = $userID;
        $this->name = $name;
        $this->email = $email;
        // Hash the password during object creation
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function login() {
        echo "{$this->name} logged in";
    }

    public function logout() {
        echo "{$this->name} logged out";
    }

    // Optional: show hashed password for debug
    public function getHashedPassword() {
        return $this->password;
    }
}


$user = new User(2, 'mawada', 'mawada2005@gmail.com', 'queen=mawada;');


echo $user->getHashedPassword();
?>
