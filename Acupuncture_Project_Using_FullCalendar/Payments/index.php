<html>    
<head>    
    <title>Find/Edit Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "/Global_CSS/global.css" type = "text/css" rel = "stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='/lib/bootstrap.min.css' rel="stylesheet" />
    <script src='/lib/jquery-3.3.1.slim.min.js'></script>
    <script src='/lib/popper.min.js'></script>
    <script src='/lib/bootstrap.min.js'></script> 
    <script src='/lib/jquery.min.js'></script>
    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js'></script>
    <script>
    $(document).ready(function () 
    {
      $("#phone").inputmask({"mask": "(999) 999-9999"});
      $("#ssn").inputmask({"mask": "999-99-9999"});
    });
    </script>       
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
                <li class="nav-item"><a class="nav-link" href = "/Find_Patient/index.php">Find Patient</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Payments/index.php">Payments</a></li>
                <li class="nav-item"><a class="nav-link" href="/Reports/index.php">Reports</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Table_Query/index.php">Show All Data</a></li>
            </ul>
        </div>
    </nav>

<h1>Payments</h1>
    <div class="container">
        <form form name = "form1" action="" method = "post" enctype = "multipart/form-data" >
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" placeholder="First Name">
              </div>
              <div class="form-group col-md-6">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email">
              </div>
              <div class="form-group col-md-6">
                <label for="number">Number</label>
                <input type="text" class="form-control" name="number" id="phone" placeholder="Number">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="license">License</label>
                <input type="text" class="form-control" name="license" placeholder="License">
              </div>
              <div class="form-group col-md-6">
                <label for="ssn">SSN</label>
                <input type="text" class="form-control" name="ssn" id="ssn" placeholder="SSN">
              </div>
            </div>
            <input type="submit" class="btn btn-info btn-block" value="Search" name="submit">                              
        </form>
    </div>
    <div class="container-fluid"> 
    <?php
        if(isset($_POST['submit']))
        {
            $link = mysqli_connect("localhost", "root", "", "acupuncture");
           
            if($link === false)
                die("ERROR: Could not connect. " . mysqli_connect_error());
            
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
                            <th>Add Payments</th>
                            <th>Edit Payments</th>
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
                echo "<td><form action='/Payments/Add_Payment/index.php' method='POST'>
                      <input type='hidden' name='customer_id' value='".$patients["customer_id"]."'/>
                      <input type='submit' name='add' value='Add' /></form></td>";
                echo "<td><form action='/Payments/Edit_Payment/index.php' method='POST'>
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

