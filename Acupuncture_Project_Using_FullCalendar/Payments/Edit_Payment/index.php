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
        <?php
        echo '
        <h1>Payments</h1>
        <div class="container">
            <form form name = "form1" action="" method = "post" enctype = "multipart/form-data" >
            <input type="hidden" name="customer_id" value="'.$_POST['customer_id'].'"/>';

            if(isset($_POST['submit']))
            {
                $link = mysqli_connect("localhost", "root", "", "acupuncture");
               
                if($link === false)
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                
                $customer_id = $_POST['customer_id'];

                $sql = "SELECT * FROM payments WHERE customer_id = '$customer_id'";

                $result = mysqli_query($link,$sql); 
                echo '
                <table class="table table-bordered">
                    <thead>
                        <tr class="d-flex">
                            <th class="col-3">DATE</th>
                            <th class="col-7">DESCRIPTION</th>
                            <th class="col-2">CHARGE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="d-flex">
                            <td class="col-3"><input type="date"   class="form-control"        name="created_at[]" required></td>
                            <td class="col-7"><input type="text"   class="form-control"        name="description[]" required></td>
                            <td class="col-2"><input type="number" class="form-control charge" name="charge[]" step="any" min="0" max="100" required></td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-3"><input type="date"   class="form-control"        name="created_at[]"></td>
                            <td class="col-7"><input type="text"   class="form-control"        name="description[]"></td>
                            <td class="col-2"><input type="number" class="form-control charge" name="charge[]" step="any" min="0" max="100" ></td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-3"><input type="date"   class="form-control"        name="created_at[]"></td>
                            <td class="col-7"><input type="text"   class="form-control"        name="description[]"></td>
                            <td class="col-2"><input type="number" class="form-control charge" name="charge[]" step="any" min="0" max="100"></td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-3"><input type="date"   class="form-control"        name="created_at[]"></td>
                            <td class="col-7"><input type="text"   class="form-control"        name="description[]"></td>
                            <td class="col-2"><input type="number" class="form-control charge" name="charge[]" step="any" min="0" max="100"></td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-3"><input type="date"   class="form-control"        name="created_at[]"></td>
                            <td class="col-7"><input type="text"   class="form-control"        name="description[]"></td>
                            <td class="col-2"><input type="number" class="form-control charge" name="charge[]" step="any" min="0" max="100"></td>
                        </tr>
                    </tbody>
                </table> 
                <table class="table">
                    <tbody>
                        <tr class="d-flex">
                            <td class="col-3"></td>
                            <td class="col-7 misc_label">SUBTOTAL</td>
                            <td class="col-2">
                                <input type="text" id="subtotal" class="form-control" name="subtotal" readonly>
                            </td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-3"></td>
                            <td class="col-7 misc_label">CO PAY</td>
                            <td class="col-2"><input type="number" id="co_pay" class="form-control charge" name="co_pay" step="any" min="0" max="100"></td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-3"></td>
                            <td class="col-7 misc_label">TAXES</td>
                            <td class="col-2"><input type="number" id="taxes" class="form-control charge" name="taxes" step="any" min="0" max="100"></td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-3"></td>
                            <td class="col-7 misc_label">TOTAL</td>
                            <td class="col-2">
                                <input type="text" id="grand_total" class="form-control" name="grand_total" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table> 
                <div class="form-row">
                    <div class="form-group col-3"></div>
                    <div class="form-group col-6"><input type="submit" class="btn btn-info btn-block" value="Submit"></div>
                    <div class="form-group col-3"></div>
                </div> 
                ';

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
                     <td>'.$patients['birthday'].'</td>
                     <td><form action="/Payments/Add_Payment/index.php" method="POST">
                          <input type="hidden" name="customer_id" value="'.$patients['customer_id'].'"/>
                          <input type="submit" name="add" value="Add"/></form></td>
                     <td><form action="/Payments/Edit_Payment/index.php" method="POST">
                          <input type="hidden" name="customer_id" value="'.$patients['customer_id'].'"/>
                          <input type="submit" name="edit" value="Edit"/></form></td>
                     </tr>';
                }
                    echo
                    '</tbody>
                     </table>
                     </div>';
                mysqli_close($link);
            }  
        echo
        '                       
        </form>
        </div>';
        ?>
    </body>    
</html>