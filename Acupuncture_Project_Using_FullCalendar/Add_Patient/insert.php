<?php
$file = $_FILES['file'];
$file_name = $file['name'];
$file_type = $file ['type'];
$file_size = $file ['size'];

/* Attempt MySQL server connection.  */
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
// Check connection
if($link === false)
    die("ERROR: Could not connect. " . mysqli_connect_error());

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
date_default_timezone_set('America/Los_Angeles');
$created_at = date('Y-m-d H:i:s');

// attempt insert query execution
$sql = "INSERT INTO patients (first_name,last_name,email,address,city,state,zip,employer,occupation,phone_number,license,ssn,birthday,sex,notes,created_at) 
        VALUES ('$first_name','$last_name','$email','$address','$city','$state','$zip','$employer','$occupation','$phonenumber','$license',
        	    '$ssn','$birthday','$gender','$notes','$created_at')";
mysqli_query($link, $sql);


if(isset($_FILES['upload']['name']))
{
	// Count # of uploaded files in array
	$total = count($_FILES['upload']['name']);

	for( $i=0 ; $i < $total ; $i++ ) 
	{
	  	//Get the temp file path
	  	$tmpFilePath = $_FILES['upload']['tmp_name'][$i];
	  	$fileName = $_FILES['upload']['name'][$i];
	  	$fileType = $_FILES['upload']['type'][$i];
	  	$fileSize = $_FILES['upload']['size'][$i];

		if(move_uploaded_file ($tmpFilePath,'uploads/'.$_FILES['upload']['name'][$i]))
	    	echo "File Uploaded";

	    $sql2 = "INSERT INTO files (filename,type,size) VALUES ('$fileName','$fileType','$fileSize')";
	    if(mysqli_query($link, $sql2))
	    	echo "<h1 style='text-align:center'>Records added successfully.</h1>";
		else
	    	echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
}

header("refresh:2;url= http://76.91.29.148:5555/Add_Patient/index.php");
// close connection
mysqli_close($link);
?>