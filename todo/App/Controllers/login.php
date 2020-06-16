<?php

class login extends Controller{
	private $email;

	public function index(){
		//checks the existance of password 
		if (isset($_POST['password'])) {
			$this->pwd = $_POST['password'];

			//username existance
			if (isset($_POST['username'])) {
				$this->username = htmlspecialchars($_POST['username']);

				//checks if the username exists
				if ($this->model('loginmodel','usernameExist',$this->username)) {

					//get the id of the the user while checking if really the password match
					if ($this->id = $this->model('loginmodel','check_pwd',[$this->username,$this->pwd])) {

						//start and set the session ??? why can't we use tokens
						session_start();
						$_SESSION['user'] = $id;
						$this->view(401,"loginOK","you have succesfully loged in as ".$this->username);
					}else{
						$this->view(401,'loginFail','username and password don\'t match');
					}
				}else{
					$this->view(401,'loginFail','no such username in the database');
				}
			}elseif (isset($_POST['email'])) {
				$hash = 'email';
				$this->email = htmlspecialchars($_POST['email']);
				if ($this->model('loginmodel','emailExist',$this->email)) {
					if ($this->id = $this->model('loginmodel','check_pwd',[$this->email,$this->pwd,$hash])) {
						session_start();
						$_SESSION['user'] = $this->id;
						$this->username = $this->model('loginmodel', 'getUsernameById', $this->id);
						$this->view(200,'loginOK','you have succesfully logged in as '. $this->username);

						}else{
							$this->view(401,'loginFail','email and password don\'t match');
						}
					}else{
						$this->view(401,'loginFail','no such email among our users');
					}
			}else{
				$this->view(401,'loginFail','missing required field(s)');
			}
		}else{
			$this->view(401,'loginFail','missing required field(s)');
		}
	}
}