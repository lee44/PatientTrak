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
                <li class="nav-item"><a class="nav-link" href="/Reports/index.php">Reports</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Table_Query/index.php">Show All Data</a></li>
            </ul>
        </div>
    </nav>

<h1>Birthday Report</h1>
    <div class="container">
      <form form name="form1" action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="starting_date">Starting Date</label>
            <input type="date" class="form-control" name="starting_date" required>
          </div>
          <div class="form-group col-md-6">
            <label for="ending_date">Ending Date</label>
            <input type="date" class="form-control" name="ending_date" required>
          </div>
        </div>
        <input type="submit" class="btn btn-info btn-block" name="search" value="Search">
      </form>
    </div>
    <div class="container-fluid"> 
    <?php
        if(isset($_POST['search']))
        {
            $link = mysqli_connect("localhost", "root", "", "acupuncture");
             
            if($link === false)
                die("ERROR: Could not connect. " . mysqli_connect_error());
            
            $starting_date = $_POST['starting_date'];
            $ending_date = $_POST['ending_date'];

            $sql = "SELECT * FROM patients WHERE birthday >= '$starting_date' AND birthday <= '$ending_date'";

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
                            <th>Birthday</th>
                            <th>Age</th>
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
                echo "<td>".$patients['birthday']."</td>";                

                $birthday = new DateTime($patients['birthday']);
                $now = new DateTime();
                $interval  = date_diff($birthday,$now);
                echo "<td>".$interval->format('%y')."</td>";
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

