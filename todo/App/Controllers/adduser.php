<?php

class adduser extends Controller
{
    private $email;
    private $password;
    private $username;
    public function index()
    {
        
        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password1']) && isset($_POST['password2'])) {
            $this->email = $_POST['email'];
            $this->username = $_POST['username'];
            $this->password_check($_POST['password1'],$_POST['password2']);
        } else {
            $this->view(401, 'signupError', 'Missing required parameters');
        }
    }
    private function password_check($pass1, $pass2)
    {
        if (strlen($pass1) >= 6 && strlen($pass2) >= 6) {

            if ($pass1 === $pass2) {
                $this->password = $pass2;
                $this->emailExist();
            } else {
                $this->view(401, 'signupError', 'Password dont match');
            }
        } else {
            $this->view(401, 'signupError', 'password minimun length is 6 characters');
        }
    }
    private function emailExist()
    {
        $email = $this->email;
        $check = $this->model('addusermodel', 'EmailExist', $email);
        if ($check == 0) {
            $this->usernameExist();
        } else {
            $this->view(401, 'signupError', 'Email exists');

        }
    }
    private function usernameExist()
    {
        $check = $this->model('addusermodel', 'UsernameExist', $this->username);
        if ($check == 0) {
            $adduser = $this->model('addusermodel', 'adduser',[$this->username,$this->email,$this->password]);
            if ($adduser==1) {
               $this->view(200, 'signupOK', 'Account Created');
            }
        } else {
            $this->view(401, 'signupError', 'Username exists');
        }

    }
}

?>