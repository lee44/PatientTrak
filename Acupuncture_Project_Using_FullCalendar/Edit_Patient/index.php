<?php
/* Attempt MySQL server connection.  */
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// The mysqli_real_escape_string() function escapes special characters in a string and create a legal SQL string to provide security against SQL injection.
$customer_id = mysqli_real_escape_string($link, $_REQUEST['CustomerID']);

// attempt insert query execution
$sql = "SELECT CustomerID,First_Name,Last_Name,Address,City,State,Zip,Phone_Number,Email,Social_Security_Number,
			   Drivers_License,Birthday FROM patients WHERE CustomerID = '$customer_id'";

$result = mysqli_query($link,$sql);

while ($patients = mysqli_fetch_array($result)) 
{
	echo "
    <html>    
    <head>    
        <title>Edit Patient</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href = 'edit_patient.css' type = 'text/css' rel = 'stylesheet' /> 
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link href='/lib/bootstrap.min.css' rel='stylesheet' />
        <script src='/lib/jquery-3.3.1.slim.min.js'></script>
        <script src='/lib/popper.min.js'></script>
        <script src='/lib/bootstrap.min.js'></script>        
    </head>    
        <body>    
        <nav class='navbar navbar-expand-lg navbar-light bglight'>
            <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent'>
                <span class='navbar-toggler-icon'></span>
            </button>

            <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                <ul class='navbar-nav justify-content-between'>
                    <li class='nav-item'><a class='nav-link' href = '/index.php'>Home</a></li>
                    <li class='nav-item'><a class='nav-link' href='/Add_Patient/index.php'>Add Patient</a></li>
                    <li class='nav-item'><a class='nav-link' href = '/Find_Patient/index.php'>Find Patient</a></li>
                    <li class='nav-item'><a class='nav-link' href = '/Table_Query/index.php'>Show All Data</a></li>
                </ul>
            </div>
        </nav>

        <h1>Edit Patient Information</h1>
        <div class='container'>
          <form form name='form1' action='/Edit_Patient/update_Patient_Record.php' method='post' enctype='multipart/form-data'>
            <div class='form-row'>
              <div class='form-group col-md-2'>
                <label for='id'>ID</label>
                <input type='text' class='form-control' name='ID' value = '".$patients['CustomerID']."' readonly>
              </div>
              <div class='form-group col-md-5'>
                <label for='first_name'>First Name</label>
                <input type='text' class='form-control' name='first_name' placeholder='First Name' value = '".$patients['First_Name']."' required>
              </div>
              <div class='form-group col-md-5'>
                <label for='last_name'>Last Name</label>
                <input type='text' class='form-control' name='last_name' placeholder='Last Name' value = '".$patients['Last_Name']."' required>
              </div>
            </div>
            <div class='form-group'>
              <label for='inputAddress'>Address</label>
              <input type='text' class='form-control' name='inputAddress' placeholder='1234 Main St'>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='inputCity'>City</label>
                <input type='text' class='form-control' name='inputCity' placeholder='City'>
              </div>
              <div class='form-group col-md-4'>
                <label for='inputState'>State</label>
                <input type='text' class='form-control' name='state' placeholder='State'>
              </div>
              <div class='form-group col-md-2'>
                <label for='inputZip'>Zip</label>
                <input type='text' class='form-control' name='inputZip' placeholder='Zip'>
              </div>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='employer'>Employer</label>
                <input type='text' class='form-control' name='employer' placeholder='Employer'>
              </div>
              <div class='form-group col-md-6'>
                <label for='occupation'>Occupation</label>
                <input type='text' class='form-control' name='occupation' placeholder='Occupation'>
              </div>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='email'>Email</label>
                <input type='email' class='form-control' name='email' placeholder='Email' value = '".$patients['Email']."' required>
              </div>
              <div class='form-group col-md-6'>
                <label for='number'>Number</label>
                <input type='number' class='form-control' name='number' placeholder='Number'>
              </div>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='license'>License</label>
                <input type='text' class='form-control' name='license' placeholder='License' value = '".$patients['Drivers_License']."'>
              </div>
              <div class='form-group col-md-6'>
                <label for='ssn'>SSN</label>
                <input type='number' class='form-control' name='ssn' placeholder='SSN'>
              </div>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='birthday'>Birthday</label>
                <input type='date' class='form-control' name='birthday' placeholder='Birthday'>
              </div>
              
              <div class='form-group col-md-6'>
                <label for='gender'>Gender</label>
                <div class='form-check'>
                
                  <div class='form-row'>
                    <div class='form-group col-sm-6'>
                      <label class='form-check-label radio-inline control-label' for='gridRadios1'>
                        <input class='form-check-input' type='radio' name='gender' id='gridRadios1' value='male' checked> Male
                      </label>
                    </div>
                    <div class='form-group col-sm-6'>
                    <label class='form-check-label radio-inline control-label' for='gridRadios2'>
                      <input class='form-check-input' type='radio' name='gender' id='gridRadios2' value='female'>Female
                    </label>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class = 'uploadFile'>    
              <h2>Upload File</h2>
              <input type='file' name='file' id='fileSelect'/>
              <h4>Description of File:</h4> 
              <textarea name='description' value='' rows='4' cols='40'></textarea>
            </div>
            <input type='submit' class='btn btn-info btn-block' value='Update'>      
          </form>
        </div>
        </body>    
    </html>
	";    
}
mysqli_close($link);
?>

<!-- echo "
    <link href ='registration.css' type = 'text/css' rel = 'stylesheet' />
    <form name = 'form2' action='update_Patient_Record' method = 'post' enctype = 'multipart/form-data' >    
        <div class = 'container'>
            <div class = 'form_group'>    
                <label>Customer ID:</label>    
                <input type = 'text' name = 'ID' value = '".$patients['CustomerID']."' readonly />    
            </div>    
            <div class = 'form_group'>    
                <label>First Name:</label>    
                <input type = 'text' name = 'first_name' value = '".$patients['First_Name']."' />    
            </div>      
            <div class = 'form_group'>    
                <label>Last Name:</label>    
                <input type = 'text' name = 'last_name' value = '".$patients['Last_Name']."' />    
            </div>
            <div class = 'form_group'>    
                <label>Email:</label>    
                <input type = 'text' name = 'email' value = '".$patients['Email']."' />    
            </div> 
            <div class = 'form_group'>    
                <label>Drivers License:</label>    
                <input type = 'text' name = 'drivers_license' value = '".$patients['Drivers_License']."' />    
            </div> 
            <div class = 'form_group'>    
                <input type='submit' value='Update' name='Update'>    
            </div>
        </div>    
    </form>";  -->   