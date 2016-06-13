<?php
	// DATABASE CONNECTION
	$servername = "localhost";
	$username = "root";
	$password = "mindfire";
	$database="registration";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
		header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message=.".$conn->connect_error);
	    exit();
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	
	$prefix=test_input($_POST["prefix"]);

	$firstName=test_input($_POST["firstName"]);
	
	$middleName=test_input($_POST["middleName"]);

	$lastName=test_input($_POST["lastName"]);

	$gender=test_input($_POST["gender"]);

	$dob=test_input($_POST["dob"]);

	$mobile=test_input($_POST["mobile"]);

	$landline=test_input($_POST["landline"]);

	$email=test_input($_POST["email"]);

	$maritalStatus=test_input($_POST["maritalStatus"]);

	$employment=test_input($_POST["employment"]);

	$employer=test_input($_POST["employer"]);

	$photo="sample path for photo"; // Change it later

	$residenceStreet=test_input($_POST["residenceStreet"]);

	$residenceCity=test_input($_POST["resedenceCity"]);

	$residenceState=test_input($_POST["residenceState"]);

	$residenceZip=test_input($_POST["residenceZip"]);

	$residenceFax=test_input($_POST["residenceFax"]);

	$officeStreet=test_input($_POST["officeStreet"]);

	$officeCity=test_input($_POST["officeCity"]);

	$officeState=test_input($_POST["officeState"]);

	$officeZip=test_input($_POST["officeZip"]);

	$officeFax=test_input($_POST["officeFax"]);

	$note=test_input($_POST["note"]);

	$commMedium=$_POST["commMed"];

	$updateResidenceAdd = "UPDATE address SET street = '".$residenceStreet."', city ='".$residenceCity."',
						  state = '".$residenceState."' , zip = '".$residenceZip."', fax = '".$residenceFax.
						  "' where eid = ".$_GET["userId"]." && type = 1" ;
					  
	$conn->query($updateResidenceAdd) or header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message=database error".$conn->connect_error);

	$updateOfficeAdd = "UPDATE address SET street = '".$officeStreet."', city ='".$officeCity."',
						state = '".$officeState."' , zip = '".$officeZip."', fax = '".$officeFax.
						"' where eid = ".$_GET["userId"]." && type = 2" ;

	$conn->query($updateOfficeAdd) or header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message="." ".$conn->connect_error);

	// insert communication medium
	$msg=in_array("msg", $commMedium) ? 1 : 0;

	$comEmail=in_array("mail", $commMedium) ? 1 : 0;

	$call=in_array("phone", $commMedium) ? 1 : 0;

	$any=in_array("any", $commMedium) ? 1 : 0;

	$updateCommMedium="UPDATE commMedium SET msg ='".$msg."' , email ='".$comEmail."' , `call` ='".$call."' , any ='".$any."' where empId =".$_GET["userId"];
	
	$conn->query($updateCommMedium) or header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message="." ".$conn->connect_error);


	$updateEmpDetails="UPDATE employee SET prefix = '".$prefix."' , firstName = '".$firstName."' , middleName = '".$middleName.
					   "' , lastName = '".$lastName."' ,  gender = '".$gender."' , dob = '".$dob."' , mobile = '".$mobile."' , landline='".$landline.
					   "', email ='".$email."', maritalStatus= '".$maritalStatus."' , employment = '".$employment."' , employer='".$employer.
					   "' , photo = '".$photo."' , note= '".$note."' where eid = ".$_GET["userId"];

	$conn->query($updateEmpDetails) or header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message="." ".$conn->connect_error);

	header("Location:http://localhost/project/mindfire/profile_app/register.php");
?>