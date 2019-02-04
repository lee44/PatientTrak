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
                <li class="nav-item"><a class="nav-link" href = "/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="#home">Add Patient</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Find_Patient/index.php">Find Patient</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Table_Query/index.php">Show All Data</a></li>
            </ul>
        </div>
    </nav>

    <h1>Patient Information</h1>
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
                        <label for="address" class="col-sm-5 col-form-label">Address:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="address">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="zip" class="col-sm-5 col-form-label">Zip:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="zip">
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

                    <div class="form-group row">
                        <label for="employer" class="col-sm-5 col-form-label">Employer:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="employer">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="lname" class="col-sm-5 control-label">Gender:</label>
                        <div class="col-sm-7">
                            <div class="row">
                                <div class="col-sm-7">
                                    <div class="form-check">
                                        <label class="form-check-label radio-inline control-label" for="gridRadios1">
                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="male" checked>
                                            Male
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <div class="form-check">
                                        <label class="form-check-label radio-inline control-label" for="gridRadios2">
                                            <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="female">    
                                            Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <label for="city" class="col-sm-5 col-form-label">City:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="city">
                        </div>
                    </div>    
                    <div class="form-group row">
                        <label for="state" class="col-sm-5 col-form-label">State:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="state">
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
                    <div class="form-group row">
                        <label for="occupation" class="col-sm-5 col-form-label">Occupation:</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" id="occupation">
                        </div>
                    </div>
                    <div class="form-group row align-items-center">
                        <label for="birthDate" class="col-sm-5 control-label">Birthday:</label>
                        <div class="col-sm-7">
                            <input type="date" id="birthDate" class="form-control" required="required">
                        </div>
                    </div>
                </div>
            </div>
            <div class = 'uploadFile'>    
              <h2>Upload File</h2>
              <input type="file" name="file" id="fileSelect"/>
              <h4>Description of File:</h4> 
              <textarea name="description_entered" rows='4' cols='40'></textarea>
            </div>
            <input type="submit" class="btn btn-info btn-block" value="Submit">              
        </form> 
    </div>
    </body>    
</html>    