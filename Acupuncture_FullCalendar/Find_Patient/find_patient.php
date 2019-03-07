<?php
/* Attempt MySQL server connection.  */
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
// Check connection
if($link === false){ die("ERROR: Could not connect. " . mysqli_connect_error()); }

$return_arr = array();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$license = $_POST['license'];
$phone_number = $_POST['number'];
$ssn = $_POST['ssn'];

$sql = "SELECT * 
        FROM patients 
        WHERE first_name = '$first_name' OR last_name = '$last_name' OR email = '$email' OR license = '$license' OR
        phone_number = '$phone_number' OR ssn = '$ssn'";

$result = mysqli_query($link,$sql); 

while($patients = mysqli_fetch_array($result))
{
    $return_arr[] = array('first_name' => $patients['first_name'], 'last_name' => $patients['last_name'], 'address' => $patients['address'], 
                          'city' => $patients['city'], 'state' => $patients['state'], 'zip' => $patients['zip'], 'phone_number' => $patients['phone_number'],
                          'email' => $patients['email'], 'ssn' => $patients['ssn'], 'license' => $patients['license'], 'birthday' => $patients['birthday'], 
                          'customer_id' => $patients['customer_id']);    
}
//header('Content-Type: application/json');
echo json_encode($return_arr);
mysqli_close($link);
?>    