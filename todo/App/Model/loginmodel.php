<?php
/* duplicate functions in two models 
*its a problem
*/
class loginmodel extends model{
	//the constructor makes connection to the database
	function __construct()
	{
		$this->connect();
	}

	public function check_pwd($dataArray){
		try{
			$hash = isset($dataArray[2])? $dataArray[2] : 'username';
			$user = ($hash == 'email')? (explode('.', $dataArray[0])[0]) : $dataArray[0];
			$pwd = $dataArray[1];
			$query = $this->DB->prepare("SELECT * FROM users WHERE $hash = :value AND password = :password");
			$query->execute(
				[
					':value'=>$user,
					':password'=>$pwd
				]
			);
			$num = $query->fetchall(PDO::FETCH_ASSOC);
			return $num[0]['u_id'];
		}catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }
	}

	public function emailExist($email){
		try{
			$query = $this->DB->prepare("SELECT COUNT(*) AS NUMBER_OF_EMAILS FROM users WHERE email=?");
			$email = explode('.',$email)[0];
	        $query->execute(array($email));
	        $num = $query->fetchall(PDO::FETCH_ASSOC);
	        if($num[0]['NUMBER_OF_EMAILS']){
	        	return 1;
	        }else{
	        	return 0;
	        }
	    }catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }
	}

	public function usernameExist($username){
		try{
			$query = $this->DB->prepare("SELECT COUNT(*) AS NUMBER_OF_USERNAME FROM users WHERE username=?");
	        $query->execute(array($username));
	        $num = $query->fetchall(PDO::FETCH_ASSOC);
	        if($num[0]['NUMBER_OF_USERNAME']){
	        	return 1;
	        }else{
	        	return 0;
	        }
	    }catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }
	}

	public function getUsernameByEmail($email){
		try{
			$email = (explode('.', $email)[0]);
			$query = $this->DB->prepare("SELECT username FROM users WHERE email=?");
	        $query->execute(array($email));
	        $num = $query->fetchall(PDO::FETCH_ASSOC);
	        return $num;
	    }catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }
	}

	public function getUsernameById($id){
		try{
			$query = $this->DB->prepare("SELECT username FROM users WHERE u_id=?");
	        $query->execute(array($id));
	        $num = $query->fetchall(PDO::FETCH_ASSOC);
	        return $num[0]['username'];
	    }catch (PDOException $e) {
            $error = array('ERROR' => $e->getMessage());
            echo json_encode($error);
            die();
        }
	}

}