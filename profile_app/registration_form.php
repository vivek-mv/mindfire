<?php
if( !empty( $_REQUEST['Message'] ) )
{
    echo "Sorry , something bad happened .Please try after some time.".$_REQUEST['Message'];
}
?>

<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
	        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	        <title>Registration Form</title>
	        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
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
				<form action="register.php" method="post" role="form" class="form-horizontal">
					<div class="row">
						
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							 
							 
							  	<fieldset>
				                  <legend>Personal Details</legend>
				                  <div class="well">
				                  	<!-- Select Basic -->
						            <div class="form-group">
						              <label class="col-md-3 control-label" for="selectbasic1">Prefix</label>
						              <div class="col-md-7">
						                <select id="selectbasic1" name="prefix" class="form-control">
						                  <option value="mr">Mr</option>
						                  <option value="miss">Miss</option>
						                </select>
						              </div>
						            </div>	

	     							<!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" for="firstName">First Name</label>  
						              <div class="col-md-7">
						              <input  name="firstName" type="text" placeholder="First Name" class="form-control input-md">
						              </div>
						            </div>

						            <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" for="middleName">Middle Name</label>  
						              <div class="col-md-7">
						              <input  name="middleName" type="text" placeholder="Middle Name" class="form-control input-md">
						              </div>
						            </div>

						            <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" for="lastName">Last Name</label>  
						              <div class="col-md-7">
						              <input  name="lastName" type="text" placeholder="Last Name" class="form-control input-md">
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
						                  <input type="radio" name="gender" value="f">
						                  Female
						                </label> 
						                <label class="radio-inline">
						                  <input type="radio" name="gender" value="o">
						                  Other
						                </label>
						              </div>
						            </div>

						            <div class="form-group">
						              <label class="col-md-3 control-label" for="datepicker">D.O.B</label>  
						              <div class="col-md-7">
						              <input name="dob" type="date" placeholder="D.O.B" class="form-control input-md">
						                
						              </div>
						            </div>
						            <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" for="phone">Moblie</label>  
						              <div class="col-md-7">
						              <input  name="mobile" type="text" placeholder="9999-9999-9999" class="form-control input-md">
						                
						              </div>
						            </div>
						            <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" for="phone">Landline</label>  
						              <div class="col-md-7">
						              <input  name="landline" type="text" placeholder="9999-9999999" class="form-control input-md">
						                
						              </div>
						            </div>

						            <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" for="firstName">Email</label>  
						              <div class="col-md-7">
						              <input  name="email" type="email" placeholder="example@mail.com" class="form-control input-md">
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
						                  <input type="radio" name="maritalStatus" value="unmarried">
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
						                  <input type="radio" name="employment" value="unemployed">
						                  Unemployed
						                </label> 
						                
						              </div>
						            </div>

						            <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" for="employer">Employer</label>  
						              <div class="col-md-7">
						              <input  name="employer" type="text" placeholder="Employer" class="form-control input-md">
						              </div>
						            </div>

						             <!-- File Button --> 
						            <div class="form-group">
						              <label class="col-md-3 control-label">Upload Photo</label>
						              <div class="col-md-7">
						                <input  name="photo" class="input-file" type="file">
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
						              <input  name="residenceStreet" type="text" placeholder="Street" class="form-control input-md">
						                
						              </div>
						            </div>
						            
						            <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" >City</label>  
						              <div class="col-md-7">
						              <input  name="resedenceCity" type="text" placeholder="City" class="form-control input-md">
						                
						              </div>
						            </div>

						            <!-- Select Basic -->
						            <div class="form-group">
						              <label class="col-md-3 control-label" >State</label>
						              <div class="col-md-7">
						                <select name="residenceState" class="form-control">
						                  <option value="">Select State</option>
				                             <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
				                             <option value="Andhra Pradesh">Andhra Pradesh</option>
				                             <option value="Arunachal Pradesh">Arunachal Pradesh</option>
				                             <option value="Assam">Assam</option>
				                             <option value="Bihar">Bihar</option>
				                             <option value="Chandigarh">Chandigarh</option>
				                             <option value="Chhattisgarh">Chhattisgarh</option>
				                             <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
				                             <option value="Daman and Diu">Daman and Diu</option>
				                             <option value="Delhi">Delhi</option>
				                             <option value="Goa">Goa</option>
				                             <option value="Gujarat">Gujarat</option>
				                             <option value="Haryana">Haryana</option>
				                             <option value="Himachal Pradesh">Himachal Pradesh</option>
				                             <option value="Jammu and Kashmir">Jammu and Kashmir</option>
				                             <option value="Jharkhand">Jharkhand</option>                         
				                             <option value="Karnataka">Karnataka</option>
				                             <option value="Kerala">Kerala</option>
				                             <option value="Lakshadweep">Lakshadweep</option>
				                             <option value="Madhya Pradesh">Madhya Pradesh</option>
				                             <option value="Maharashtra">Maharashtra</option>
				                             <option value="Manipur">Manipur</option>
				                             <option value="Meghalaya">Meghalaya</option>
				                             <option value="Mizoram">Mizoram</option>
				                             <option value="Nagaland">Nagaland</option>
				                             <option value="Orissa">Orissa</option>
				                             <option value="Pondicherry">Pondicherry</option>
				                             <option value="Punjab">Punjab</option>
				                             <option value="Rajasthan">Rajasthan</option>
				                             <option value="Sikkim">Sikkim</option>
				                             <option value="Tamil Nadu">Tamil Nadu</option>
				                             <option value="Tripura">Tripura</option>
				                             <option value="Uttaranchal">Uttaranchal</option>
				                             <option value="Uttar Pradesh">Uttar Pradesh</option>
				                             <option value="West Bengal">West Bengal</option>
						                </select>
						              </div>
						            </div>

						            <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" >Zip</label>  
						              <div class="col-md-7">
						              <input name="residenceZip" type="text" placeholder="Zip" class="form-control input-md">
						                
						              </div>
						            </div>
						           
						             <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" >Fax</label>  
						              <div class="col-md-7">
						              <input name="residenceFax" type="text" placeholder="Fax" class="form-control input-md">
						                
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
						              <input  name="officeStreet" type="text" placeholder="Street" class="form-control input-md">
						                
						              </div>
						            </div>
						            
						            <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" >City</label>  
						              <div class="col-md-7">
						              <input  name="officeCity" type="text" placeholder="City" class="form-control input-md">
						                
						              </div>
						            </div>

						            <!-- Select Basic -->
						            <div class="form-group">
						              <label class="col-md-3 control-label" >State</label>
						              <div class="col-md-7">
						                <select name="officeState" class="form-control">
						                  <option value="">Select State</option>
				                             <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
				                             <option value="Andhra Pradesh">Andhra Pradesh</option>
				                             <option value="Arunachal Pradesh">Arunachal Pradesh</option>
				                             <option value="Assam">Assam</option>
				                             <option value="Bihar">Bihar</option>
				                             <option value="Chandigarh">Chandigarh</option>
				                             <option value="Chhattisgarh">Chhattisgarh</option>
				                             <option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
				                             <option value="Daman and Diu">Daman and Diu</option>
				                             <option value="Delhi">Delhi</option>
				                             <option value="Goa">Goa</option>
				                             <option value="Gujarat">Gujarat</option>
				                             <option value="Haryana">Haryana</option>
				                             <option value="Himachal Pradesh">Himachal Pradesh</option>
				                             <option value="Jammu and Kashmir">Jammu and Kashmir</option>
				                             <option value="Jharkhand">Jharkhand</option>                         
				                             <option value="Karnataka">Karnataka</option>
				                             <option value="Kerala">Kerala</option>
				                             <option value="Lakshadweep">Lakshadweep</option>
				                             <option value="Madhya Pradesh">Madhya Pradesh</option>
				                             <option value="Maharashtra">Maharashtra</option>
				                             <option value="Manipur">Manipur</option>
				                             <option value="Meghalaya">Meghalaya</option>
				                             <option value="Mizoram">Mizoram</option>
				                             <option value="Nagaland">Nagaland</option>
				                             <option value="Orissa">Orissa</option>
				                             <option value="Pondicherry">Pondicherry</option>
				                             <option value="Punjab">Punjab</option>
				                             <option value="Rajasthan">Rajasthan</option>
				                             <option value="Sikkim">Sikkim</option>
				                             <option value="Tamil Nadu">Tamil Nadu</option>
				                             <option value="Tripura">Tripura</option>
				                             <option value="Uttaranchal">Uttaranchal</option>
				                             <option value="Uttar Pradesh">Uttar Pradesh</option>
				                             <option value="West Bengal">West Bengal</option>
						                </select>
						              </div>
						            </div>

						            <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" >Zip</label>  
						              <div class="col-md-7">
						              <input name="officeZip" type="text" placeholder="Zip" class="form-control input-md">
						                
						              </div>
						            </div>
						           
						             <!-- Text input-->
						            <div class="form-group">
						              <label class="col-md-3 control-label" >Fax</label>  
						              <div class="col-md-7">
						              <input name="officeFax" type="text" placeholder="Fax" class="form-control input-md">
						                
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
								                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
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
					                                    <input type="checkbox" id="mail" name="commMed[]" value="mail">
					                                    <label for="mail">Mail</label>
					                                </div>
					                                <div class="checkbox-inline">
					                                    <input type="checkbox" id="message" name="commMed[]" value="msg">
					                                    <label for="message">Message</label>
					                                </div>
					                                <div class="checkbox-inline">
					                                    <input type="checkbox" id="phone" name="commMed[]" value="phone">
					                                    <label for="phone">Phone</label>
					                                </div>
					                                <div class="checkbox-inline">
					                                    <input type="checkbox" id="any" name="commMed[]" value="any">
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
		              <input type="submit" name="submit" class="btn btn-primary"> &nbsp  &nbsp  &nbsp
		              <input type="reset" name="Reset" class="btn btn-danger">
		            </div>	
				</form>		
			</div>
		</body>
	<html>