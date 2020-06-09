<?php
/* remember to test 
*open
*close  
*/
//it requires the configuration file
require_once './configuration.php';

/**
 * the base class for database manipulations controlling the communication to the database
 */
class Model extends PDO
{
		//the constructor make connection to the database using PDO
	function __construct(){

		//instantiation of the configuration class as an instance of Model class is created
		$this->conf = new Config;

		try {
			//the constructor function calls the PDO constructor to connect to the database using the configuration settings
			parent::__construct($this->conf->drive.":host=".$this->conf->host.";dbname=".$this->conf->dbname.";charset=".$this->conf->charset,$this->conf->username,$this->conf->pwd);

				$this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			} 
		
		catch (PDOEXception $th) {
			echo " <b> unable to connect </b>".$th;
		}

	}
	public function openDb(){
		$this->open();
	}

	public function closeDb(){
		$this->close();
	}


	//the function check if the username exists or not
	function userName_exists($username){
		$sql = "SELECT * FROM users WHERE username=?";
		$query = $this->prepare($sql);
		$query->bindValue(1,$username);	
		$query->execute();
		if($query->rowCount()===0){
			return False;
		}
		else{
			return True;
		}
	}

	//the function add user to the table users and return true
	function addUser($username,$email,$pwd){
		try {
			$sql = "INSERT INTO users values(?,?,?)";
			$query = $this->prepare($sql);
			$query->bindValue(1,$username);
			$query->bindValue(2,$email);
			$query->bindValue(3,$pwd);
			$query->execute();

			return true;

		} catch (exception $th) {
			echo "<b> error occured</b> please try to solve this error <br/> <br/> ".$th;
		}
	}
}