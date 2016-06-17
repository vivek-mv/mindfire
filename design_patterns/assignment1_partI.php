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

	$myDbConn = new DbConnect();
	?>