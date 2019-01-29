<?php
$conn = mysqli_connect("localhost",'root','','acupuncture');
if(!$conn)
{
	echo 'Connection Failed:';
}

$sql = "SELECT * FROM patients";

$result = mysqli_query($conn,$sql);

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="">
	<title>Patient Data</title>
</head>
<body>
<div id="" style="white-space: nowrap;">
<table width="1000" border="5" cellpadding="5" cellspacing="3" >
<tr>
	<th>Customer ID</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Address</th>
	<th>City</th>
	<th>State</th>
	<th>Zip</th>
	<th>Phone Number</th>
	<th>Email</th>
	<th>SSN</th>
	<th>Drivers License</th>
	<th>BirthDay</th>
	<th>Sex</th>
	<th>Marital Status</th>
	<th>Employer</th>
	<th>Occupation</th>
	<th>Work Phone</th>

</tr>

<?php
while ($patients = mysqli_fetch_array($result)) 
{
	echo "<tr>";

	echo "<td>".$patients['CustomerID']."</td>";
	echo "<td>".$patients['First_Name']."</td>";
	echo "<td>".$patients['Last_Name']."</td>";
	echo "<td>".$patients['Address']."</td>";
	echo "<td>".$patients['City']."</td>";
	echo "<td>".$patients['State']."</td>";
	echo "<td>".$patients['Zip']."</td>";
	echo "<td>".$patients['Phone_Number']."</td>";
	echo "<td>".$patients['Email']."</td>";
	echo "<td>".$patients['Social_Security_Number']."</td>";
	echo "<td>".$patients['Drivers_License']."</td>";
	echo "<td>".$patients['Birthday']."</td>";
	echo "<td>".$patients['Sex']."</td>";
	echo "<td>".$patients['Marital_Status']."</td>";
	echo "<td>".$patients['Employer']."</td>";
	echo "<td>".$patients['Occupation']."</td>";
	echo "<td>".$patients['Work_Phone']."</td>";

	echo "<tr>";
}
mysqli_close($conn);
?>

</table>
</div>


</body>
</html>