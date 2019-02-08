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
        var values = [0,0,0,0,0];
        var sum;
        function calculate_total()
        {
            var i;
            sum = 0;
            for(i = 0; i < 5; i++)
                sum += values[i];

            console.log("Sum: " + sum.toFixed(2));
            console.log("Array " + values);
            $('#subtotal').text("$"+sum.toFixed(2));
        }
        
        $("#quantity, #base_price").keyup(function () 
        {
            var total = $("#quantity").val() * $("#base_price").val();
            $("#total").val("$"+total.toFixed(2));
            values[0] = total;
            calculate_total();            
        });
        $("#quantity2, #base_price2").keyup(function () 
        {
            var total = $("#quantity2").val() * $("#base_price2").val();
            $("#total2").val("$"+total.toFixed(2));
            values[1] = total;
            calculate_total();
        });
        $("#quantity3, #base_price3").keyup(function () 
        {
            var total = $("#quantity3").val() * $("#base_price3").val();
            $("#total3").val("$"+total.toFixed(2));
            values[2] = total;
            calculate_total();
        });
        $("#quantity4, #base_price4").keyup(function () 
        {
            var total = $("#quantity4").val() * $("#base_price4").val();
            $("#total4").val("$"+total.toFixed(2));
            values[3] = total;
            calculate_total();
        });
        $("#quantity5, #base_price5").keyup(function () 
        {
            var total = $("#quantity5").val() * $("#base_price5").val();
            $("#total5").val("$"+total.toFixed(2));
            values[4] = total;
            calculate_total();
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
                        <th class="col-5">DESCRIPTION</th>
                        <th class="col-2">QUANTITY</th>
                        <th class="col-2">BASE PRICE</th>
                        <th class="col-3">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="d-flex">
                        <td class="col-5"><input type="text" id="description" class="form-control" name="description"></td>
                        <td class="col-2"><input type="number" maxlength="2" id="quantity" class="form-control" name="quantity"></td>
                        <td class="col-2"><input type="number" maxlength="6" id="base_price" class="form-control" name="base_price"></td>
                        <td class="col-3"><input type="text" id="total" class="form-control" name="total1" readonly ></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"><input type="text" id="description2" class="form-control" name="description2"></td>
                        <td class="col-2"><input type="number" maxlength="2" id="quantity2" class="form-control" name="quantity2"></td>
                        <td class="col-2"><input type="number" maxlength="6" id="base_price2" class="form-control" name="base_price2"></td>
                        <td class="col-3"><input type="text" id="total2" class="form-control" name="total2" readonly ></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"><input type="text" id="description3" class="form-control" name="description3"></td>
                        <td class="col-2"><input type="number" maxlength="2" id="quantity3" class="form-control" name="quantity3"></td>
                        <td class="col-2"><input type="number" maxlength="6" id="base_price3" class="form-control" name="base_price3"></td>
                        <td class="col-3"><input type="text" id="total3" class="form-control" name="total3" readonly ></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"><input type="text" id="description4" class="form-control" name="description4"></td>
                        <td class="col-2"><input type="number" maxlength="2" id="quantity4" class="form-control" name="quantity4"></td>
                        <td class="col-2"><input type="number" maxlength="6" id="base_price4" class="form-control" name="base_price4"></td>
                        <td class="col-3"><input type="text" id="total4" class="form-control" name="total4" readonly ></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"><input type="text" id="description5" class="form-control" name="description5"></td>
                        <td class="col-2"><input type="number" maxlength="2" id="quantity5" class="form-control" name="quantity5"></td>
                        <td class="col-2"><input type="number" maxlength="6" id="base_price5" class="form-control" name="base_price5"></td>
                        <td class="col-3"><input type="text" id="total5" class="form-control" name="total5" readonly ></td>
                    </tr>
                </tbody>
            </table> 
            <table class="table">
                <tbody>
                    <tr class="d-flex">
                        <td class="col-5"></td>
                        <td class="col-2"></td>
                        <td class="col-2 misc">SUBTOTAL</td>
                        <td class="col-3 amount" id="subtotal"></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"></td>
                        <td class="col-2"></td>
                        <td class="col-2 misc">CO PAY</td>
                        <td class="col-3 amount" id="co_pay"></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"></td>
                        <td class="col-2"></td>
                        <td class="col-2 misc">TAXES</td>
                        <td class="col-3 amount" id="taxes"></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"></td>
                        <td class="col-2"></td>
                        <td class="col-2 misc">TOTAL</td>
                        <td class="col-3 amount" id="grand_total"></td>
                    </tr>
                    
                </tbody>
            </table>                            
        </form>
    </div>
    </body>    
</html>    

<!-- <div class="container">
        <form form name = "form1" action="" method = "post" enctype = "multipart/form-data" >
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="electric_accupuncture">Electric Accupuncture</label>
                $<input type="number" min="0.01" step="0.01" max="2500" class="form-control" name="electric_accupuncture">
              </div>
              <div class="form-group col-md-6">
                <label for="mox">Mox</label>
                $<input type="number" min="0.01" step="0.01" max="2500" class="form-control" name="mox">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="cup">Cup</label>
                $<input type="number" min="0.01" step="0.01" max="2500" class="form-control" name="cup">
              </div>
              <div class="form-group col-md-6">
                <label for="Manip">Manip</label>
                $<input type="number" min="0.01" step="0.01" max="2500" class="form-control" name="Manip">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="herb">Herb</label>
                $<input type="number" min="0.01" step="0.01" max="2500" class="form-control" name="herb">
              </div>
            </div>
            <input type="submit" class="btn btn-info btn-block" value="Search" name="submit">                              
        </form>
    </div> -->
