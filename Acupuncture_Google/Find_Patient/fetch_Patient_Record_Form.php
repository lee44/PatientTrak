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
    </form>";    
}
mysqli_close($link);
?>