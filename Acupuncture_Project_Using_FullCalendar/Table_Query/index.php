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
	<title>Patient Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "/Global_CSS/global.css" type = "text/css" rel = "stylesheet" />
    <link href = "table_query.css" type = "text/css" rel = "stylesheet" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link href='/lib/bootstrap.min.css' rel="stylesheet" />
    <script src='/lib/jquery-3.3.1.slim.min.js'></script>
    <script src='/lib/popper.min.js'></script>
    <script src='/lib/bootstrap.min.js'></script> 
</head>
<body>
    <body>    
    <nav class="navbar navbar-expand-lg navbar-light bglight">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-between">
                <li class="nav-item"><a class="nav-link" href = "/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/Add_Patient/index.php">Add Patient</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Find_Patient/index.php">Find Patient</a></li>
                <li class="nav-item"><a class="nav-link" href = "#home">Show All Data</a></li>
            </ul>
        </div>
    </nav>
    <div class="table-responsive">
        <table class = "table table-striped">
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
            </thead>

<?php
while ($patients = mysqli_fetch_array($result)) 
{
    echo "<tbody>";
    echo "<tr>";
    echo "<td>".$patients['first_name']."</td>";
    echo "<td>".$patients['last_name']."</td>";
    echo "<td>".$patients['address']."</td>";
    echo "<td>".$patients['city']."</td>";
    echo "<td>".$patients['state']."</td>";
    echo "<td>".$patients['zip']."</td>";
    echo "<td>".$patients['phone_number']."</td>";
    echo "<td>".$patients['email']."</td>";
    echo "<td>".$patients['ssn']."</td>";
    echo "<td>".$patients['license']."</td>";
    echo "<td>".$patients['birthday']."</td>";
    echo "<td><form action='/Edit_Patient/index.php' method='POST'>
          <input type='hidden' name='customer_id' value='".$patients["customer_id"]."'/>
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