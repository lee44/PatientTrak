<?php
session_start();

/* Attempt MySQL server connection.  */
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$customer_id = $_SESSION['customer_id'];
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
date_default_timezone_set('America/Los_Angeles');
$created_at = date('Y-m-d H:i:s');

$update_sql = "UPDATE patients 
               SET first_name = '$first_name', last_name = '$last_name', email = '$email', license = '$license', address = '$address',
               city = '$city', state = '$state', zip = '$zip', employer = '$employer', occupation = '$occupation', phone_number = '$phonenumber',
               ssn = '$ssn', birthday = '$birthday', sex = '$gender'
               WHERE customer_id = '$customer_id'";

mysqli_query($link, $update_sql);

if(isset($_FILES['upload']['name'][0]))
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

		if(move_uploaded_file ($tmpFilePath,'../Add_Patient/Uploads/'.$fileName))
	    	echo "File Uploaded";

	    $sql2 = "INSERT INTO files (customer_id,file_name,type,size,created_at) VALUES ('$customer_id','$fileName','$fileType','$fileSize','$created_at')";
	    if(mysqli_query($link, $sql2))
	    	echo "<h1 style='text-align:center'>Records added successfully.</h1>";
		else
	    	echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
	}
}

mysqli_close($link);

header("refresh:1;url= http://192.168.1.136:5555/Find_Patient/index.php");
//header("Location: http://192.168.1.136:5557/");
exit();
?>