<?php

class todo extends Controller{
	public function index(){
		$allTodo =$this -> model('todoModel');
		echo json_encode($allTodo);
	}


	public function addTask($value=''){

		if (isset($_POST['title']) && isset($_POST
			['details'])) {
			$title = htmlspecialchars($_POST['title']);
			$details = htmlspecialchars($_POST['details']);

			date_default_timezone_set('Africa/Kigali');
			$created = date('y-m-d h:m:s');

			if ($this ->model('todoModel','addTask',[$title,$details,$created])){
				$this -> view(200, 'done','succesfully added a task with title'.$title);
			}else{
				$this -> view(401, 'Failure','failed to add task');
			}
		}else{
			$this -> view(401, 'Failure','missing important field(s)');
		}
	}

	public function EndTask(){
		if (isset($_POST['id'])) {
			$tableId = htmlspecialchars($_POST['id']);
			if($this -> model('todoModel','endTask',$tableId)){
				
				$this -> view(200, 'done','succesfully ended the task');
			}else{
				$this -> view(401, 'Failure','failed to end task');
			}
		}else{
			$this -> view(401, 'Failure','missing important field(s)');
		}
	}
}