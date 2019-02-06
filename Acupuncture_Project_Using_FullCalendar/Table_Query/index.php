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
<div class="table-responsive">
    <table class = "table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Address</th>
                <th>City</th>
                <th>State</th>
                <th>Zip</th>
                <th>Number</th>
                <th>Email</th>
                <th>SSN</th>
                <th>License</th>
                <th>Birthday</th>
                <th>Edit?</th>
            </tr>
        </thead>';

<?php
while ($patients = mysqli_fetch_array($result)) 
{
    echo "<tbody>";
    echo "<tr>";
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
    echo "<td><form action='/Edit_Patient/index.php' method='POST'>
          <input type='hidden' name='CustomerID' value='".$patients["CustomerID"]."'/>
          <input type='submit' name='edit' value='Edit' /></form></td>";
    echo "</tr>";
}
    echo "</tbody>
          </table>
          </div>";
mysqli_close($conn);
?>

</table>
</div>


</body>
</html>