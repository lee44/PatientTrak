<html>    
<head>    
    <title>Birthday Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "/Global_CSS/global.css" type = "text/css" rel = "stylesheet" />
    <link href = "/Reports/Customer_Reports/Birthday_Report/birthday_report.css" type = "text/css" rel = "stylesheet" />
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

<h1>Birthday Report By Month</h1>
    <div class="container">
      <form form name="form1" action="" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label id="choose_month" for="months">Choose Month</label>
            <br>
<!-- 
onchange will excecute the javascript function, this.form.submit() when an option from drop down list is chosen. This function is like the submit button.
The array has all the options to be displayed and foreach loop will echo the option elements when page is loaded. However when page is first
loaded, $selected = '' because no value has been passed by POST method. When a option is selected, the page reloads cuz of this.form.submit() and
$_POST['Month'] = 0 because when page was loaded for first time value="0". 
 -->
            <?php
                $options = array(0 => '...', 1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July',
                                 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
            ?>
            <select name="Months" id = "months" onchange="this.form.submit();">
            <?php
            foreach($options as $key => $value) 
            {
                $selected = (isset($_POST['Months']) && intval($_POST['Months']) === $key) ? ' selected="selected"' : ''; 
                echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
            }
            ?>    
            </select>

          </div>
          <div class="form-group col-md-6"></div>
        </div>
      </form>
    </div>
    <div class="container-fluid"> 
    <?php
        if(isset($_POST['Months']))
        {
            $link = mysqli_connect("localhost", "root", "", "acupuncture");
             
            if($link === false)
                die("ERROR: Could not connect. " . mysqli_connect_error());
            
            $month = $_POST['Months'];

            $sql = "SELECT * FROM patients WHERE MONTH(birthday) = '$month' ";

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
                 <td>'.$patients['birthday'].'</td>';                

                $birthday = new DateTime($patients['birthday']);
                $now = new DateTime();
                $interval  = date_diff($birthday,$now);
                echo '<td>'.$interval->format('%y').'</td>
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

