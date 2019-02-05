<!DOCTYPE html>
<html>    
<head>    
    <title>Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "add_patient.css" type = "text/css" rel = "stylesheet" />
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
          <li class="nav-item"><a class="nav-link" href="/index.php">Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="#home">Add Patient</a></li>
          <li class="nav-item"><a class="nav-link" href="/Find_Patient/index.php">Find Patient</a></li>
          <li class="nav-item"><a class="nav-link" href="/Table_Query/index.php">Show All Data</a></li>
        </ul>
      </div>
    </nav>

    <h1>Patient Information</h1>
    <div class="container">
      <form form name="form1" action="insert.php" method="post" enctype="multipart/form-data">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
          </div>
          <div class="form-group col-md-6">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
          </div>
        </div>
        <div class="form-group">
          <label for="inputAddress">Address</label>
          <input type="text" class="form-control" name="inputAddress" placeholder="1234 Main St">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" name="inputCity" placeholder="City">
          </div>
          <div class="form-group col-md-4">
            <label for="inputState">State</label>
            <input type="text" class="form-control" name="state" placeholder="State">
          </div>
          <div class="form-group col-md-2">
            <label for="inputZip">Zip</label>
            <input type="text" class="form-control" name="inputZip" placeholder="Zip">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="employer">Employer</label>
            <input type="text" class="form-control" name="employer" placeholder="Employer">
          </div>
          <div class="form-group col-md-6">
            <label for="occupation">Occupation</label>
            <input type="text" class="form-control" name="occupation" placeholder="Occupation">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
          </div>
          <div class="form-group col-md-6">
            <label for="number">Number</label>
            <input type="number" class="form-control" name="number" placeholder="Number">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="license">License</label>
            <input type="text" class="form-control" name="license" placeholder="License">
          </div>
          <div class="form-group col-md-6">
            <label for="ssn">SSN</label>
            <input type="number" class="form-control" name="ssn" placeholder="SSN">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="birthday">Birthday</label>
            <input type="date" class="form-control" name="birthday" placeholder="Birthday">
          </div>
          
          <div class="form-group col-md-6">
            <label for="gender">Gender</label>
            <div class="form-check">
            
              <div class="form-row">
                <div class="form-group col-sm-6">
                  <label class="form-check-label radio-inline control-label" for="gridRadios1">
                    <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" checked> Male
                  </label>
                </div>
                <div class="form-group col-sm-6">
                <label class="form-check-label radio-inline control-label" for="gridRadios2">
                  <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female">Female
                </label>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <div class = 'uploadFile'>    
          <h2>Upload File</h2>
          <input type="file" name="file" id="fileSelect"/>
          <h4>Description of File:</h4> 
          <textarea name="description" value="" rows='4' cols='40'></textarea>
        </div>
        <input type="submit" class="btn btn-info btn-block" value="Submit">      
      </form>
    </div>

    </body>    
</html>    