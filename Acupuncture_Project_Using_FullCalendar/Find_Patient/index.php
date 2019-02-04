<html>    
<head>    
    <title>Find/Edit Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "find_patient_css.css" type = "text/css" rel = "stylesheet" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"> -->
    <link href='/lib/bootstrap.min.css' rel="stylesheet" />
    <script src='/lib/jquery-3.3.1.slim.min.js'></script>
    <script src='/lib/popper.min.js'></script>
    <script src='/lib/bootstrap.min.js'></script>        
</head>    
    <body>    
    <nav class="navbar navbar-expand-lg navbar-light bglight">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-between">
                <li class="nav-item"><a class="nav-link" href = "/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="#home">Add Patient</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Find_Patient/index.php">Find Patient</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Table_Query/index.php">Show All Data</a></li>
            </ul>
        </div>
    </nav>

    <h1>Find/Edit Patient Information</h1>
    <div class="container">
        <form form name = "form1" action="insert.php" method = "post" enctype = "multipart/form-data" >
            <div class="row">
<!--left column -->
                <div class="col-6">
                    <div class="form-group row">
                        <label for="fname" class="col-sm-5 col-form-label">First Name:</label>
                        <div class="col-sm-7">
                            <input type="text" name = "first_name" class="form-control" id="fname" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="number" class="col-sm-5 col-form-label">Number:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="number">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ssn" class="col-sm-5 col-form-label">SSN:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="ssn">
                        </div>
                    </div>                    
<!-- right column -->
                <div class="col-6">
                    <div class="form-group row">
                        <label for="email" class="col-sm-5 col-form-label">Last Name:</label>
                        <div class="col-sm-7">
                            <input type="text" name = "last_name" class="form-control" id="email" value="" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-5 col-form-label">Email:</label>
                        <div class="col-sm-7">
                            <input type="text" name = "email" class="form-control" id="email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="drivers_license" class="col-sm-5 col-form-label">License:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="drivers_license">
                        </div>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-info btn-block" value="Search">              
        </form> 
    </div>
        
    </body>    
</html>    

<?php
if(isset($_POST['submit']))
{
    if(empty($_POST['first_name']))
        echo "Enter a search term";
    else
    {
                /* Attempt MySQL server connection.  */
        $link = mysqli_connect("localhost", "root", "", "acupuncture");
         
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
         
        // The mysqli_real_escape_string() function escapes special characters in a string and create a legal SQL string to provide security against SQL injection.
        $first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
        $last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
        $email = mysqli_real_escape_string($link, $_REQUEST['email']);
        $drivers_license = mysqli_real_escape_string($link, $_REQUEST['Drivers_License']);
        // attempt insert query execution
        $sql = "SELECT CustomerID,First_Name,Last_Name,Address,City,State,Zip,Phone_Number,Email,Social_Security_Number,
                       Drivers_License,Birthday FROM patients WHERE First_Name = '$first_name' OR Last_Name = '$last_name' OR Email = '$email' ";

        $result = mysqli_query($link,$sql); 
        echo '
        <table width="600" border="2" cellpadding="4" cellspacing="2" style="white-space: nowrap;">
        <tr>
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
        <th>Edit</th>
        </tr>';

        while ($patients = mysqli_fetch_array($result)) 
        {
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
            echo "<td><form action='fetch_Patient_Record_Form.php' method='POST'>
                  <input type='hidden' name='CustomerID' value='".$patients["CustomerID"]."'/>
                  <input type='submit' name='edit' value='Edit' /></form></td>";
            echo "<tr>";
        }
        mysqli_close($link);
    }
}
?>