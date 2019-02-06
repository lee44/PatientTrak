<?php
$file = $_FILES['file'];
$file_name = $file['name'];
$file_type = $file ['type'];
$file_size = $file ['size'];
$file_path = $file ['tmp_name'];


/* Attempt MySQL server connection.  */
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// The mysqli_real_escape_string() function escapes special characters in a string and create a legal SQL string to provide security against SQL injection.
//$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$employer = $_POST['employer'];
$occupation = $_POST['occupation'];
$phonenumber = $_POST['number'];
$license = $_POST['license'];
$ssn = $_POST['ssn'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$notes= $_POST['notes'];

if(move_uploaded_file ($file_path,'uploads/'.$file_name))//"images" is just a folder name here we will load the file. 
    echo "File Uploaded";
 
// attempt insert query execution
$sql = "INSERT INTO patients (first_name,last_name,email,address,city,state,zip,employer,occupation,phone_number,license,ssn,birthday,sex,notes) 
        VALUES ('$first_name','$last_name','$email','$address','$city','$state','$zip','$employer','$occupation','$phonenumber','$license',
        	    '$ssn','$birthday','$gender','$notes')";

mysqli_query($link, $sql);
$sql2 = "INSERT INTO files (filename) VALUES ('$file_name')";
if(mysqli_query($link, $sql2)){
    echo "<h1 style='text-align:center'>Records added successfully.</h1>";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
header("refresh:2;url= http://76.91.29.148:5555/Add_Patient/index.php");
// close connection
mysqli_close($link);
?>