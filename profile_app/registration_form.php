<?php
    require_once('db_conn.php');
    require_once('constants.php');
    
    if (!empty($_REQUEST['Message'])) {
        echo "Sorry , something bad happened .Please try after some time." . $_REQUEST['Message'];
    }

    if (!empty($_GET['valError'])) {
        echo $_GET['valError'];
    }

    if (isset($_GET["userId"]) && isset($_GET["userAction"])) {
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
                        <li><a href="http://localhost/project/mindfire/profile_app/registration_form.php">SIGN UP</a></li>
                        <li><a href="#">LOG IN</a></li>
                        <li><a href="http://localhost/project/mindfire/profile_app/register.php">DETAILS</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
        <h1>REGISTER</h1>
        <form action=<?php if( isset($_GET['userAction']) && $_GET['userAction']=='update' ) 
        {echo 'update.php?userId='.$_GET["userId"]; } else {echo 'register.php';} ?> method="post" 
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
                                    <input  name="firstName" type="text" placeholder="First Name" class="form-control input-md" 
                                        <?php if( isset($empDetails["firstName"]) ) echo 'value="'.$empDetails["firstName"].'"'; ?> required>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="middleName">Middle Name</label>  
                                <div class="col-md-7">
                                    <input  name="middleName" type="text" placeholder="Middle Name" class="form-control input-md"
                                        <?php if( isset($empDetails["middleName"]) ) echo 'value="'.$empDetails["middleName"].'"'; ?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="lastName">Last Name</label>  
                                <div class="col-md-7">
                                    <input  name="lastName" type="text" placeholder="Last Name" class="form-control input-md" 
                                        <?php if( isset($empDetails["lastName"]) ) echo 'value="'.$empDetails["lastName"].'"'; ?> >
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
                                    <input  name="mobile" type="text" placeholder="9999-9999-9999" class="form-control input-md"
                                        <?php if( isset($empDetails["mobile"]) ) echo 'value="'.$empDetails["mobile"].'"'; ?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="phone">Landline</label>  
                                <div class="col-md-7">
                                    <input  name="landline" type="text" placeholder="9999-9999999" class="form-control input-md"
                                        <?php if( isset($empDetails["landline"]) ) echo 'value="'.$empDetails["landline"].'"'; ?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="firstName">Email</label>  
                                <div class="col-md-7">
                                    <input  name="email" type="email" placeholder="example@mail.com" class="form-control input-md"
                                        <?php if( isset($empDetails["email"]) ) echo 'value="'.$empDetails["email"].'"'; ?>  required>
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
                                    <input  name="employer" type="text" placeholder="Employer" class="form-control input-md"
                                        <?php if( isset($empDetails["employer"]) ) echo 'value="'.$empDetails["employer"].'"'; ?> >
                                </div>
                            </div>
                            <!-- File Button --> 
                            <div class="form-group">
                                <label class="col-md-3 control-label">Upload Photo</label>
                                <div class="col-md-7">
                                    <input  name="image" class="input-file" type="file">
                                    <?php if( isset($empDetails["photo"]) && !empty($empDetails["photo"]) ) 
                                            echo '<img src="http://localhost/project/mindfire/profile_app/profile_pic/'.$empDetails["photo"].'"  alt="profile pic" />'; ?>
                                    
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
                                        <?php if( isset($empResidence["street"]) ) echo 'value="'.$empResidence["street"].'"'; ?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >City</label>  
                                <div class="col-md-7">
                                    <input  name="resedenceCity" type="text" placeholder="City" class="form-control input-md"
                                        <?php if( isset($empResidence["city"]) ) echo 'value="'.$empResidence["city"].'"'; ?> >
                                </div>
                            </div>
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >State</label>
                                <div class="col-md-7">
                                    <select name="residenceState" class="form-control" value="Arunachal Pradesh">
                                        <option value="">Select State</option>
                                        <option value="Andaman and Nicobar Islands"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Andaman and Nicobar Islands") echo 'selected="selected"'; ?> >Andaman and Nicobar Islands</option>
                                        <option value="Andhra Pradesh"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Andhra Pradesh") echo 'selected="selected"'; ?> >Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Arunachal Pradesh") echo 'selected="selected"'; ?> >Arunachal Pradesh</option>
                                        <option value="Assam"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Assam") echo 'selected="selected"'; ?> >Assam</option>
                                        <option value="Bihar"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Bihar") echo 'selected="selected"'; ?> >Bihar</option>
                                        <option value="Chandigarh"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Chandigarh") echo 'selected="selected"'; ?> >Chandigarh</option>
                                        <option value="Chhattisgarh"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Chhattisgarh") echo 'selected="selected"'; ?> >Chhattisgarh</option>
                                        <option value="Dadra and Nagar Haveli"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Dadra and Nagar Haveli") echo 'selected="selected"'; ?> >Dadra and Nagar Haveli</option>
                                        <option value="Daman and Diu"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Daman and Diu") echo 'selected="selected"'; ?> >Daman and Diu</option>
                                        <option value="Delhi"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Delhi") echo 'selected="selected"'; ?> >Delhi</option>
                                        <option value="Goa"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Goa") echo 'selected="selected"'; ?> >Goa</option>
                                        <option value="Gujarat"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Gujarat") echo 'selected="selected"'; ?> >Gujarat</option>
                                        <option value="Haryana"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Haryana") echo 'selected="selected"'; ?> >Haryana</option>
                                        <option value="Himachal Pradesh"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Himachal Pradesh") echo 'selected="selected"'; ?> >Himachal Pradesh</option>
                                        <option value="Jammu and Kashmir"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Jammu and Kashmir") echo 'selected="selected"'; ?> >Jammu and Kashmir</option>
                                        <option value="Jharkhand"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Jharkhand") echo 'selected="selected"'; ?> >Jharkhand</option>
                                        <option value="Karnataka"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Karnataka") echo 'selected="selected"'; ?> >Karnataka</option>
                                        <option value="Kerala"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Kerala") echo 'selected="selected"'; ?> >Kerala</option>
                                        <option value="Lakshadweep"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Lakshadweep") echo 'selected="selected"'; ?> >Lakshadweep</option>
                                        <option value="Madhya Pradesh"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Madhya Pradesh") echo 'selected="selected"'; ?> >Madhya Pradesh</option>
                                        <option value="Maharashtra"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Maharashtra") echo 'selected="selected"'; ?> >Maharashtra</option>
                                        <option value="Manipur"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Manipur") echo 'selected="selected"'; ?> >Manipur</option>
                                        <option value="Meghalaya"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Meghalaya") echo 'selected="selected"'; ?> >Meghalaya</option>
                                        <option value="Mizoram"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Mizoram") echo 'selected="selected"'; ?> >Mizoram</option>
                                        <option value="Nagaland"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Nagaland") echo 'selected="selected"'; ?> >Nagaland</option>
                                        <option value="Orissa"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Orissa") echo 'selected="selected"'; ?> >Orissa</option>
                                        <option value="Pondicherry"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Pondicherry") echo 'selected="selected"'; ?> >Pondicherry</option>
                                        <option value="Punjab"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Punjab") echo 'selected="selected"'; ?> >Punjab</option>
                                        <option value="Rajasthan"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Rajasthan") echo 'selected="selected"'; ?> >Rajasthan</option>
                                        <option value="Sikkim"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Sikkim") echo 'selected="selected"'; ?> >Sikkim</option>
                                        <option value="Tamil Nadu"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Tamil Nadu") echo 'selected="selected"'; ?> >Tamil Nadu</option>
                                        <option value="Tripura"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Tripura") echo 'selected="selected"'; ?> >Tripura</option>
                                        <option value="Uttaranchal"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Uttaranchal") echo 'selected="selected"'; ?> >Uttaranchal</option>
                                        <option value="Uttar Pradesh"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="Uttar Pradesh") echo 'selected="selected"'; ?> >Uttar Pradesh</option>
                                        <option value="West Bengal"
                                            <?php if ( isset($empResidence["state"]) && $empResidence["state"]=="West Bengal") echo 'selected="selected"'; ?> >West Bengal</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Zip</label>  
                                <div class="col-md-7">
                                    <input name="residenceZip" type="text" placeholder="Zip" class="form-control input-md"
                                        <?php if( isset($empResidence["zip"]) ) echo 'value="'.$empResidence["zip"].'"'; ?>>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Fax</label>  
                                <div class="col-md-7">
                                    <input name="residenceFax" type="text" placeholder="Fax" class="form-control input-md"
                                        <?php if( isset($empResidence["fax"]) ) echo 'value="'.$empResidence["fax"].'"'; ?>>
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
                                        <?php if( isset($empOffice["street"]) ) echo 'value="'.$empOffice["street"].'"'; ?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >City</label>  
                                <div class="col-md-7">
                                    <input  name="officeCity" type="text" placeholder="City" class="form-control input-md"
                                        <?php if( isset($empOffice["city"]) ) echo 'value="'.$empOffice["city"].'"'; ?> >
                                </div>
                            </div>
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >State</label>
                                <div class="col-md-7">
                                    <select name="officeState" class="form-control">
                                        <option value="">Select State</option>
                                        <option value="Andaman and Nicobar Islands"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Andaman and Nicobar Islands") echo 'selected="selected"'; ?> >Andaman and Nicobar Islands</option>
                                        <option value="Andhra Pradesh"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Andhra Pradesh") echo 'selected="selected"'; ?> >Andhra Pradesh</option>
                                        <option value="Arunachal Pradesh"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Arunachal Pradesh") echo 'selected="selected"'; ?> >Arunachal Pradesh</option>
                                        <option value="Assam"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Assam") echo 'selected="selected"'; ?> >Assam</option>
                                        <option value="Bihar"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Bihar") echo 'selected="selected"'; ?> >Bihar</option>
                                        <option value="Chandigarh"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Chandigarh") echo 'selected="selected"'; ?> >Chandigarh</option>
                                        <option value="Chhattisgarh"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Chhattisgarh") echo 'selected="selected"'; ?> >Chhattisgarh</option>
                                        <option value="Dadra and Nagar Haveli"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Dadra and Nagar Haveli") echo 'selected="selected"'; ?> >Dadra and Nagar Haveli</option>
                                        <option value="Daman and Diu"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Daman and Diu") echo 'selected="selected"'; ?> >Daman and Diu</option>
                                        <option value="Delhi"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Delhi") echo 'selected="selected"'; ?> >Delhi</option>
                                        <option value="Goa"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Goa") echo 'selected="selected"'; ?> >Goa</option>
                                        <option value="Gujarat"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Gujarat") echo 'selected="selected"'; ?> >Gujarat</option>
                                        <option value="Haryana"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Haryana") echo 'selected="selected"'; ?> >Haryana</option>
                                        <option value="Himachal Pradesh"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Himachal Pradesh") echo 'selected="selected"'; ?> >Himachal Pradesh</option>
                                        <option value="Jammu and Kashmir"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Jammu and Kashmir") echo 'selected="selected"'; ?> >Jammu and Kashmir</option>
                                        <option value="Jharkhand"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Jharkhand") echo 'selected="selected"'; ?> >Jharkhand</option>
                                        <option value="Karnataka"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Karnataka") echo 'selected="selected"'; ?> >Karnataka</option>
                                        <option value="Kerala"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Kerala") echo 'selected="selected"'; ?> >Kerala</option>
                                        <option value="Lakshadweep"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Lakshadweep") echo 'selected="selected"'; ?> >Lakshadweep</option>
                                        <option value="Madhya Pradesh"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Madhya Pradesh") echo 'selected="selected"'; ?> >Madhya Pradesh</option>
                                        <option value="Maharashtra"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Maharashtra") echo 'selected="selected"'; ?> >Maharashtra</option>
                                        <option value="Manipur"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Manipur") echo 'selected="selected"'; ?> >Manipur</option>
                                        <option value="Meghalaya"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Meghalaya") echo 'selected="selected"'; ?> >Meghalaya</option>
                                        <option value="Mizoram"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Mizoram") echo 'selected="selected"'; ?> >Mizoram</option>
                                        <option value="Nagaland"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Nagaland") echo 'selected="selected"'; ?> >Nagaland</option>
                                        <option value="Orissa"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Orissa") echo 'selected="selected"'; ?> >Orissa</option>
                                        <option value="Pondicherry"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Pondicherry") echo 'selected="selected"'; ?> >Pondicherry</option>
                                        <option value="Punjab"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Punjab") echo 'selected="selected"'; ?> >Punjab</option>
                                        <option value="Rajasthan"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Rajasthan") echo 'selected="selected"'; ?> >Rajasthan</option>
                                        <option value="Sikkim"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Sikkim") echo 'selected="selected"'; ?> >Sikkim</option>
                                        <option value="Tamil Nadu"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Tamil Nadu") echo 'selected="selected"'; ?> >Tamil Nadu</option>
                                        <option value="Tripura"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Tripura") echo 'selected="selected"'; ?> >Tripura</option>
                                        <option value="Uttaranchal"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Uttaranchal") echo 'selected="selected"'; ?> >Uttaranchal</option>
                                        <option value="Uttar Pradesh"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="Uttar Pradesh") echo 'selected="selected"'; ?> >Uttar Pradesh</option>
                                        <option value="West Bengal"
                                            <?php if ( isset($empOffice["state"]) && $empOffice["state"]=="West Bengal") echo 'selected="selected"'; ?> >West Bengal</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Zip</label>  
                                <div class="col-md-7">
                                    <input name="officeZip" type="text" placeholder="Zip" class="form-control input-md"
                                        <?php if( isset($empOffice["zip"]) ) echo 'value="'.$empOffice["zip"].'"'; ?> >
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" >Fax</label>  
                                <div class="col-md-7">
                                    <input name="officeFax" type="text" placeholder="Fax" class="form-control input-md"
                                        <?php if( isset($empOffice["fax"]) ) echo 'value="'.$empOffice["fax"].'"'; ?> >
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
                                            ><?php if( isset($empDetails["note"]) ) echo $empDetails["note"]; ?></textarea>
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