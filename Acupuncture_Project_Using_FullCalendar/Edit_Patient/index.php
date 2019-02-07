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
$sql = "SELECT * FROM patients WHERE CustomerID = '$customer_id'";

$result = mysqli_query($link,$sql);

$male = ''; $female = '';
while ($patients = mysqli_fetch_array($result)) 
{
  if($patients['Sex'] == 'Male' || $patients['Sex'] == 'M') 
    $male = 'checked';
  else
    $female = 'checked';
  echo "
    <html>    
    <head>    
        <title>Edit Patient</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link href = '/Global_CSS/global.css' type = 'text/css' rel = 'stylesheet' />
        <link href = 'edit_patient.css' type = 'text/css' rel = 'stylesheet' /> 
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
        <link href='/lib/bootstrap.min.css' rel='stylesheet' />
        <script src='/lib/jquery-3.3.1.slim.min.js'></script>
        <script src='/lib/popper.min.js'></script>
        <script src='/lib/bootstrap.min.js'></script> 
        <script src='/lib/jquery.min.js'></script>
    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js'></script>
    <script>
    $(document).ready(function () 
    {
      $('#phone').inputmask({'mask': '(999) 999-9999'});
      $('#ssn').inputmask({'mask': '999-99-9999'});
    });
    </script>          
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
              <input type='text' class='form-control' name='address' placeholder='1234 Main St' value = '".$patients['Address']."'>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='inputCity'>City</label>
                <input type='text' class='form-control' name='city' placeholder='City' value = '".$patients['City']."'>
              </div>
              <div class='form-group col-md-4'>
                <label for='inputState'>State</label>
                <input type='text' class='form-control' name='state' placeholder='State' value = '".$patients['State']."'>
              </div>
              <div class='form-group col-md-2'>
                <label for='inputZip'>Zip</label>
                <input type='text' class='form-control' name='zip' placeholder='Zip' value = '".$patients['Zip']."'>
              </div>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='employer'>Employer</label>
                <input type='text' class='form-control' name='employer' placeholder='Employer' value = '".$patients['Employer']."'>
              </div>
              <div class='form-group col-md-6'>
                <label for='occupation'>Occupation</label>
                <input type='text' class='form-control' name='occupation' placeholder='Occupation' value = '".$patients['Occupation']."'>
              </div>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='email'>Email</label>
                <input type='email' class='form-control' name='email' placeholder='Email' value = '".$patients['Email']."' required>
              </div>
              <div class='form-group col-md-6'>
                <label for='number'>Number</label>
                <input type='text' class='form-control' name='number' id='phone' placeholder='Number' value = '".$patients['Phone_Number']."'>
              </div>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='license'>License</label>
                <input type='text' class='form-control' name='license' placeholder='License' value = '".$patients['License']."'>
              </div>
              <div class='form-group col-md-6'>
                <label for='ssn'>SSN</label>
                <input type='text' class='form-control' name='ssn' id='ssn' placeholder='SSN' value = '".$patients['SSN']."'>
              </div>
            </div>
            <div class='form-row'>
              <div class='form-group col-md-6'>
                <label for='birthday'>Birthday</label>
                <input type='date' class='form-control' name='birthday' placeholder='Birthday' value = '".$patients['Birthday']."'>
              </div>
              
              <div class='form-group col-md-6'>
                <label for='gender'>Gender</label>
                <div class='form-check'>
                
                  <div class='form-row'>
                    <div class='form-group col-sm-6'>
                      <label class='form-check-label radio-inline control-label' for='gridRadios1'>
                        <input class='form-check-input' type='radio' name='gender' id='gridRadios1' value='male ' ".$male."> Male
                      </label>
                    </div>
                    <div class='form-group col-sm-6'>
                    <label class='form-check-label radio-inline control-label' for='gridRadios2'>
                      <input class='form-check-input' type='radio' name='gender' id='gridRadios2' value='female ' ".$female.">Female
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
              <textarea name='description' value = '".$patients['Notes']."' rows='4' cols='40'></textarea>
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