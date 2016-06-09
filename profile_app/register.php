<?php 
	
	$prefix=$_POST["prefix"];

	$firstName=$_POST["firstName"];

	$middleName=$_POST["middleName"];

	$lastName=$_POST["lastName"];

	$gender=$_POST["gender"];

	$dob=$_POST["dob"];

	$mobile=$_POST["mobile"];

	$landline=$_POST["landline"];

	$email=$_POST["email"];

	$maritalStatus=$_POST["maritalStatus"];

	$employment=$_POST["employment"];

	$employer=$_POST["employer"];

	$photo="sample path for photo"; // change it later

	$residenceStreet=$_POST["residenceStreet"];

	$resedenceCity=$_POST["resedenceCity"];

	$resedenceState=$_POST["resedenceCity"];

	$residenceZip=$_POST["residenceZip"];

	$residenceFax=$_POST["residenceFax"];

	$officeStreet=$_POST["officeStreet"];

	$officeCity=$_POST["officeCity"];

	$officeState=$_POST["officeState"];

	$officeZip=$_POST["officeZip"];

	$officeFax=$_POST["officeFax"];

	$note=$_POST["note"];

	$commMedium=$_POST["commMed"]; //its array

	// DATABASE CONNECTION

	$servername = "localhost";
	$username = "root";
	$password = "mindfire";
	$database="registration";

	// Create connection
	$conn = new mysqli( $servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";

	//insert the employee details

	$query1 = "INSERT INTO employee (`prefix`,`firstName`,`middleName`,`lastName`,`gender`,`dob`,`mobile`,`landline`,`email`,`maritalStatus`,`employment`,
					`employer`,`photo`,`note`)
			VALUES ('$prefix','$firstName','$middleName','$lastName','$gender','$dob','$mobile','$landline','$email','$maritalStatus','$employment',
					'$employer','$photo','$note')";
			if ($conn->query($query1) === TRUE) {
			    echo "New record created successfully";
			     $empID= $conn->insert_id;
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			    exit();
			}
			

	// insert residence address
	$query2 = "INSERT INTO address (`eid`,`type`,`street`,`city`,`state`,`zip`,`fax`)
			VALUES ('$empID','1','$residenceStreet','$resedenceCity','$resedenceState','$residenceZip','$residenceFax')";
			if ($conn->query($query2) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

	// insert office address
	$query3 = "INSERT INTO address (`eid`,`type`,`street`,`city`,`state`,`zip`,`fax`)
			VALUES ('$empID','2','$officeStreet','$officeCity','$officeState','$officeZip','$officeFax')";
			if ($conn->query($query3) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

	// insert communication medium
	$msg=in_array("msg", $commMedium) ? 1 : 0;

	$comEmail=in_array("mail", $commMedium) ? 1 : 0;

	$call=in_array("phone", $commMedium) ? 1 : 0;

	$any=in_array("any", $commMedium) ? 1 : 0;

	$query3 = "INSERT INTO commMedium (`empId`,`msg`,`email`,`call`,`any`)
			VALUES ('$empID','$msg','$comEmail','$call','$any')";
			if ($conn->query($query3) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

?>
