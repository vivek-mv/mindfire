<?php
    //Include Database Connection
    require_once('db_conn.php');
    //Include Constants file 
    require_once('constants.php');

    //Check for any error messages from details page
    if (!empty($_REQUEST['Message'])) {
        echo "Sorry , something bad happened .Please try after some time." . $_REQUEST['Message'];
    }

    $states = array(
        'Andaman and Nicobar Islands',
        'Andhra Pradesh',
        'Arunachal Pradesh',
        'Assam',
        'Bihar',
        'Chandigarh',
        'Chhattisgarh',
        'Dadra and Nagar Haveli',
        'Daman and Diu',
        'Delhi',
        'Goa',
        'Gujarat',
        'Haryana',
        'Himachal Pradesh',
        'Jammu and Kashmir',
        'Jharkhand',
        'Karnataka',
        'Kerala',
        'Lakshadweep',
        'Madhya Pradesh',
        'Maharashtra',
        'Manipur',
        'Meghalaya',
        'Mizoram',
        'Nagaland',
        'Orissa',
        'Pondicherry',
        'Punjab',
        'Rajasthan',
        'Sikkim',
        'Tamil Nadu',
        'Tripura',
        'Uttaranchal',
        'Uttar Pradesh',
        'West Bengal'
    );

    //Validate the input fields only if the request method is POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Initialize error to check for any errors that occur during validation
        $error=0;
        
         /**
         * Performs validation for the form input fields
         *
         * @access public
         * @param string $data
         * @return string
         */
        function validate($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        $prefix = validate($_POST["prefix"]);
        $firstName = validate($_POST["firstName"]);
        
        if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
            $firstnameErr = "Only letters and white space allowed";
            $error++;
        }
        
        $middleName = validate($_POST["middleName"]);
        
        if (!preg_match("/^[a-zA-Z ]*$/", $middleName)) {
            $middleNameErr = "Only letters and white space allowed"; 
            $error++; 
        }
        
        $lastName = validate($_POST["lastName"]);
        
        if (!preg_match("/^[a-zA-Z ]*$/", $lastName)) {
            $lastNameErr = "Only letters and white space allowed";
            $error++;
        }
        
        $gender = validate($_POST["gender"]);
        $dob = validate($_POST["dob"]);
        $mobile = validate($_POST["mobile"]);
        
        if (!preg_match("/^[0-9]*$/", $mobile)) {
            $mobileErr = "Only numbers are allowed in the mobile field";
            $error++;
        }

        if ( !empty($mobile) && strlen($mobile) != 10 ) {
            $mobileErr = "mobile number should be 10 digits";
            $error++;
        }
        
        $landline = validate($_POST["landline"]);
        
        if (!preg_match("/^[0-9]*$/", $landline)) {
            $landlineErr = "Only numbers are allowed in the landline field";
            $error++;
        }

        if ( !empty($landline) && strlen($landline) != 10 ) {
            $landlineErr = "landline number should be 10 digits";
            $error++;
        }
        
        $email = validate($_POST["email"]);
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $error++;
        }
        
        $maritalStatus = validate($_POST["maritalStatus"]);
        $employment = validate($_POST["employment"]);
        $employer = validate($_POST["employer"]);
        
        if (!preg_match("/^[a-zA-Z ]*$/", $employer)) {
            $employerErr = "Only letters and white space allowed";
            $error++;
        }

        //Set photo to empty string in case no image is provided by the user
        $photo="";

        if( isset($_FILES['image']) && !empty($_FILES['image']['name']) && $_FILES['image']['size'] != 0 ){
          $file_name = $_FILES['image']['name'];
          $file_size =$_FILES['image']['size'];
          $file_tmp =$_FILES['image']['tmp_name'];
          $file_type=$_FILES['image']['type'];
          $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
          
          $extensions= array("jpeg","jpg","png");
          
          if(in_array($file_ext,$extensions)=== false){
            $imageErr="extension not allowed, please choose a JPEG or PNG file.";
            $error++;
          }
          
          if($file_size > 2097152){
             $imageErr='File size must be less than 2 MB';
             $error++;
          }
          $photo = $file_name;
        }
        
        
        
        $residenceStreet = validate($_POST["residenceStreet"]);
        $resedenceCity = validate($_POST["resedenceCity"]);
        
        if (!preg_match("/^[a-zA-Z ]*$/", $resedenceCity)) {
            $residenceCityErr = "Only letters and white space allowed";
            $error++;
        }
        
        $resedenceState = validate($_POST["residenceState"]);
        $residenceZip = validate($_POST["residenceZip"]);
        
        if (!preg_match("/^[0-9]*$/", $residenceZip)) {
            $residenceZipErr = "Only numbers are allowed";
            $error++;
        }

        if ( !empty($residenceZip) && strlen($residenceZip) != 6 ) {
            $residenceZipErr = "zip number should be 6 digits";
            $error++;
        }
        
        $residenceFax = validate($_POST["residenceFax"]);
        $officeStreet = validate($_POST["officeStreet"]);
        $officeCity = validate($_POST["officeCity"]);
        
        if (!preg_match("/^[a-zA-Z ]*$/", $officeCity)) {
            $officeCityErr = "Only letters and white space allowed";
            $error++;
        }
        
        $officeState = validate($_POST["officeState"]);
        $officeZip = validate($_POST["officeZip"]);
        
        if (!preg_match("/^[0-9]*$/", $officeZip)) {
            $officeZipErr = "Only numbers are allowed";
            $error++;
        }

        if ( !empty($officeZip) && strlen($officeZip) != 6 ) {
            $officeZipErr = "zip number should be 6 digits";
            $error++;
        }
        
        $officeFax = validate($_POST["officeFax"]);
        $note = validate($_POST["note"]);

        //Check for Communication Medium,if its empty then assign an empty array
        if( isset($_POST["commMed"]) ) {
           $commMedium = $_POST["commMed"];  
        }else{
            $commMedium=array();
        }
        
        //Insert the user data in the database if there are no errors.
        if( $error == 0 && $_POST["submit"]=="SUBMIT" ) {
            //upload Image
            move_uploaded_file($_FILES['image']['tmp_name'],APP_PATH."/profile_pic/".$_FILES['image']['name']);
            //insert the employee details
            $insertEmp = "INSERT INTO employee (`prefix`,`firstName`,`middleName`,`lastName`,`gender`,`dob`,`mobile`,
                `landline`,`email`,`maritalStatus`,`employment`,
                `employer`,`photo`,`note`)
                VALUES ('$prefix','$firstName','$middleName','$lastName','$gender','$dob','$mobile','$landline',
                '$email','$maritalStatus','$employment',
                '$employer','$photo','$note')";
            
            //Get the last insert id as empId to insert address and comm. medium
            if ($conn->query($insertEmp) === TRUE) {
                $empID = $conn->insert_id;
            } else {
                header("Location:registration_form.php?Message="
                 . " " . $conn->connect_error);
                exit();
            }
            // insert residence and office address
            $insertAdd = "INSERT INTO address (`eid`,`type`,`street`,`city`,`state`,`zip`,`fax`)
                    VALUES ('$empID','1','$residenceStreet','$resedenceCity','$resedenceState','$residenceZip','$residenceFax') ,
                    ('$empID','2','$officeStreet','$officeCity','$officeState','$officeZip','$officeFax')";
            if (!$conn->query($insertAdd)) {
                header("Location:registration_form.php?Message="
                 . " " . $conn->connect_error);
                exit();
            }
            
            // insert communication medium
            $msg = in_array("msg", $commMedium) ? 1 : 0;
            $comEmail = in_array("mail", $commMedium) ? 1 : 0;
            $call = in_array("phone", $commMedium) ? 1 : 0;
            $any = in_array("any", $commMedium) ? 1 : 0;
            $insertCommMedium = "INSERT INTO commMedium (`empId`,`msg`,`email`,`call`,`any`)
                VALUES ('$empID','$msg','$comEmail','$call','$any')";
            
            if (!$conn->query($insertCommMedium)) {
                header("Location:registration_form.php?Message="
                 . " " . $conn->connect_error);
                exit();
            }

            //If successfully inserted ,then redirect to details page
            header("Location:details.php");
        }

        //If there are no errors and submit name is update
        if( $error == 0 && $_POST["submit"]=="UPDATE" ) {

            if( isset($_FILES['image']) && !empty($_FILES['image']['name']) && $_FILES['image']['size'] != 0) {
                move_uploaded_file($_FILES['image']['tmp_name'],APP_PATH ."/profile_pic/".$_FILES['image']['name']);

                $image ="SELECT employee.photo FROM employee WHERE eid=" . $_GET["userId"] . ";";

                $result = mysqli_query($conn, $image) or 
                header("Location:details.php?Message= delete failed:(");

                $row = $result->fetch_assoc();

                if ( !unlink(APP_PATH."/profile_pic/".$row["photo"]) ) {
                  header("Location:details.php?Message= Unable to delete image");
                }
            }

            //update residence address
            $updateResidenceAdd = "UPDATE address SET street = '" . $residenceStreet . "', city ='" . $resedenceCity . "',
            state = '" . $resedenceState . "' , zip = '" . $residenceZip . "', fax = '" .$residenceFax .
            "' where eid = " . $_GET["userId"] . " && type = 1";
            $conn->query($updateResidenceAdd) or header("Location:registration_form.php?Message=database error" . $conn->connect_error);
            
            //update office address
            $updateOfficeAdd = "UPDATE address SET street = '" . $officeStreet . "', city ='" . $officeCity . "',
                            state = '" . $officeState . "' , zip = '" . $officeZip . "', fax = '" . $officeFax .
                            "' where eid = " . $_GET["userId"] . " && type = 2";
            $conn->query($updateOfficeAdd) or header("Location:registration_form.php?Message=" . " " . $conn->connect_error);
            
            // update communication medium
            $msg = in_array("msg", $commMedium) ? 1 : 0;
            $comEmail = in_array("mail", $commMedium) ? 1 : 0;
            $call = in_array("phone", $commMedium) ? 1 : 0;
            $any = in_array("any", $commMedium) ? 1 : 0;
            
            $updateCommMedium = "UPDATE commMedium SET msg ='" . $msg . "' , email ='" . $comEmail . "',
                `call` ='" . $call . "' , any ='" . $any . "' where empId =" . $_GET["userId"];
            $conn->query($updateCommMedium) or header("Location:registration_form.php?Message=" . " " . $conn->connect_error);
            
            //If photo is empty then dont update photo
            if( empty($photo) ) {
                $insertImage ="";
            }else {
                $insertImage = ", photo = '".$photo."'";
            }
            //update employee details
            $updateEmpDetails = "UPDATE employee SET prefix = '" . $prefix . "' , firstName = '" . $firstName . "' , 
                middleName = '" . $middleName . "' , lastName = '" . $lastName . "' ,  gender = '" . $gender .
                "' , dob = '" . $dob . "' , mobile = '" . $mobile . "' , landline='" . $landline . "', email ='" 
                . $email . "', maritalStatus= '" . $maritalStatus . "' ,employment = '" . $employment . "' ,
                employer='" . $employer ."'".$insertImage . ",note= '" . $note . "' where eid = " 
                . $_GET["userId"];
                
            $conn->query($updateEmpDetails) or header("Location:registration_form.php?Message=" . " " . $conn->connect_error);
            
            //If update is successfull then redirect to details page
            header("Location:details.php");
        }
    }

    //When user clicks the update button in the details page,then this code is executed
    if (isset($_GET["userId"]) && isset($_GET["userAction"]) ) {
        $selectEmpDetails = "SELECT employee.eid, employee.prefix, employee.firstName, employee.middleName, 
            employee.lastName, employee.gender, employee.dob, employee.mobile, employee.landline, employee.email,
            employee.maritalStatus, employee.employment, employee.employer, employee.note, employee.photo,
            commMedium.empId, commMedium.msg, commMedium.email AS comm_email, commMedium.call , commMedium.any 
            FROM employee JOIN commMedium ON employee.eid = commMedium.empId WHERE eid =" . $_GET["userId"];

        $residenceAddress = "SELECT address.eid , address.type , address.street , address.city ,
            address.state , address.zip , address.fax FROM address
            WHERE address.eid =" . $_GET["userId"] . " AND address.type = 1";

        $officeAddress = "SELECT address.eid , address.type , address.street , address.city ,
            address.state , address.zip , address.fax FROM address
            WHERE address.eid =" . $_GET["userId"] . " AND address.type = 2";

        $result1 = mysqli_query($conn, $selectEmpDetails) or 
            header("Location:registration_form.php?Message= :(");
        $empDetails = $result1->fetch_assoc();

        $result2 = mysqli_query($conn, $residenceAddress) or 
            header("Location:registration_form.php?Message= :(");
        $empResidence = $result2->fetch_assoc();

        $result3 = mysqli_query($conn, $officeAddress) or 
            header("Location:registration_form.php?Message= :(");
        $empOffice = $result3->fetch_assoc();        
        
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Form</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
            integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <style type="text/css">
            .error{
                color: red;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" 
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">VIVEK</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="registration_form.php">SIGN UP</a></li>
                        <li><a href="#">LOG IN</a></li>
                        <li><a href="details.php">DETAILS</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
        <h1><?php 
                if( isset($_GET['userAction']) && $_GET['userAction']=='update' ) {
                    echo "Please edit your data";
                }else {
                    echo "REGISTER";
                }
            ?>
        </h1>
        <form action=<?php if( isset($_GET['userAction']) && $_GET['userAction']=='update' ) 
        {echo 'registration_form.php?userId='.$_GET["userId"]; } else {echo 'registration_form.php';} ?> method="post" 
        role="form" class="form-horizontal" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <fieldset>
                        <legend>Personal Details</legend>
                        <div class="well">
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="selectbasic1">Prefix</label>
                                <div class="col-md-7">
                                    <select id="selectbasic1" name="prefix" class="form-control" >
                                        <option value="mr" <?php if ( isset($empDetails["prefix"]) && $empDetails["prefix"]=="mr") echo 'selected="selected"'; ?> >Mr</option>
                                        <option value="mis" <?php if ( isset($empDetails["prefix"]) && $empDetails["prefix"]=="mis") echo 'selected="selected"'; ?> >Miss</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="firstName">First Name</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($firstnameErr) ) echo "*".$firstnameErr;?></span>
                                    <input  name="firstName" type="text" placeholder="First Name" class="form-control input-md" 
                                        <?php if( isset($empDetails["firstName"]) ) echo 'value="'.$empDetails["firstName"].'"';
                                        if( isset($firstName) ) echo 'value='.$firstName;?> required>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="middleName">Middle Name</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($middleNameErr) ) echo "*".$middleNameErr;?></span>
                                    <input  name="middleName" type="text" placeholder="Middle Name" class="form-control input-md"
                                        <?php if( isset($empDetails["middleName"]) ) echo 'value="'.$empDetails["middleName"].'"'; 
                                        if( isset($middleName) ) echo 'value='.$middleName;?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="lastName">Last Name</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($lastNameErr) ) echo "*".$lastNameErr;?></span>
                                    <input  name="lastName" type="text" placeholder="Last Name" class="form-control input-md" 
                                        <?php if( isset($empDetails["lastName"]) ) echo 'value="'.$empDetails["lastName"].'"'; 
                                        if( isset($lastName) ) echo 'value='.$lastName;?> >
                                </div>
                            </div>
                            <!-- Multiple Radios (inline) -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="gender">Gender</label>
                                <div class="col-md-7"> 
                                    <label class="radio-inline">
                                    <input type="radio" name="gender" value="m" checked="checked">
                                    Male
                                    </label> 
                                    <label class="radio-inline">
                                    <input type="radio" name="gender" value="f" 
                                        <?php if( isset($empDetails["gender"]) && $empDetails["gender"]=="f") echo 'checked="checked"'; ?> >
                                    Female
                                    </label> 
                                    <label class="radio-inline">
                                    <input type="radio" name="gender" value="o"
                                        <?php if( isset($empDetails["gender"]) && $empDetails["gender"]=="o") echo 'checked="checked"'; ?> >
                                    Other
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="datepicker">D.O.B</label>  
                                <div class="col-md-7">
                                    <input name="dob" type="date" placeholder="D.O.B" class="form-control input-md" 
                                        <?php if( isset($empDetails["dob"]) ) echo 'value="'.$empDetails["dob"].'"'; ?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="phone">Moblie</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($mobileErr) ) echo "*".$mobileErr;?></span>
                                    <input  name="mobile" type="text" placeholder="9999-9999-9999" class="form-control input-md"
                                        <?php if( isset($empDetails["mobile"]) ) echo 'value="'.$empDetails["mobile"].'"'; 
                                        if( isset($mobile) ) echo 'value='.$mobile;?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="phone">Landline</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($landlineErr) ) echo "*".$landlineErr;?></span>
                                    <input  name="landline" type="text" placeholder="9999-9999999" class="form-control input-md"
                                        <?php if( isset($empDetails["landline"]) ) echo 'value="'.$empDetails["landline"].'"'; 
                                        if( isset($landline) ) echo 'value='.$landline;?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="firstName">Email</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($emailErr) ) echo "*".$emailErr;?></span>
                                    <input  name="email" type="email" placeholder="example@mail.com" class="form-control input-md"
                                        <?php if( isset($empDetails["email"]) ) echo 'value="'.$empDetails["email"].'"'; 
                                        if( isset($email) ) echo 'value='.$email;?>  required>
                                </div>
                            </div>
                            <!-- Multiple Radios (inline) -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="m_status">Marital Status</label>
                                <div class="col-md-7"> 
                                    <label class="radio-inline">
                                    <input type="radio" name="maritalStatus" value="married" checked="checked">
                                    Married
                                    </label> 
                                    <label class="radio-inline">
                                    <input type="radio" name="maritalStatus" value="unmarried"
                                        <?php if( isset($empDetails["maritalStatus"]) && $empDetails["maritalStatus"]=="unmarried") echo 'checked="checked"'; ?> >
                                    Unmarried
                                    </label> 
                                </div>
                            </div>
                            <!-- Multiple Radios (inline) -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="employment">Employment</label>
                                <div class="col-md-7"> 
                                    <label class="radio-inline">
                                    <input type="radio" name="employment" value="employed" checked="checked">
                                    Employed
                                    </label> 
                                    <label class="radio-inline">
                                    <input type="radio" name="employment" value="unemployed"
                                        <?php if( isset($empDetails["employment"]) && $empDetails["employment"]=="unemployed") echo 'checked="checked"'; ?>>
                                    Unemployed
                                    </label> 
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="employer">Employer</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($employerErr) ) echo "*".$employerErr;?></span>
                                    <input  name="employer" type="text" placeholder="Employer" class="form-control input-md"
                                        <?php if( isset($empDetails["employer"]) ) echo 'value="'.$empDetails["employer"].'"'; 
                                        if( isset($employer) ) echo 'value='.$employer;?> >
                                </div>
                            </div>
                            <!-- File Button --> 
                            <div class="form-group">
                                <label class="col-md-3 control-label">Upload Photo</label>
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($imageErr) ) echo "*".$imageErr;?></span>
                                    <input  name="image" class="input-file" type="file" 
                                    <?php 
                                        if( isset($empDetails["photo"]) && !empty($empDetails["photo"]) ) {
                                            echo 'filename='.$empDetails["photo"];
                                        }
                                    ?> >
                                    <?php if( isset($empDetails["photo"]) && !empty($empDetails["photo"]) ) 
                                            echo '<img src="profile_pic/'.$empDetails["photo"].'"  alt="profile pic" 
                                                height="200" width="200" />'; ?>
                                    
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <fieldset>
                        <legend>Residence Address</legend>
                        <div class="well">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Street</label>  
                                <div class="col-md-7">
                                    <input  name="residenceStreet" type="text" placeholder="Street" class="form-control input-md"
                                        <?php if( isset($empResidence["street"]) ) echo 'value="'.$empResidence["street"].'"'; 
                                        if( isset($residenceStreet) ) echo 'value='.$residenceStreet;?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >City</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($residenceCityErr) ) echo "*".$residenceCityErr;?></span>
                                    <input  name="resedenceCity" type="text" placeholder="City" class="form-control input-md"
                                        <?php if( isset($empResidence["city"]) ) echo 'value="'.$empResidence["city"].'"'; 
                                        if( isset($resedenceCity) ) echo 'value='.$resedenceCity;?> >
                                </div>
                            </div>
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >State</label>
                                <div class="col-md-7">
                                    <select name="residenceState" class="form-control" value="Arunachal Pradesh">
                                        <option value="">Select State</option>
                                        <?php
                                            foreach ($states as $state_name) {
                                                 echo '<option value="' . $state_name . '" ' 
                                                    . (( isset($empResidence["state"]) 
                                                        && $empResidence["state"]==$state_name ) 
                                                    ? ('selected="selected"') : ('')) . '>' 
                                                    . $state_name . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Zip</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($residenceZipErr) ) echo "*".$residenceZipErr;?></span>
                                    <input name="residenceZip" type="text" placeholder="Zip" class="form-control input-md"
                                        <?php if( isset($empResidence["zip"]) ) echo 'value="'.$empResidence["zip"].'"'; 
                                        if( isset($residenceZip) ) echo 'value='.$residenceZip;?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Fax</label>  
                                <div class="col-md-7">
                                    <input name="residenceFax" type="text" placeholder="Fax" class="form-control input-md"
                                        <?php if( isset($empResidence["fax"]) ) echo 'value="'.$empResidence["fax"].'"'; 
                                        if( isset($residenceFax) ) echo 'value='.$residenceFax;?> >
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Office Address</legend>
                        <div class="well">
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Street</label>  
                                <div class="col-md-7">
                                    <input  name="officeStreet" type="text" placeholder="Street" class="form-control input-md"
                                        <?php if( isset($empOffice["street"]) ) echo 'value="'.$empOffice["street"].'"'; 
                                        if( isset($officeStreet) ) echo 'value='.$officeStreet;?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >City</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($officeCityErr) ) echo "*".$officeCityErr;?></span>
                                    <input  name="officeCity" type="text" placeholder="City" class="form-control input-md"
                                        <?php if( isset($empOffice["city"]) ) echo 'value="'.$empOffice["city"].'"'; 
                                        if( isset($officeCity) ) echo 'value='.$officeCity;?> >
                                </div>
                            </div>
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >State</label>
                                <div class="col-md-7">
                                    <select name="officeState" class="form-control">
                                        <option value="">Select State</option>
                                        <?php
                                            foreach ($states as $state_name) {
                                                 echo '<option value="' . $state_name . '" ' 
                                                    . (( isset($empOffice["state"]) 
                                                        && $empOffice["state"]==$state_name ) 
                                                    ? ('selected="selected"') : ('')) . '>' 
                                                    . $state_name . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Zip</label>  
                                <div class="col-md-7">
                                    <span class="error"> <?php if( !empty($officeZipErr) ) echo "*".$officeZipErr;?></span>
                                    <input name="officeZip" type="text" placeholder="Zip" class="form-control input-md"
                                        <?php if( isset($empOffice["zip"]) ) echo 'value="'.$empOffice["zip"].'"'; 
                                        if( isset($officeZip) ) echo 'value='.$officeZip;?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Fax</label>  
                                <div class="col-md-7">
                                    <input name="officeFax" type="text" placeholder="Fax" class="form-control input-md"
                                        <?php if( isset($empOffice["fax"]) ) echo 'value="'.$empOffice["fax"].'"'; 
                                        if( isset($officeFax) ) echo 'value='.$officeFax;?> >
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <fieldset>
                        <legend>Other Details</legend>
                        <div class="well">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <!-- Textarea -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label" for="textarea">Note</label>
                                        <div class="col-md-7">                     
                                            <textarea class="form-control" id="note" name="note" rows="3"
                                            ><?php if( isset($empDetails["note"]) ) echo $empDetails["note"]; 
                                            if( isset($note) ) echo $note;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                    <div class="row">
                                        <div class="col-xs-1 col-sm-2 col-md-2 col-lg-2">
                                            <label>Communication medium:</label>
                                        </div>
                                        <div class="col-xs-9 col-sm-8 col-md-8 col-lg-8 col-md-offset-2 col-lg-offset-2">
                                            <div class="checkbox-inline">
                                                <input type="checkbox" id="mail" name="commMed[]" value="mail"
                                                    <?php if( isset($empDetails["comm_email"]) && $empDetails["comm_email"]=="1") echo 'checked'; ?> >
                                                <label for="mail">Mail</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <input type="checkbox" id="message" name="commMed[]" value="msg"
                                                    <?php if( isset($empDetails["msg"]) && $empDetails["msg"]=="1") echo 'checked'; ?> >
                                                <label for="message">Message</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <input type="checkbox" id="phone" name="commMed[]" value="phone"
                                                    <?php if( isset($empDetails["call"]) && $empDetails["call"]=="1") echo 'checked'; ?> >
                                                <label for="phone">Phone</label>
                                            </div>
                                            <div class="checkbox-inline">
                                                <input type="checkbox" id="any" name="commMed[]" value="any" 
                                                    <?php if( isset($empDetails["any"]) && $empDetails["any"]=="1") echo 'checked'; ?> >
                                                <label for="any">Any</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
                <div class="row text-center">
                    <input type="submit" name="submit" value=
                        <?php if( isset($_GET['userAction']) && $_GET['userAction']=='update' ) {echo 'UPDATE'; } else {echo 'SUBMIT';} ?> class="btn btn-primary"> &nbsp;  &nbsp;  &nbsp;
                    <input type= <?php if( isset($_GET['userAction']) && $_GET['userAction']=='update' ) {echo 'hidden'; } else {echo 'reset';} ?> name="Reset" class="btn btn-danger">
                </div>
        </form>
        </div>
    </body>
    <html>