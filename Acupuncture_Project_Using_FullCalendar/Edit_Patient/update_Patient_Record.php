
<?php
/* Attempt MySQL server connection.  */
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

$customer_id = mysqli_real_escape_string($link, $_REQUEST['ID']);
$first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
$last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$Drivers_License = mysqli_real_escape_string($link, $_REQUEST['license']);

$update_sql = "UPDATE patients SET First_Name = '$first_name', Last_Name = '$last_name', Email = '$email', Drivers_License = '$Drivers_License' WHERE CustomerID = '$customer_id'";
if(mysqli_query($link, $update_sql)){
    echo "<h2>Records were updated successfully.</h2>";
} else {
    echo "<h2>ERROR: Could not able to execute.</h2>";
}

mysqli_close($link);

header("refresh:2;url= http://192.168.1.136:5555/Find_Patient/index.php");
//header("Location: http://192.168.1.136:5557/");
exit();
?>