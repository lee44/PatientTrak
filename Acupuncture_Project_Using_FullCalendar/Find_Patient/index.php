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
                <li class="nav-item"><a class="nav-link" href = "#home">Find Patient</a></li>
                <li class="nav-item"><a class="nav-link" href="/Reports/index.php">Reports</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Table_Query/index.php">Show All Data</a></li>
            </ul>
        </div>
    </nav>

    <h1>Find Patient Information</h1>
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
                <input type="text" class="form-control" name="number" id="phone" placeholder="Number" value = "">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="license">License</label>
                <input type="text" class="form-control" name="license" placeholder="License" value = "">
              </div>
              <div class="form-group col-md-6">
                <label for="ssn">SSN</label>
                <input type="text" class="form-control" name="ssn" id="ssn" placeholder="SSN" value = "">
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
                            <th>View?</th>
                        </tr>
                    </thead>';

            while ($patients = mysqli_fetch_array($result)) 
            {
                echo 
                '<tbody>
                 <tr>
                 <td>'.$patients['first_name'].'</td>
                 <td>'.$patients['last_name'].'</td>
                 <td>'.$patients['address'].'</td>
                 <td>'.$patients['city'].'</td>
                 <td>'.$patients['state'].'</td>
                 <td>'.$patients['zip'].'</td>
                 <td>'.$patients['phone_number'].'</td>
                 <td>'.$patients['email'].'</td>
                 <td>'.$patients['ssn'].'</td>
                 <td>'.$patients['license'].'</td>
                 <td>'.date_format(new DateTime($patients['birthday']),"m/d/Y").'</td>
                 <td><form action="/Edit_Patient/index.php" method="POST">
                      <input type="hidden" name="customer_id" value="'.$patients['customer_id'].'"/>
                      <input type="submit" name="edit" value="View" /></form>
                 </td>
                 </tr>';
            }
                echo '</tbody>
                      </table>
                      </div>';
            mysqli_close($link);
        }
    ?>    
    </div>
    </body>    
</html>    

