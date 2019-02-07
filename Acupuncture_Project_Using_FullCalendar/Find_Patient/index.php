<html>    
<head>    
    <title>Find/Edit Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "/Global_CSS/global.css" type = "text/css" rel = "stylesheet" />
    <link href = "find_patient.css" type = "text/css" rel = "stylesheet" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
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
                <li class="nav-item"><a class="nav-link" href="/Add_Patient/index.php">Add Patient</a></li>
                <li class="nav-item"><a class="nav-link active" href = "#home">Find Patient</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Table_Query/index.php">Show All Data</a></li>
            </ul>
        </div>
    </nav>

    <h1>Find/Edit Patient Information</h1>
    <div class="container">
        <form form name = "form1" action="" method = "post" enctype = "multipart/form-data" >
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" placeholder="First Name" value = "">
              </div>
              <div class="form-group col-md-6">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Last Name" value = "">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email" value = "">
              </div>
              <div class="form-group col-md-6">
                <label for="number">Number</label>
                <input type="number" class="form-control" name="number" placeholder="Number" value = "">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="license">License</label>
                <input type="text" class="form-control" name="license" placeholder="License" value = "">
              </div>
              <div class="form-group col-md-6">
                <label for="ssn">SSN</label>
                <input type="number" class="form-control" name="ssn" placeholder="SSN" value = "">
              </div>
            </div>
            <input type="submit" class="btn btn-info btn-block" value="Search" name="submit">                              
        </form>
    </div>
    <div class="container-fluid"> 
    <?php
        if(isset($_POST['submit']))
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
            $drivers_license = mysqli_real_escape_string($link, $_REQUEST['license']);

            // attempt insert query execution
            $sql = "SELECT * FROM patients WHERE first_name = '$first_name' OR last_name = '$last_name' OR email = '$email' ";

            $result = mysqli_query($link,$sql); 
            echo '
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
                    </thead>';

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
            mysqli_close($link);
        }
    ?>    
    </div>
    </body>    
</html>    

