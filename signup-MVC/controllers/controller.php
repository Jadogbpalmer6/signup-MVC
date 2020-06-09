<?php

//includes the basic database manupilation file model.php
require_once './models/model.php';


class Controller {
	function __construct(){
		//instantiation of the model class
		$this->database = new Model;
	}

	public function HTTP_render($view){
		return header("location:./views/$view");
	}

	public function display_main_page(){
		return $this->HTTP_render('index.html');
	}

	public function register_user(){
		if (!empty($_POST['username'])&&!empty($_POST['email'])&&!empty($_POST['pwd'])) {
			$username = $_POST['username'];
			$email = $_POST['email'];
			$pwd = $_POST['pwd'];

			if(!$this->database->userName_exists($username)){
				$this->database->addUser($username,$email,$pwd);
				$this->HTTP_render('signedUp.html');
			}
			throw new Exception("that username is taken", 1);
			}
			else
				throw new Exception("please fill in all fields", 1);
				
		
	}


}