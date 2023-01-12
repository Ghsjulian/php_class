<?php
/*==================================
DON'T EDIT THIS CODE , HERE EVERYTHING IS OKAY , IF YOU GET ANY ERRORS, PLEASE
CHECK YOUR SQL QUERY , MAYBE THERE'S YOU'VE DONE MISTAKE ! THANKS FOR USING MY
CODES . FOR MORE SUGGESTIONS PLEASE VISIT MY GITHUB PROFILE AND SOCIAL MEDIA
PROFILE !!!

HAPPY CODING.....</>GHS JULIAN</>
====================================*/



class Database {
	public $conn;
	public $mysql = '';
	public $db_name;
	private $devoloper = "Ghs Julian";
	private $_server_info = array();
	private $message = array();
	public $result = array();

	public function __construct() {
		$conf = file_get_contents('config.json');
		$conf_data = json_decode($conf, true);
		$host = $conf_data['host_name'];
		$user_name = $conf_data['user_name'];
		$password = $conf_data['user_password'];
		$database = $conf_data['database_name'];
		$db_name = $database;


		if (!$this->conn) {
			$this->mysql = new mysqli($host, $user_name, $password, $database);
			$this->conn = true;
			if ($this->mysql->connect_error) {
			array_push($this->result, array('status' => 'Connection Error'));
				return false;
			} else {
				array_push($this->result, array('status' => 'Database Connected Successfully'));
			}
		} else {
			return true;
		}
	}





/*___________________________________
      INSERT USERS DATABASE
___________________________________*/

	public function insertData($data = null) {
		if ($data) {
			$query = $this->mysql->query($data);
			if ($query) {
				return array ('status' => 'Inserted');
			} else {
				return array ('status' => 'Please Check Your SQL');
			}
		}
	}

/*___________________________________
      SELECT USERS DATABASE
___________________________________*/

	public function selectData($data = null) {
		if ($data) {
			$query = $this->mysql->query($data);
			$getData = $query->fetch_array();
			return $getData;
		}
	}

/*___________________________________
      EXIST USERS DATABASE
___________________________________*/

	public function existData($data = null) {
		if ($data) {
			$query = $this->mysql->query($data);
			if ($query->fetch_array() > 0) {
				return true;
			} else {
				return false;
			}
		}
	}

/*___________________________________
     UPDATE USERS DATABASE
____________________________________*/

	public function updateData($data = null) {
		if ($data) {
			$query = $this->mysql->query($data);
			if ($query) {
				return true;
			} else {
				return false;
			}
		} else {
			return 'Please Insert SQL Query ';
		}
	}


/*___________________________________
   CHECK IF CONNECTION ESTABLISHED 
___________________________________*/

public function check(){
	$res = $this->result;
	echo $res[0]['status'];
	}


/*____________________________________
      IF TABLE EXIST IN DATABASE 
____________________________________*/

public function existTable($table_name = null){
	if($table_name){
		$sql = "SHOW TABLES FROM $this->db_name LIKE '$table_name'";
	$tableInDb = $this->mysql->query($sql);
		if($tableInDb->num_rows == 6){
			echo "Table In This Database";
		}else{
			echo "(".$table_name.") Doesn't Exist In This Database ";
		}
	}
}


}
?>