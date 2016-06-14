<?php
    require_once('db_conn.php');
    
    //Display error message if delete fails
    if (isset($_GET["Message"])) {
        echo "Sorry delete failed !, please try after some time ";
    }
    
    if (isset($_GET["userAction"]) && $_GET["userAction"] == "delete") {
        //Write a query to delete a row from the registration database with the respective employee id
        $deleteAddress = "DELETE FROM address WHERE eid=" . $_GET["userId"] . ";";
        
        $deleteCommMode = "DELETE FROM commMedium WHERE empId=" . $_GET["userId"] . ";";
        
        $deleteEmployee = "DELETE FROM employee WHERE eid=" . $_GET["userId"] . ";";

        $deleteImage ="SELECT employee.photo FROM employee WHERE eid=" . $_GET["userId"] . ";";

        $result = mysqli_query($conn, $deleteImage) or 
                    header("Location:http://localhost/project/mindfire/profile_app/register.php?Message= delete failed:(");

        $row = $result->fetch_assoc();

        if ( !unlink("/var/www/html/project/mindfire/profile_app/profile_pic/".$row["photo"]) ) {
          header("Location:http://localhost/project/mindfire/profile_app/register.php?Message= Unable to delete image");
        }
        
        mysqli_query($conn, $deleteAddress) or 
        header("Location:http://localhost/project/mindfire/profile_app/register.php?Message= delete failed:(");
        
        mysqli_query($conn, $deleteCommMode) or 
        header("Location:http://localhost/project/mindfire/profile_app/register.php?Message= delete failed:(");
        
        mysqli_query($conn, $deleteEmployee) or 
        header("Location:http://localhost/project/mindfire/profile_app/register.php?Message= delete failed:(");
    }
    
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
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
            $nameErr = "Only numbers are allowed in the landline field";
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

        if(isset($_FILES['image'])){
          $file_name = $_FILES['image']['name'];
          $file_size =$_FILES['image']['size'];
          $file_tmp =$_FILES['image']['tmp_name'];
          $file_type=$_FILES['image']['type'];
          $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
          
          $expensions= array("jpeg","jpg","png");
          
          if(in_array($file_ext,$expensions)=== false){
             $error="extension not allowed, please choose a JPEG or PNG file.";
             header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $error);exit();
          }
          
          if($file_size > 2097152){
             $error='File size must be excately 2 MB';
             header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $error);exit();
          }
          
          move_uploaded_file($file_tmp,"/var/www/html/project/mindfire/profile_app/profile_pic/".$file_name);
       }
        
        $photo = $file_name;
        
        $residenceStreet = test_input($_POST["residenceStreet"]);
        
        $resedenceCity = test_input($_POST["resedenceCity"]);
        
        if (!preg_match("/^[a-zA-Z ]*$/", $resedenceCity)) {
            $nameErr = "Only letters and white space allowed is allowed in the residence city field";
            header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?valError=" . $nameErr);
            exit();
        }
        
        $resedenceState = test_input($_POST["residenceState"]);
        
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
        
        $commMedium = $_POST["commMed"]; // its array
        
        //insert the employee details
        $query1 = "INSERT INTO employee (`prefix`,`firstName`,`middleName`,`lastName`,`gender`,`dob`,`mobile`,`landline`,`email`,`maritalStatus`,`employment`,
                        `employer`,`photo`,`note`)
                  VALUES ('$prefix','$firstName','$middleName','$lastName','$gender','$dob','$mobile','$landline','$email','$maritalStatus','$employment',
                        '$employer','$photo','$note')";
        
        if ($conn->query($query1) === TRUE) {
            
            $empID = $conn->insert_id;
        } else {
            header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message="
             . " " . $conn->connect_error);
            exit();
        }
        // insert residence and office address
        $query2 = "INSERT INTO address (`eid`,`type`,`street`,`city`,`state`,`zip`,`fax`)
                VALUES ('$empID','1','$residenceStreet','$resedenceCity','$resedenceState','$residenceZip','$residenceFax') ,
                ('$empID','2','$officeStreet','$officeCity','$officeState','$officeZip','$officeFax')";
        if (!$conn->query($query2)) {
            header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message="
             . " " . $conn->connect_error);
            exit();
        }
        
        
        // insert communication medium
        $msg = in_array("msg", $commMedium) ? 1 : 0;
        
        $comEmail = in_array("mail", $commMedium) ? 1 : 0;
        
        $call = in_array("phone", $commMedium) ? 1 : 0;
        
        $any = in_array("any", $commMedium) ? 1 : 0;
        
        $query4 = "INSERT INTO commMedium (`empId`,`msg`,`email`,`call`,`any`)
                VALUES ('$empID','$msg','$comEmail','$call','$any')";
        //Change here,make it a sigle if
        if (!$conn->query($query4)) {
            header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message="
             . " " . $conn->connect_error);
            exit();
        }
    }
?>
<!-- make this page responsive -->
<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Registered Employees</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

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
                        <li><a href="http://localhost/project/mindfire/profile_app/registration_form.php">SIGN UP</a>
                        </li>
                        <li><a href="#">LOG IN</a>
                        </li>
                        <li><a href="http://localhost/project/mindfire/profile_app/register.php">DETAILS</a>
                        </li>
                    </ul>
                </div>

        </nav>

        <div class="row">
            <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
                <h2>Registered Employees</h2>
          		<?php
                $query4 = "SELECT employee.eid , employee.firstName , employee.middleName , employee.lastName ,employee.gender ,
                            employee.dob , employee.mobile , employee.landline , employee.email , employee.maritalStatus , 
                            employee.employment , employee.employer , commMedium.empId ,commMedium.msg , commMedium.email 
                            AS comm_email, 
                            commMedium.call , commMedium.any ,address.eid , address.type , address.street , address.city ,
                            address.state , address.zip , address.fax 
                            FROM employee JOIN commMedium ON employee.eid = commMedium.empId
                            JOIN address ON  employee.eid = address.eid";
                //Display some some message when no data is present in the table
                $result = mysqli_query($conn, $query4) or 
                           header("Location:http://localhost/project/mindfire/profile_app/registration_form.php?Message= :(");
                $employeeId = 0;
                ?>

                <table class="table table-striped table-responsive">
                    <thead>
                      <tr>
                      	<th>Name</th>
                        <th>Gender</th>
                        <th>D.O.B</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Marital Status</th>
                        <th>Employment </th>
                        <th>Comm. Mode</th>
                        <th title = "Address Residence">Address (R)</th>
                        <th title = "Address Office">Address (O)</th>
                        <th>Update</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tbody>
        	    	<?php
                        while ( $row = $result->fetch_assoc() ) {

                            if ( $employeeId != $row["empId"] ) {
                                echo "<tr>";
                                echo "<td>" . $row["firstName"] . " " . $row["middleName"] . " " . $row["lastName"] . "</td>";

                                if ( $row["gender"] == 'm' ) {
                                    echo "<td>Male</td>";

                                } else if ( $row["gender"] == 'f' ) {
                                    echo "<td>Female</td>";

                                } else {
                                    echo "<td>Others</td>";
                                }

                                echo "<td>" . date_format( new DateTime( $row["dob"] ), 'd-m-Y' ) . "</td>";
                                echo "<td>" . $row["mobile"] . "(M)<br>" . $row["landline"] . "(L)</td>";
                                echo "<td>" . $row["email"] . "</td>";
                                echo "<td>" . ucfirst( $row["maritalStatus"] ) . "</td>";

                                if ( $row["employment"] == 'employed' ) {
                                    echo "<td>" . ucfirst( $row["employment"] ) . " in " . ucfirst( $row["employer"] ) . "</td>";

                                } else {
                                    echo "<td>" . ucfirst( $row["employment"] ) . "</td>";
                                }

                                echo "<td>";

                                if ( $row["msg"] == 1 ) {
                                    echo "Message";
                                }

                                if ( $row["comm_email"] == 1 ) {
                                    echo "<br>Email";
                                }

                                if ( $row["call"] == 1 ) {
                                    echo "<br>Phone";
                                }

                                if ( $row["any"] == 1 ) {
                                    echo "<br>Any";
                                }

                                echo "</td>";
                            }

                            if ( $row["type"] == 1 ) {
                                echo "<td>" . $row["street"] . "<br>" . $row["city"] . "," . $row["zip"] . "<br>" . $row["state"] . "</td>";
                            }

                            if ( $row["type"] == 2 ) {
                                echo "<td>" . $row["street"] . "<br>" . $row["city"] . "," . $row["zip"] . "<br>" . $row["state"] . "</td>";

                                echo "<td><a href='registration_form.php?userId=" . $row["eid"] . "&userAction=update' target='_self' >
                                             <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a></td>";

                                echo "<td><a href='register.php?userId=" . $row["eid"] . "&userAction=delete' target='_self' > 
                                            <span class='glyphicon glyphicon-remove' aria-hidden='true'></span></a></td>";
                            }

                            if ( $employeeId == $row["eid"] ) {
                                echo "</tr>";
                            }

                            $employeeId = $row["empId"];
                        }
                    ?>
        	     
        	        </tbody>
    	        </table>
          	</div>
        </div>
    </body>
</html>



