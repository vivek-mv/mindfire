<?php
	require_once('assignment1_partI.php');
	//Class to check the db connection
	Class CheckDbConn {
		//This function checks if there is already a db conn. obj. is present 
		//if not, then it creates one and returns the same
		public function checkDbConn() {
			if( DbConnect::$conn == "" ) {
				$servername = "localhost";
				$username = "root";
				$password = "mindfire";
				$dbname = "registration";

				// Create connection
				$newDbConn= new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if ($newDbConn->connect_error) {
				    echo "Connection failed: " . $conn->connect_error;
				}else {
					return $newDbConn;
				}
			}else {
				return DbConnect::$conn;
			}
		}
	}

	$checkDb = new CheckDbConn;
	$dbConn = $checkDb->checkDbConn();
	var_dump($dbConn);
?>