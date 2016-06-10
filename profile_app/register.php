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
	    die("Connection failed: " . $conn->connect_error);
	} 
	
	
	if(!empty($_POST)) {
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

		$resedenceCity=$_POST["resedenceCity"];

		$resedenceState=$_POST["residenceState"];

		$residenceZip=$_POST["residenceZip"];

		$residenceFax=$_POST["residenceFax"];

		$officeStreet=$_POST["officeStreet"];

		$officeCity=$_POST["officeCity"];

		$officeState=$_POST["officeState"];

		$officeZip=$_POST["officeZip"];

		$officeFax=$_POST["officeFax"];

		$note=$_POST["note"];

		$commMedium=$_POST["commMed"]; // its array

		//insert the employee details

		$query1 = "INSERT INTO employee (`prefix`,`firstName`,`middleName`,`lastName`,`gender`,`dob`,`mobile`,`landline`,`email`,`maritalStatus`,`employment`,
						`employer`,`photo`,`note`)
				VALUES ('$prefix','$firstName','$middleName','$lastName','$gender','$dob','$mobile','$landline','$email','$maritalStatus','$employment',
						'$employer','$photo','$note')";
				if ($conn->query($query1) === TRUE) {
					
				    
				     $empID= $conn->insert_id;
				} else {
				    echo "Error: " . $sql . "<br>" . $conn->error;
				    exit();
				}
				

		// insert residence address
		$query2 = "INSERT INTO address (`eid`,`type`,`street`,`city`,`state`,`zip`,`fax`)
				VALUES ('$empID','1','$residenceStreet','$resedenceCity','$resedenceState','$residenceZip','$residenceFax')";
				if ($conn->query($query2) === TRUE) {
				    
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
	}
?>
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
					        <li><a href="http://localhost/project/mindfire/profile_app/registration_form.html">SIGN UP</a></li>
					        <li><a href="#">LOG IN</a></li>
					        <li><a href="http://localhost/project/mindfire/profile_app/register.php">DETAILS</a></li>
				      	</ul>
				    </div><!--/.nav-collapse -->
				</div>
			</nav>

<div class="container">
  <h2>Registered Employees</h2>
  <div class="row">
  	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

  		<?php 

  			$query4="SELECT employee.eid , employee.firstName , employee.middleName , employee.lastName ,employee.gender ,
					employee.dob , employee.mobile , employee.landline , employee.email , employee.maritalStatus , 
					employee.employment , employee.employer , commMedium.empId ,commMedium.msg , commMedium.email 
					as comm_email, 
					commMedium.call , commMedium.any ,address.eid , address.type , address.street , address.city ,
					address.state , address.zip , address.fax 
					FROM employee JOIN commMedium ON employee.eid = commMedium.empId
					JOIN address ON  employee.eid = address.eid";
				
			$result = mysqli_query($conn, $query4) or die("failed".$conn->error);

			$employeeId=0;

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
	        
	        
	      </tr>
	    </thead>
	    <tbody>
	    	<?php
		    while($row = $result->fetch_assoc()) {
		    	if($employeeId != $row["empId"]){
			        echo "<tr>";

			        echo "<td>".$row["firstName"]." ".$row["middleName"]." ".$row["lastName"]."</td>";

			        if($row["gender"]=='m'){
			        	echo "<td>Male</td>";
			        }else if($row["gender"]=='f'){
			        	echo "<td>Female</td>";
			        }else{
			        	echo "<td>Others</td>";
			        }

			        echo "<td>".$row["dob"]."</td>";

			        echo "<td>M-".$row["mobile"]."<br>L-".$row["landline"]."</td>";

			        echo "<td>".$row["email"]."</td>";

			        echo "<td>".$row["maritalStatus"]."</td>";

			        echo "<td>".$row["employment"]."in ".$row["employer"]."</td>";

			        echo "<td>";

			        if($row["msg"]==1){echo "Message";}

			        if($row["comm_email"]==1){echo "<br>Email";}

			        if($row["call"]==1){echo "<br>Phone";}

			        if($row["any"]==1){echo "<br>Any";}

			        echo "</td>";
		    	}
		    	if($row["type"]==1){
		    		echo "<td>".$row["street"]."<br>".$row["city"].",".$row["zip"]."<br>".$row["state"]."</td>";
		    	}	
		        
		        if($row["type"]==2){
		    		echo "<td>".$row["street"]."<br>".$row["city"].",".$row["zip"]."<br>".$row["state"]."</td>";
		    	}
		        if($employeeId == $row["eid"]){
		      		echo "</tr>";
		      	}	
			  $employeeId=$row["empId"];	 
		    }
		    ?>
	     
	    </tbody>
	  </table>
  	</div>
  </div>
  
</div>

</body>
</html>
