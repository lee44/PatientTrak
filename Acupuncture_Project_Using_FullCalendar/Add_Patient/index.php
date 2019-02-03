<!DOCTYPE html>
<html>    
    <head>    
        <title>Registration Form</title>    
    </head>    
    <body>    
    <link href = "add_patient.css" type = "text/css" rel = "stylesheet" />

    <div class = "page">
        <div class = "menu topnav">
            <a href = "/index.php">Home</a>
            <a class = "active" href="#home" >Add Patient</a>
            <a href = "/Find_Patient/index.php">Find Patient</a>
            <a href = "/Table_Query/index.php">Show All Data</a>
        </div>

        <h2>Patient Form</h2>

        <form name = "form1" action="insert.php" method = "post" enctype = "multipart/form-data" >   
            <div class = "column"> 
                <div class = "form_contents">
                    <label>First Name:</label>    
                    <input type = "text" name = "first_name" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>Last Name:</label>    
                    <input type = "text" name = "last_name" value = "" required/>  
                </div>       
                <div class = "form_contents">
                    <label>Address:</label>    
                    <input type = "text" name = "Address" value = "" required/>
                </div> 
                <div class = "form_contents"> 
                    <label>City:</label>    
                    <input type = "text" name = "City" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>State:</label>    
                    <input type = "text" name = "State" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>Zip:</label>    
                    <input type = "text" name = "Zip" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>Phone Number:</label>    
                    <input type = "text" name = "Phone Number" value = "" required/>        
                </div>    
                <div class = "form_contents">
                    <label>Email:</label>    
                    <input type = "text" name = "email" value = "" required/>
                </div>
                <div class = "form_contents"> 
                    <label>SSN:</label>    
                    <input type = "text" name = "SSN" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>Drivers License:</label>    
                    <input type = "text" name = "Drivers License" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>Birthday:</label>    
                    <input type = "text" name = "BirthDay" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>Sex:</label>    
                    <input type = "text" name = "Sex" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>Marital Status:</label>    
                    <input type = "text" name = "Marital Status" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>Employer:</label>    
                    <input type = "text" name = "Employer" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>Occupation:</label>    
                    <input type = "text" name = "Occupation" value = "" required/>    
                </div>
                <div class = "form_contents">
                    <label>Work Phone:</label>    
                    <input type = "text" name = "Work Phone" value = "" required/>  
                </div>  
              
                <div class = 'uploadFile'>    
                    <h2>Upload File</h2>
                    <input type="file" name="file" id="fileSelect"/>

                    <h4>Description of File:</h4> 
                    <textarea name="description_entered" rows='7' cols='45' style="resize: none;"></textarea>
                    
                    <input type="submit" value="Submit">  
                </div>

            </div>         
        </form> 
    </div>
    </body>    
</html>    

