<html>    
    <head>    
        <title>Find/Edit Patient</title>    
    </head>    
    <body>    
        <link href = "find_patient_css.css" type = "text/css" rel = "stylesheet" /> 

        <div class = "topnav">
            <a href = "/index.php">Home</a>
            <a href = "/Add_Patient/index.php">Add Patient</a>
            <a class = "active" href="#home" >Find Patient</a>
            <a href = "/Table_Query/index.php">Show All Data</a>
        </div>

        <h2>Find/Edit Patient Information</h2>    
        <form name = "form1" action="" method = "post" enctype = "multipart/form-data" >    
            <div class = "container">    
                <div class = "form_group">    
                    <label>First Name:</label>    
                    <input type = "text" name = "first_name" value = "" />    
                </div>      
                <div class = "form_group">    
                    <label>Last Name:</label>    
                    <input type = "text" name = "last_name" value = "" />    
                </div>
                <div class = "form_group">    
                    <label>Email:</label>    
                    <input type = "text" name = "email" value = "" />    
                </div> 
                <div class = "form_group">    
                    <label>Drivers License:</label>    
                    <input type = "text" name = "Drivers_License" value = "" />    
                </div> 
                <div class = "form_group">    
                    <input type="submit" value="Search" name="submit">    
                </div>
            </div>    
        </form>    
    </body>    
</html>    

<?php
if(isset($_POST['submit']))
{
    if(empty($_POST['first_name']))
        echo "Enter a search term";
    else
    {
                /* Attempt MySQL server connection.  */
        $link = mysqli_connect("localhost", "root", "", "acupuncture");
         
        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
         
        // The mysqli_real_escape_string() function escapes special characters in a string and create a legal SQL string to provide security against SQL injection.
        $first_name = mysqli_real_escape_string($link, $_REQUEST['first_name']);
        $last_name = mysqli_real_escape_string($link, $_REQUEST['last_name']);
        $email = mysqli_real_escape_string($link, $_REQUEST['email']);
        $drivers_license = mysqli_real_escape_string($link, $_REQUEST['Drivers_License']);
        // attempt insert query execution
        $sql = "SELECT CustomerID,First_Name,Last_Name,Address,City,State,Zip,Phone_Number,Email,Social_Security_Number,
                       Drivers_License,Birthday FROM patients WHERE First_Name = '$first_name' OR Last_Name = '$last_name' OR Email = '$email' ";

        $result = mysqli_query($link,$sql); 
        echo '
        <table width="600" border="2" cellpadding="4" cellspacing="2" style="white-space: nowrap;">
        <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State</th>
        <th>Zip</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>SSN</th>
        <th>Drivers License</th>
        <th>BirthDay</th>
        <th>Edit</th>
        </tr>';

        while ($patients = mysqli_fetch_array($result)) 
        {
            echo "<tr>";
            echo "<td>".$patients['First_Name']."</td>";
            echo "<td>".$patients['Last_Name']."</td>";
            echo "<td>".$patients['Address']."</td>";
            echo "<td>".$patients['City']."</td>";
            echo "<td>".$patients['State']."</td>";
            echo "<td>".$patients['Zip']."</td>";
            echo "<td>".$patients['Phone_Number']."</td>";
            echo "<td>".$patients['Email']."</td>";
            echo "<td>".$patients['Social_Security_Number']."</td>";
            echo "<td>".$patients['Drivers_License']."</td>";
            echo "<td>".$patients['Birthday']."</td>";
            echo "<td><form action='fetch_Patient_Record_Form.php' method='POST'>
                  <input type='hidden' name='CustomerID' value='".$patients["CustomerID"]."'/>
                  <input type='submit' name='edit' value='Edit' /></form></td>";
            echo "<tr>";
        }
        mysqli_close($link);
    }
}
?>