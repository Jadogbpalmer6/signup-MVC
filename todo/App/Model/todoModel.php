<?php

class todoModel extends model{
		//the constructor makes connection to the database
	function __construct()
	{
		$this->connect();
	}
	
	//this index function returns ongoing tasks only
	public function index(){
		try{
			session_start();
			$user = $_SESSION['user'];
			$query = $this->DB->prepare("SELECT * FROM tasks WHERE user=? and state=1");
			$query -> execute(array($user));
			$result = $query ->fetchall(PDO::FETCH_ASSOC);
			return $result;
		}catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }
	}

	public function addTask($dataArray){
		try{
			$title = $dataArray[0];
			$details = $dataArray[1];
			$created = $dataArray[2];

			session_start();
			$user = $_SESSION['user'];
			$query = $this->DB->prepare("INSERT INTO tasks(title,details,user,created) values(:title,:details,:user,:created)");
			$query -> execute(
				[
					':title' => $title,
					':details' => $details,
					':user' => $user,
					':created' =>$created
				]
			);
			return 1;	
		}catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }	
	}


	public function endTask($tableId){
		try{
			$query = $this->DB->prepare("UPDATE `tasks` SET `state` = '2' WHERE `tasks`.`t_id` = $tableId");
			$query -> execute(array($tableId));
			return 1;

		}catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }
	}
}