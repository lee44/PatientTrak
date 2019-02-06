<?php
/* Attempt MySQL server connection.  */
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$customer_id = $_POST['ID'];
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

$update_sql = "UPDATE patients 
               SET First_Name = '$first_name', Last_Name = '$last_name', Email = '$email', License = '$license', Address = '$address',
               City = '$city', State = '$state', Zip = '$zip', Employer = '$employer', Occupation = '$occupation', Phone_Number = '$phonenumber',
               SSN = '$ssn', Birthday = '$birthday', Sex = '$gender'
               WHERE CustomerID = '$customer_id'";

if(mysqli_query($link, $update_sql)){
    echo "<h2>Records were updated successfully.</h2>";
} else {
    echo "<h2>ERROR: Could not able to execute.</h2>";
}

mysqli_close($link);

header("refresh:2;url= http://76.91.29.148:5555/Find_Patient/index.php");
//header("Location: http://192.168.1.136:5557/");
exit();
?>