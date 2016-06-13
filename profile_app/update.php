<?php
    // DATABASE CONNECTION
    $servername = "localhost";
    $username   = "root";
    $password   = "mindfire";
    $database   = "registration";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message=." . $conn->connect_error);
        exit();
    }
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $prefix = test_input($_POST["prefix"]);
    
    $firstName = test_input($_POST["firstName"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
        $nameErr = "Only letters and white space allowed is allowed in the first name field";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
        exit();
    }
    
    $middleName = test_input($_POST["middleName"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/", $middleName)) {
        $nameErr = "Only letters and white space allowed is allowed in the middle name field";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
        exit();
    }
    
    $lastName = test_input($_POST["lastName"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
        $nameErr = "Only letters and white space allowed is allowed in the last name field";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
        exit();
    }
    
    $gender = test_input($_POST["gender"]);
    
    $dob = test_input($_POST["dob"]);
    
    $mobile = test_input($_POST["mobile"]);
    
    if (!preg_match("/^[0-9]*$/", $mobile)) {
        $nameErr = "Only numbers are allowed in the mobile field";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
        exit();
    }
    
    $landline = test_input($_POST["landline"]);
    
    if (!preg_match("/^[0-9]*$/", $landline)) {
        $nameErr = "Only numbers are allowed in the mobile field";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
        exit();
    }
    
    $email = test_input($_POST["email"]);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $emailErr);
        exit();
    }
    
    $maritalStatus = test_input($_POST["maritalStatus"]);
    
    $employment = test_input($_POST["employment"]);
    
    $employer = test_input($_POST["employer"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/", $employer)) {
        $nameErr = "Only letters and white space allowed is allowed in the employer field";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
        exit();
    }
    
    $photo = "sample path for photo"; // Change it later
    
    $residenceStreet = test_input($_POST["residenceStreet"]);
    
    $residenceCity = test_input($_POST["resedenceCity"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/", $resedenceCity)) {
        $nameErr = "Only letters and white space allowed is allowed in the residence city field";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
        exit();
    }
    
    $residenceState = test_input($_POST["residenceState"]);
    
    $residenceZip = test_input($_POST["residenceZip"]);
    
    if (!preg_match("/^[0-9]*$/", $residenceZip)) {
        $nameErr = "Only numbers are allowed in the residence zip field";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
        exit();
    }
    
    $residenceFax = test_input($_POST["residenceFax"]);
    
    $officeStreet = test_input($_POST["officeStreet"]);
    
    $officeCity = test_input($_POST["officeCity"]);
    
    if (!preg_match("/^[a-zA-Z ]*$/", $officeCity)) {
        $nameErr = "Only letters and white space allowed is allowed in the office city field";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
        exit();
    }
    
    $officeState = test_input($_POST["officeState"]);
    
    $officeZip = test_input($_POST["officeZip"]);
    
    if (!preg_match("/^[0-9]*$/", $officeZip)) {
        $nameErr = "Only numbers are allowed in the office zip field";
        header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
        exit();
    }
    
    $officeFax = test_input($_POST["officeFax"]);
    
    $note = test_input($_POST["note"]);
    
    $commMedium = $_POST["commMed"];
    
    $updateResidenceAdd = "UPDATE address SET street = '" . $residenceStreet . "', city ='" . $residenceCity . "',
                          state = '" . $residenceState . "' , zip = '" . $residenceZip . "', fax = '" . $residenceFax . "' where eid = " . $_GET["userId"] . " && type = 1";
    
    $conn->query($updateResidenceAdd) or header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message=database error" . $conn->connect_error);
    
    $updateOfficeAdd = "UPDATE address SET street = '" . $officeStreet . "', city ='" . $officeCity . "',
                        state = '" . $officeState . "' , zip = '" . $officeZip . "', fax = '" . $officeFax . "' where eid = " . $_GET["userId"] . " && type = 2";
    
    $conn->query($updateOfficeAdd) or header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message=" . " " . $conn->connect_error);
    
    // insert communication medium
    $msg = in_array("msg", $commMedium) ? 1 : 0;
    
    $comEmail = in_array("mail", $commMedium) ? 1 : 0;
    
    $call = in_array("phone", $commMedium) ? 1 : 0;
    
    $any = in_array("any", $commMedium) ? 1 : 0;
    
    $updateCommMedium = "UPDATE commMedium SET msg ='" . $msg . "' , email ='" . $comEmail . "' , `call` ='" . $call . "' , any ='" . $any . "' where empId =" . $_GET["userId"];
    
    $conn->query($updateCommMedium) or header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message=" . " " . $conn->connect_error);
    
    
    $updateEmpDetails = "UPDATE employee SET prefix = '" . $prefix . "' , firstName = '" . $firstName . "' , middleName = '" . $middleName . "' , lastName = '" . $lastName . "' ,  gender = '" . $gender . "' , dob = '" . $dob . "' , mobile = '" . $mobile . "' , landline='" . $landline . "', email ='" . $email . "', maritalStatus= '" . $maritalStatus . "' , employment = '" . $employment . "' , employer='" . $employer . "' , photo = '" . $photo . "' , note= '" . $note . "' where eid = " . $_GET["userId"];
    
    $conn->query($updateEmpDetails) or header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message=" . " " . $conn->connect_error);
    
    header("Location:http://localhost/project/mindfire/profile_app/register.php");
?>