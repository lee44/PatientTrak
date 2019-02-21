<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
if($link === false)
    die("ERROR: Could not connect. " . mysqli_connect_error());

if(isset($_POST['customer_id']))
{
  $_SESSION['customer_id'] = $_POST['customer_id'];
  $customer_id = $_POST['customer_id'];
}
else
{
  $customer_id = $_SESSION['customer_id'];
}

//Patient Info
$sql =
"SELECT P.customer_id,P.first_name,P.last_name,P.address,P.city,P.state,P.zip,P.phone_number,P.email,P.ssn,P.license,P.birthday,P.sex,
        P.employer,P.occupation,P.notes,F.file_name
 FROM patients AS P 
 LEFT JOIN files AS F ON P.customer_id = F.customer_id
 WHERE P.customer_id = '$customer_id'";
$result = mysqli_query($link,$sql);
$patients = mysqli_fetch_array($result);

//mysqli_fetch_array only grabs the first row of the query. To get all the rows, you would put it in a while loop but we only need
//the file name of the second,third,fourth row etc .
$files = array();
array_push($files,$patients['file_name']);
while($f = mysqli_fetch_array($result))
  array_push($files,$f['file_name']);

//Patient Payments
$sql2 = "SELECT * FROM payments AS P WHERE P.customer_id = '$customer_id'";
$result2 = mysqli_query($link,$sql2);

mysqli_close($link);
?>

<html>    
<head>    
    <title>Patient Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "/Global_CSS/global.css" type = "text/css" rel = "stylesheet" />
    <link href = "edit_patient.css" type = "text/css" rel = "stylesheet" /> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="/lib/bootstrap.min.css" rel="stylesheet" />
    <script src="/lib/jquery-3.3.1.slim.min.js"></script>
    <script src="/lib/popper.min.js"></script>
    <script src="/lib/bootstrap.min.js"></script> 
    <script src="/lib/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
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
                <li class="nav-item"><a class="nav-link" href="/Reports/index.php">Reports</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Table_Query/index.php">Show All Data</a></li>
            </ul>
        </div>
    </nav>

    <h1>Patient Information</h1>
    <div class="container">
      <form id="patient_form" action="delete_Patient_Record.php" method="post" enctype="multipart/form-data">
      
        <div class="form-row">
          <div class="form-group col-md-4"><input type="button" class="btn btn-info" value="Update" onclick="update_Patient()"></div>
          <div class="form-group col-md-4"></div>
          <div class="form-group col-md-4"><input type="submit" class="btn btn-danger float-right" value="Delete"></div>
        </div>
        
        <div class="form-row">
          <div class="form-group col-md-2">
            <label for="id">ID</label>
            <?php echo'<input type="text" class="form-control" id="customer_id" name="customer_id" value ="'.$patients['customer_id'].'" readonly>';?>
          </div>
          <div class="form-group col-md-5">
            <label for="first_name">First Name</label>
            <?php echo'<input type="text" class="form-control" name="first_name" placeholder="First Name" value ="' .$patients['first_name'].'" required>';?>
          </div>
          <div class="form-group col-md-5">
            <label for="last_name">Last Name</label>
            <?php echo'<input type="text" class="form-control" name="last_name" placeholder="Last Name" value ="' .$patients['last_name'].'" required>';?>
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Address</label>
          <?php echo'<input type="text" class="form-control" name="address" placeholder="1234 Main St" value ="' .$patients['address'].'" required>';?>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <?php echo'<input type="text" class="form-control" name="city" placeholder="City" value ="' .$patients['city'].'" required>';?>
          </div>
          <div class="form-group col-md-4">
            <label for="inputState">State</label>
            <?php echo'<input type="text" class="form-control" name="state" placeholder="State" value ="' .$patients['state'].'" required>';?>
          </div>
          <div class="form-group col-md-2">
            <label for="inputZip">Zip</label>
            <?php echo'<input type="text" class="form-control" name="zip" placeholder="Zip" value ="' .$patients['zip'].'" required>';?>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="employer">Employer</label>
            <?php echo'<input type="text" class="form-control" name="employer" placeholder="Employer" value ="' .$patients['employer'].'" required>';?>
          </div>
          <div class="form-group col-md-6">
            <label for="occupation">Occupation</label>
            <?php echo'<input type="text" class="form-control" name="occupation" placeholder="Occupation" value ="' .$patients['occupation'].'" required>';?>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <?php echo'<input type="email" class="form-control" name="email" placeholder="Email" value ="' .$patients['email'].'" required>';?>
          </div>
          <div class="form-group col-md-6">
            <label for="number">Number</label>
            <?php echo'<input type="text" class="form-control" name="number" id="phone" placeholder="Number" value ="' .$patients['phone_number'].'" required>';?>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="license">License</label>
            <?php echo'<input type="text" class="form-control" name="license" placeholder="License" value ="' .$patients['license'].'" required>';?>
          </div>
          <div class="form-group col-md-6">
            <label for="ssn">SSN</label>
            <?php echo'<input type="text" class="form-control" name="ssn" id="ssn" placeholder="SSN" value ="' .$patients['ssn'].'" required>';?>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="birthday">Birthday</label>
            <?php echo'<input type="date" class="form-control" name="birthday" placeholder="Birthday" value ="' .$patients['birthday'].'" required>';?>
          </div>
          <div class="form-group col-md-6">
            <label for="gender">Gender</label>
            <div class="form-check">
            <?php
            $male = '';$female = '';
            if($patients['sex'] == 'Male' || $patients['sex'] == 'M') 
              $male = 'checked';
            else
              $female = 'checked';
            ?>
            
              <div class="form-row">
                <div class="form-group col-sm-6" id="radio">
                  <label class="form-check-label radio-inline control-label" for="gridRadios1">
                    <?php echo'<input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male "'.$male.'> Male';?>
                  </label>
                </div>
                <div class="form-group col-sm-6" id="radio">
                <label class="form-check-label radio-inline control-label" for="gridRadios2">
                  <?php echo'<input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female "'.$female.'>Female';?>
                </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class = "uploadFile">    
          <h2>Upload File</h2>
          <?php
          if(!is_null($files[0]))
          {  
            echo '<h4>Current Files:</h4>';
            for($i = 0; $i < count($files); $i++)
              echo '<div class="form-row" id = "r'.$i.'">
                      <div class="form-group col-sm-4">
                        <a style="font-size:17px;" href = "http://192.168.1.113:4444/Add_Patient/Uploads/'.$files[$i].'">'.$files[$i].'</a>
                      </div>
                      <div class="form-group col-sm-8" align="left">
                        <button class="btn btn-danger" type="button" id="x_button'.$i.'" value="'.$files[$i].'" onclick="deleteFile(this.id,this.value)"><i class="fa fa-close"></i></button>
                      </div>
                    </div>';
          }
          ?>
          <h4>New Files:</h4>
          <div class="form-row">
            <div class="form-group col-xs-6">
              <div class="form-row" id = "row1">
                <div class="form-group col-xs-6">
                  <input type="file" name="upload[]">
                </div>
                <div class="form-group col-xs-6" align="center" id="xbutton">
                  <button class="btn btn-danger" type="button" id="x_button1" onclick="removeRow(this.id)"><i class="fa fa-close"></i></button>
                </div>
              </div>
            </div>
            <div class="form-group col-xs-6">
              <button class="btn add_more btn-primary" type="button">Add More Files</button>
            </div>
          </div>
          <h4>Description of File:</h4> 
          <?php echo'<textarea name="description" value ="'.$patients['notes'].'" rows="4" cols="40"></textarea>';?>
        </div>      
      </form>
    </div>
    <div class="container payment_history_container">
      <h2 id="payment_history_header">Payment History</h2>

      <form action="/Payments/Add_Payment/index.php" method="POST">
        <div class="form-row">
            <div class="form-group col-md-8"></div>
            <div class="form-group col-md-4"><input type="submit" class="btn btn-info float-right" value="Add">
        </div>
      </form>
      
      <div class="table-responsive" id="payment_table">
          <table class = "table table-striped">
              <thead>
                  <tr>
                      <th>Date Created</th>
                      <th>Payment Type</th>
                      <th>Payment</th>
                      <th>Balance</th>
                      <th>Payment Notes</th>
                      <th>Edit?</th>
                  </tr>
              </thead>
              <?php
              while ($payments = mysqli_fetch_array($result2)) 
              {
                  echo 
                  '<tbody>
                   <tr>
                   <td>'.date_format(new DateTime($payments['payment_created_at']),"m/d/Y").'</td>
                   <td>'.$payments['payment_type'].'</td>
                   <td>$'.$payments['payment'].'</td>
                   <td>$'.$payments['balance'].'</td>
                   <td>'.$payments['payment_note'].'</td>
                   <td><form action="/Payments/Edit_Payment/index.php" method="POST">
                        <input type="hidden" name="charge_id" value="'.$payments['charge_id'].'"/>
                        <input type="submit" name="edit" value="Edit"
                         /></form>
                   </td>
                   </tr>';
              }
              ?>
                  </tbody>
          </table>
      </div>
    </div> 
</body> 
<script type="text/javascript">
  function update_Patient()
  {
    var fd = new FormData($('#patient_form')[0]);
   
    $.ajax(
      {
        type: 'POST',
        url: 'update_Patient_Record.php',
        data: fd,
        contentType: false,
        processData: false,
        success: function (response) 
        {
          alert_Success();
          // alert("You will now be redirected.");
          // window.location = "http://192.168.1.136:5555";
        },
        error: function () {}
      });
  }

  function deleteFile(id,filename)
  {
    var r = confirm("Are you sure you want to delete this file?")
    if(r == true)
    {
      var res = id.substring(8,id.length);
      $("#"+id).parents("#r"+res).remove();
      
      var customer_id = $("#customer_id").val();
      $.ajax(
      {
        type: 'POST',
        url: 'delete_file.php',
        data: '&customer_id=' + customer_id + '&file=' + filename,
        success: function (response) {},
        error: function () {}
      });
    }
  }
  var counter = 1;
  $('.add_more').click(function(e)
  {
    counter++;
    var row_id = "#row"+counter;
    var html_file = "<div class='form-row' id = row"+counter+">"+
                      "<div class='form-group col-xs-6'>"+
                        "<input type='file' name='upload[]'/></div>"+
                      "<div class='form-group col-xs-6' align='center' id='xbutton'>"+
                        "<button class='btn btn-danger' type='button' id='x_button"+counter+"' onclick='removeRow(this.id)'><i class='fa fa-close'></i></button>"+
                      "</div>"+
                    "</div>";

    $("#row1").after(html_file);
  });
  function removeRow(id)
  {
    if(id != "x_button1")
    {
      var res = id.substring(8,id.length);
      $("#row"+res).remove();
    }
  }
  function alert_Success()
  {
    $("h1").before('<div id="alertBox" class="container"><div id="alertBoxText" class="alert alert-success"><strong>Patient Information Updated!!!</strong></div>');
    $('#alertBox').fadeOut(2200);
  }

</script>      
</html>

<!-- 
<a href = 'http://76.91.29.148:5555/Add_Patient/Uploads/".$patients['name']."'>".$patients['name']."</a>
<img src =../Add_Patient/Uploads/".$patients['name']." width='100' height='100'> 

<a href = 'http://76.91.29.148:5555/Add_Patient/Uploads/".$patients['name']."'>".$patients['name']."
  <img src =../Add_Patient/Uploads/".$patients['name']." width='120' height='100'>
</a>  

Only JPG, PNG, or any image type will show pic.
Word and Excel dont show image but ask to download once you click on them
PDF doesnt show image but does show it if you click the link which takes you to another tab.
-->