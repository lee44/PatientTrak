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
        $("#quantity, #base_price").keyup(function () 
        {
            if(!isNaN($("#quantity").val()) && $("#quantity").val().length != 0 && !isNaN($("#base_price").val()) && $("#base_price").val().length != 0)
            {
                var total = $("#quantity").val() * $("#base_price").val();
                $("#total").val(total.toFixed(2));  
            }
            else 
                $("input[name=total]").val(0.00);
            calculateSubtotal();
        });
        $("#quantity2, #base_price2").keyup(function () 
        {
            if(!isNaN($("#quantity2").val()) && $("#quantity2").val().length != 0 && !isNaN($("#base_price2").val()) && $("#base_price2").val().length != 0)
            {
                var total = $("#quantity2").val() * $("#base_price2").val();
                $("input[name=total2]").val(total.toFixed(2));
            }
            else 
                $("input[name=total2]").val(0.00);
            calculateSubtotal();
        });
        $("#quantity3, #base_price3").keyup(function () 
        {
            if(!isNaN($("#quantity3").val()) && $("#quantity3").val().length != 0 && !isNaN($("#base_price3").val()) && $("#base_price3").val().length != 0)
            {
                var total = $("#quantity3").val() * $("#base_price3").val();
                $("input[name=total3]").val(total.toFixed(2));
            }
            else 
                $("input[name=total3]").val(0.00);
            calculateSubtotal();
        });
        $("#quantity4, #base_price4").keyup(function () 
        {
            if(!isNaN($("#quantity4").val()) && $("#quantity4").val().length != 0 && !isNaN($("#base_price4").val()) && $("#base_price4").val().length != 0)
            {
                var total = $("#quantity4").val() * $("#base_price4").val();
                $("input[name=total4]").val(total.toFixed(2));
            }
            else 
                $("input[name=total4]").val(0.00);
            calculateSubtotal();
        });
        $("#quantity5, #base_price5").keyup(function () 
        {
            if(!isNaN($("#quantity5").val()) && $("#quantity5").val().length != 0 && !isNaN($("#base_price5").val()) && $("#base_price5").val().length != 0)
            {
                var total = $("#quantity5").val() * $("#base_price5").val();
                $("input[name=total5]").val(total.toFixed(2));
            }
            else 
                $("input[name=total5]").val(0.00);
            calculateSubtotal();
        });
        $("#co_pay").keyup(function () 
        {
            if(!isNaN($("#co_pay").val()) && $("#co_pay").val().length != 0)
                calculateTotal(0.00);
        });
        $("#taxes").keyup(function () 
        {
            if(!isNaN($("#taxes").val()) && $("#taxes").val().length != 0)
                calculateTotal(0.00);
        });

        function calculateSubtotal() 
        {
            var sum = 0;
            
            $(".total").each(function() 
            {
                if(!isNaN(this.value) && this.value.length!=0)
                    sum += parseFloat(this.value);     
            });
            
            $("#subtotal").html(sum.toFixed(2));
            calculateTotal(sum);
        }

        function calculateTotal(amount) 
        {
            var sum = 0;
            
            $(".misc_amount").each(function() 
            {
                if(!isNaN(this.value) && this.value.length!=0)
                    sum += parseFloat(this.value);     
            });
            sum += amount;
            $("#grand_total").html(sum.toFixed(2));
        }
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
                        <td class="col-5"><input type="text"   id="description" class="form-control" name="description"></td>
                        <td class="col-2"><input type="number" id="quantity"    class="form-control" name="quantity"></td>
                        <td class="col-2"><input type="number" id="base_price"  class="form-control" name="base_price"></td>
                        <td class="col-3"><input type="text"   id="total"       class="form-control total" name="total" readonly ></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"><input type="text"   id="description2" class="form-control" name="description2"></td>
                        <td class="col-2"><input type="number" id="quantity2"    class="form-control" name="quantity2"></td>
                        <td class="col-2"><input type="number" id="base_price2"  class="form-control" name="base_price2"></td>
                        <td class="col-3"><input type="text"   id="total"        class="form-control total" name="total2" readonly ></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"><input type="text"   id="description3" class="form-control" name="description3"></td>
                        <td class="col-2"><input type="number" id="quantity3"    class="form-control" name="quantity3"></td>
                        <td class="col-2"><input type="number" id="base_price3"  class="form-control" name="base_price3"></td>
                        <td class="col-3"><input type="text"   id="total"        class="form-control total" name="total3" readonly ></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"><input type="text"   id="description4" class="form-control" name="description4"></td>
                        <td class="col-2"><input type="number" id="quantity4"    class="form-control" name="quantity4"></td>
                        <td class="col-2"><input type="number" id="base_price4"  class="form-control" name="base_price4"></td>
                        <td class="col-3"><input type="text"   id="total"        class="form-control total" name="total4" readonly ></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"><input type="text"   id="description5" class="form-control" name="description5"></td>
                        <td class="col-2"><input type="number" id="quantity5"    class="form-control" name="quantity5"></td>
                        <td class="col-2"><input type="number" id="base_price5"  class="form-control" name="base_price5"></td>
                        <td class="col-3"><input type="text"   id="total"        class="form-control total" name="total5" readonly ></td>
                    </tr>
                </tbody>
            </table> 
            <table class="table">
                <tbody>
                    <tr class="d-flex">
                        <td class="col-5"></td>
                        <td class="col-2"></td>
                        <td class="col-2 misc_label">SUBTOTAL</td>
                        <td class="col-3" id="subtotal">0.00</td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"></td>
                        <td class="col-2"></td>
                        <td class="col-2 misc_label">CO PAY</td>
                        <td class="col-3"><input type="number" id="co_pay" class="form-control misc_amount" name="co_pay" required></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"></td>
                        <td class="col-2"></td>
                        <td class="col-2 misc_label">TAXES</td>
                        <td class="col-3"><input type="number" id="taxes" class="form-control misc_amount" name="taxes" required></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-5"></td>
                        <td class="col-2"></td>
                        <td class="col-2 misc_label">TOTAL</td>
                        <td class="col-3" id="grand_total">0.00</td>
                    </tr>
                    
                </tbody>
            </table>                            
        </form>
    </div>
    </body>    
</html>    