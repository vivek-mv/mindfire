<?php 
	//Class to make db connection
	Class DbConnect {
		//Static member variable to hold the connection object
		public static $conn = "";

		function __construct() {
			$servername = "localhost";
			$username = "root";
			$password = "mindfire";
			$dbname = "registration";

			// Create connection
			self::$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if (self::$conn->connect_error) {
			    echo "Connection failed: " . $conn->connect_error;
			}
		}
	}

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
				DbConnect::$conn = new mysqli($servername, $username, $password, $dbname);
				// Check connection
				if (DbConnect::$conn->connect_error) {
				    echo "Connection failed: " . $conn->connect_error;
				}else {
					return DbConnect::$conn;
				}
			}else {
				return DbConnect::$conn;
			}
		}
	}

	$myDbConn = new DbConnect();
	$checkDb = new CheckDbConn;
	$dbConn = $checkDb->checkDbConn();
	var_dump($dbConn);
	?>