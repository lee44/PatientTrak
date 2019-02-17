<!DOCTYPE html>
<html>    
    <head>    
        <title>Registration Form</title>    
    </head>    
    <body>    
        <link href = "add_patient.css" type = "text/css" rel = "stylesheet" />

        <div class = "topnav">
            <a href = "/index.php">Home</a>
            <a class = "active" href="#home" >Add Patient</a>
            <a href = "/Find_Patient/index.php">Find Patient</a>
            <a href = "/Table_Query/index.php">Show All Data</a>
        </div>

        <h2>Patient Form</h2>    
        <form name = "form1" action="insert.php" method = "post" enctype = "multipart/form-data" >    
            <div class = "container">    
                <div class = "form_group">    
                    <label>First Name:</label>    
                    <input type = "text" name = "first_name" value = "" required/>    
                </div>      
                <div class = "form_group">    
                    <label>Last Name:</label>    
                    <input type = "text" name = "last_name" value = "" required/>    
                </div>
                <!-- <div class = "form_group">    
                    <label>Address:</label>    
                    <input type = "text" name = "Address" value = "" required/>    
                </div>  
                <div class = "form_group">    
                    <label>City:</label>    
                    <input type = "text" name = "City" value = "" required/>    
                </div>  
                <div class = "form_group">    
                    <label>State:</label>    
                    <input type = "text" name = "State" value = "" required/>    
                </div> 
                <div class = "form_group">    
                    <label>Zip:</label>    
                    <input type = "text" name = "Zip" value = "" required/>    
                </div> 
                <div class = "form_group">    
                    <label>Phone Number:</label>    
                    <input type = "text" name = "Phone Number" value = "" required/>    
                </div>  -->
                <div class = "form_group">    
                    <label>Email:</label>    
                    <input type = "text" name = "email" value = "" required/>    
                </div> 
                <!-- <div class = "form_group">    
                    <label>SSN:</label>    
                    <input type = "text" name = "SSN" value = "" required/>    
                </div> 
                <div class = "form_group">    
                    <label>Drivers License:</label>    
                    <input type = "text" name = "Drivers License" value = "" required/>    
                </div> 
                <div class = "form_group">    
                    <label>BirthDay:</label>    
                    <input type = "text" name = "BirthDay" value = "" required/>    
                </div> 
                <div class = "form_group">    
                    <label>Sex:</label>    
                    <input type = "text" name = "Sex" value = "" required/>    
                </div> 
                <div class = "form_group">    
                    <label>Marital Status:</label>    
                    <input type = "text" name = "Marital Status" value = "" required/>    
                </div> 
                <div class = "form_group">    
                    <label>Employer:</label>    
                    <input type = "text" name = "Employer" value = "" required/>    
                </div> 
                <div class = "form_group">    
                    <label>Occupation:</label>    
                    <input type = "text" name = "Occupation" value = "" required/>    
                </div> 
                <div class = "form_group">    
                    <label>Work Phone:</label>    
                    <input type = "text" name = "Work Phone" value = "" required/>    
                </div> --> 
                <div style='margin:25px 0px 25px 0px;padding: 10px;'>    
                    <h1 style='font-size:25px;font-family: Verdana;'>Upload File</h1>
                    <input type="file" name="file" id="fileSelect"/>

                    <h1 style='font-size:15px;font-family: Verdana;'>Description of File:</h1> 
                    <textarea name="description_entered" rows='5' cols='40'></textarea>
                </div>
                <div class = "form_group">    
                    <input type="submit" value="Submit">    
                </div>
            </div>    
        </form>    
    </body>    
</html>    

