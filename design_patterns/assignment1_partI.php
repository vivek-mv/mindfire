<?php 
	//Class to make db connection
	Class DbConnect {
		//Static member variable to hold the connection object
		public static $conn = "";
		private $servername = "localhost";
		private	$username = "root";
		private $password = "mindfire";
		private $dbname = "registration";

		function __construct() {

			// Create connection
			self::$conn = new mysqli($this->servername, $this->username ,$this->password,$this->dbname);
			// Check connection
			if (self::$conn->connect_error) {
			    echo "Connection failed: " . $conn->connect_error;
			}
		}
	}

	$myDbConn = new DbConnect();
	?>