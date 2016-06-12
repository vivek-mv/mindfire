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

	$photo="sample path for photo"; // Change it later

	$residenceStreet=$_POST["residenceStreet"];

	$residenceCity=$_POST["resedenceCity"];

	$residenceState=$_POST["residenceState"];

	$residenceZip=$_POST["residenceZip"];

	$residenceFax=$_POST["residenceFax"];

	$officeStreet=$_POST["officeStreet"];

	$officeCity=$_POST["officeCity"];

	$officeState=$_POST["officeState"];

	$officeZip=$_POST["officeZip"];

	$officeFax=$_POST["officeFax"];

	$note=$_POST["note"];

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