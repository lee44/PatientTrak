<html>    
<head>    
    <title>Find/Edit Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "/Global_CSS/global.css" type = "text/css" rel = "stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href = "add_payment.css" type = "text/css" rel = "stylesheet" />
    <link href='/lib/bootstrap.min.css' rel="stylesheet" />
    <script src='/lib/jquery-3.3.1.slim.min.js'></script>
    <script src='/lib/popper.min.js'></script>
    <script src='/lib/bootstrap.min.js'></script> 
    <script src='/lib/jquery.min.js'></script>
    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js'></script>
    <script>
    $(document).ready(function () 
    {
        //iterate through each textboxes and add keyup handler to trigger sum event
        $(".charge").each(function () 
        {
            $(this).keyup(function()
            {
                var subtotal = 0, grand_total = 0;
            
                $(".charge").each(function() 
                {
                    //In a method, this refers to the owner object which is the element that has the class charge.
                    //$(this).attr is still referring to the owner object. attr is a jquery method and you can't get the attribute using this.attr
                    //$(".charge").attr doesn't work cuz we have 5 elements with class = charge. Thats why you use $(this) since we are cycling thru all 5 elements
                    if(!isNaN(this.value) && this.value.length!=0 && $(this).attr('id') != 'co_pay' && $(this).attr('id') != 'taxes')
                        subtotal += parseFloat(this.value);
                    if(!isNaN(this.value) && this.value.length!=0)
                        grand_total += parseFloat(this.value);
                });
                $("#subtotal").html(subtotal.toFixed(2));
                $("#grand_total").html(grand_total.toFixed(2));
            });
        });
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

<h1>Add Payments</h1>
    <div class="container">
        <form form name = "form1" action="" method = "post" enctype = "multipart/form-data" >
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
                        <td class="col-3"><input type="date"                    class="form-control" name="date" required></td>
                        <td class="col-7"><input type="text"   id="description" class="form-control" name="description"></td>
                        <td class="col-2"><input type="number" id=""            class="form-control charge" name="charge"></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"><input type="date"                    class="form-control" name="date" required></td>
                        <td class="col-7"><input type="text"   id="description" class="form-control" name="description2"></td>
                        <td class="col-2"><input type="number" id="charge"      class="form-control charge" name="charge"></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"><input type="date"                    class="form-control" name="date" required></td>
                        <td class="col-7"><input type="text"   id="description" class="form-control" name="description3"></td>
                        <td class="col-2"><input type="number" id="charge"      class="form-control charge" name="charge"></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"><input type="date"                    class="form-control" name="date" required></td>
                        <td class="col-7"><input type="text"   id="description" class="form-control" name="description4"></td>
                        <td class="col-2"><input type="number" id="charge"      class="form-control charge" name="charge"></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"><input type="date"                    class="form-control" name="date" required></td>
                        <td class="col-7"><input type="text"   id="description" class="form-control" name="description5"></td>
                        <td class="col-2"><input type="number" id="charge"      class="form-control charge" name="charge"></td>
                    </tr>
                </tbody>
            </table> 
            <table class="table">
                <tbody>
                    <tr class="d-flex">
                        <td class="col-3"></td>
                        <td class="col-7 misc_label">SUBTOTAL</td>
                        <td class="col-2" id="subtotal">0.00</td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"></td>
                        <td class="col-7 misc_label">CO PAY</td>
                        <td class="col-2"><input type="number" id="co_pay" class="form-control charge" name="co_pay" required></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"></td>
                        <td class="col-7 misc_label">TAXES</td>
                        <td class="col-2"><input type="number" id="taxes" class="form-control charge" name="taxes" required></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"></td>
                        <td class="col-7 misc_label">TOTAL</td>
                        <td class="col-2" id="grand_total">0.00</td>
                    </tr>
                </tbody>
            </table> 
            <div class="form-row">
                <div class="form-group col-3"></div>
                <div class="form-group col-6"><input type="submit" class="btn btn-info btn-block" value="Submit"></div>
                <div class="form-group col-3"></div>
            </div> 
                                      
        </form>
    </div>
    </body>    
</html>    