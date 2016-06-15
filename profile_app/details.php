<?php
    require_once('db_conn.php');
    require_once('constants.php');
    
    //Display error message if delete fails
    if ( isset($_GET["Message"]) && !empty($_GET["Message"]) ) {
        echo "Sorry delete failed !, please try after some time ";
    }
    
    if (isset($_GET["userAction"]) && $_GET["userAction"] == "delete") {
        //Query to delete a row from the registration database with the respective employee id
        $deleteAddress = "DELETE FROM address WHERE eid=" . $_GET["userId"] . ";";
        $deleteCommMode = "DELETE FROM commMedium WHERE empId=" . $_GET["userId"] . ";";
        $deleteEmployee = "DELETE FROM employee WHERE eid=" . $_GET["userId"] . ";";
        $image ="SELECT employee.photo FROM employee WHERE eid=" . $_GET["userId"] . ";";
        $result = mysqli_query($conn, $image) or 
                    header("Location:details.php?Message= delete failed:(");
        $row = $result->fetch_assoc();
        if ( !empty($row["photo"])  && !unlink(ROOT_IMAGE_PATH."profile_app/profile_pic/".$row["photo"]) ) {
            header("Location:details.php?Message= Unable to delete image");
        }
        mysqli_query($conn, $deleteAddress) or 
            header("Location:details.php?Message= delete failed:(");
        mysqli_query($conn, $deleteCommMode) or 
            header("Location:details.php?Message= delete failed:(");
        mysqli_query($conn, $deleteEmployee) or 
            header("Location:details.php?Message= delete failed:(");
        header("Location:details.php");
        exit();
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
                        <li><a href="registration_form.php">SIGN UP</a>
                        </li>
                        <li><a href="#">LOG IN</a>
                        </li>
                        <li><a href="details.php">DETAILS</a>
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
                //TO DO :Display some message when no data is present in the table
                $result = mysqli_query($conn, $query4) or 
                           header("Location:registration_form.php?Message= :(");
                if($result->num_rows == 0) {
                    echo '<h1> Sorry ! Nothing to display </h1>';
                    exit();
                }
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

                                echo "<td><a href='details.php?userId=" . $row["eid"] . "&userAction=delete' target='_self' > 
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



