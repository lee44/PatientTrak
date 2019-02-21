<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
if($link === false)
    die("ERROR: Could not connect. " . mysqli_connect_error());
 
$customer_id = $_SESSION['customer_id'];
$charge_id = mysqli_real_escape_string($link, $_REQUEST['charge_id']);

//Charges
$sql = "SELECT * FROM charges WHERE customer_id = '$customer_id' AND charge_id = '$charge_id'";
$result = mysqli_query($link,$sql);

$charges = [];
while($charges_array = mysqli_fetch_array($result,MYSQLI_ASSOC))
    array_push($charges,$charges_array);

//Payments
$sql2 = "SELECT * FROM payments WHERE customer_id = '$customer_id' AND charge_id = '$charge_id'";
$result2 = mysqli_query($link,$sql2);

$payments = [];
while($payments_array = mysqli_fetch_array($result2,MYSQLI_ASSOC))
    array_push($payments, $payments_array);

//var_dump($payments);

$_SESSION['charge_id'] = $payments[0]['charge_id'];

mysqli_close($link);
?>

<html>    
<head>    
    <title>Charges and Payments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href = "/Global_CSS/global.css" type = "text/css" rel = "stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href = "edit_payment.css" type = "text/css" rel = "stylesheet" />
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
        {   //Everytime a key goes up the callback function is called
            $(this).keyup(function()
            {
                var subtotal = 0, grand_total = 0, total_payments = 0,payment = 0, payment2 = 0, balance = 0;
            
                $(".charge").each(function() 
                {
                    //In a method, this refers to the owner object which is the element that has the class charge.
                    //$(this).attr is still referring to the owner object. attr is a jquery method and you can't get the attribute using this.attr
                    //$(".charge").attr doesn't work cuz we have 5 elements with class = charge. Thats why you use $(this) since we are cycling thru all 5 elements
                    if(!isNaN(this.value) && this.value.length !=0 && $(this).attr('id') != 'co_pay' && $(this).attr('id') != 'taxes' && $(this).attr('id') != 'payment' && $(this).attr('id') != 'payment2')
                        subtotal += parseFloat(this.value);
                    if(!isNaN(this.value) && this.value.length !=0 && $(this).attr('id') != 'payment' && $(this).attr('id') != 'payment2')
                        grand_total += parseFloat(this.value);
                    if(!isNaN(this.value) && this.value.length !=0 && $(this).attr('id') == 'payment')
                        payment += parseFloat(this.value);
                    if(!isNaN(this.value) && this.value.length !=0 && $(this).attr('id') == 'payment2')
                        payment2 += parseFloat(this.value);
                    
                });
                total_payments = payment + payment2;
                balance = grand_total - total_payments;
                $("#subtotal").val('$'+subtotal.toFixed(2));
                $("#total_charges").val('$'+grand_total.toFixed(2));
                $("#total_payment").val('$'+total_payments.toFixed(2));

                $("#balance").val('$'+balance.toFixed(2));
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
                <li class="nav-item"><a class="nav-link" href="/Reports/index.php">Reports</a></li>
                <li class="nav-item"><a class="nav-link" href = "/Table_Query/index.php">Show All Data</a></li>
            </ul>
        </div>
    </nav>

<h1>Charges and Payments</h1>
    <div class="container">
        <form form name = "form1" action="delete_update_payment.php" method = "POST" enctype = "multipart/form-data" >
            <?php echo '<input type="hidden" name="charge_id" value="'.$_POST['charge_id'].'"/>';?>
            <table class="table table-bordered">
                <thead>
                    <tr class="d-flex">
                        <th class="col-3">DATE</th>
                        <th class="col-3">CHARGE DESCRIPTION</th>
                        <th class="col-2">CHARGE</th>
                        <th class="col-4">NOTES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($charges); $i++)
                    echo '
                    <tr class="d-flex" id="charge_row'.($i+1).'">
                        <td class="col-3"><input type="date"   class="form-control"        name="created_at[]" value="'.$charges[$i]['charge_created_at'].'" required></td>
                        <td class="col-3"><input type="text"   class="form-control"        name="charge_description[]" value="'.$charges[$i]['charge_description'].'" required></td>
                        <td class="col-2"><input type="number" class="form-control charge" name="charge[]" step="any" min="0" max="1000" value="'.$charges[$i]['charge'].'" required></td>
                        <td class="col-4"><input type="text"   class="form-control"        name="charge_note[]" value="'.$charges[$i]['charge_note'].'"></td>
                    </tr>'
                    ?>
                </tbody>
            </table> 
            <table class="table">
                <tbody>
                    <?php
                    echo '
                    <tr class="d-flex">
                        <td class="col-3"><button type="button" class="btn btn-primary" onclick="add_Charge()">Add Charges</button></td>
                        <td class="col-7 misc_label">SUBTOTAL</td>
                        <td class="col-2">
                            <input type="text" id="subtotal" class="form-control" name="subtotal" readonly value="$'.$charges[0]['subtotal'].'">
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"></td>
                        <td class="col-7 misc_label">CO PAY</td>
                        <td class="col-2"><input type="number" id="co_pay" class="form-control charge" name="co_pay" step="any" min="0" max="1000" value="'.$charges[0]['co_pay'].'"></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"></td>
                        <td class="col-7 misc_label">TAXES</td>
                        <td class="col-2"><input type="number" id="taxes" class="form-control charge" name="tax" step="any" min="0" max="1000" value="'.$charges[0]['tax'].'"></td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"></td>
                        <td class="col-7 misc_label">TOTAL</td>
                        <td class="col-2">
                            <input type="text" id="total_charges" class="form-control" name="total_charge" readonly value="$'.$charges[0]['total_charge'].'">
                        </td>
                    </tr>';
                    ?>
                </tbody>
            </table> 
            <table class="table table-bordered">
                <thead>
                    <tr class="d-flex">
                        <th class="col-3">DATE</th>
                        <th class="col-3">PAYMENT TYPE</th>
                        <th class="col-2">PAYMENT</th>
                        <th class="col-4">NOTES</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for($i = 0; $i < count($payments); $i++)
                    echo '
                    <tr class="d-flex" id="payment_row'.($i+1).'">
                        <td class="col-3"><input type="date"   class="form-control"        name="payment_created_at[]" value="'.$payments[$i]['payment_created_at'].'" required></td>
                        <td class="col-3"><input type="text"   class="form-control"        name="payment_type[]" maxlength="11" value="'.$payments[$i]['payment_type'].'"></td>
                        <td class="col-2"><input type="number" id="payment" class="form-control charge" name="payment[]" step="any" min="0" max="10000" value="'.$payments[$i]['payment'].'"></td>
                        <td class="col-4"><input type="text"   class="form-control"        name="payment_note[]" value="'.$payments[$i]['payment_note'].'"></td>
                    </tr>';
                    ?>                 
                </tbody>
            </table>
            <table class="table">
                <tbody>
                    <?php
                    echo '
                    <tr class="d-flex">
                        <td class="col-3"><button type="button" class="btn btn-primary" onclick="add_Payment()">Add Payments</button></td>
                        <td class="col-7 misc_label">TOTAL PAYMENT</td>
                        <td class="col-2">
                            <input type="text" id="total_payment" class="form-control" name="total_payment" readonly value="$'.$payments[0]['total_payment'].'">
                        </td>
                    </tr>
                    <tr class="d-flex">
                        <td class="col-3"></td>
                        <td class="col-7 misc_label">BALANCE</td>
                        <td class="col-2">
                            <input type="text" id="balance" class="form-control" name="balance" readonly value="$'.$payments[0]['balance'].'">
                        </td>
                    </tr>';
                    ?>
                </tbody>
            </table>
            <div class="form-row">
                <div class="form-group col-3"><input type="submit" class="btn btn-danger btn-block" name="submit_Delete" value="Delete" onclick="return confirm('Are you sure you want to delete?');"></div>
                <div class="form-group col-6"></div>
                <div class="form-group col-3"><input type="submit" class="btn btn-info btn-block" name="submit_Update" value="Update"></div>
            </div> 
        </form>
    </div>
    </body>
    <script type="text/javascript">
    function addKeyUpHandlers()
    {
        //iterate through each textboxes and add keyup handler to trigger sum event
        $(".charge").each(function () 
        {   //Everytime a key goes up the callback function is called
            $(this).keyup(function()
            {
                var subtotal = 0, grand_total = 0, total_payments = 0,payment = 0, payment2 = 0, balance = 0;
            
                $(".charge").each(function() 
                {
                    //In a method, this refers to the owner object which is the element that has the class charge.
                    //$(this).attr is still referring to the owner object. attr is a jquery method and you can't get the attribute using this.attr
                    //$(".charge").attr doesn't work cuz we have 5 elements with class = charge. Thats why you use $(this) since we are cycling thru all 5 elements
                    if(!isNaN(this.value) && this.value.length !=0 && $(this).attr('id') != 'co_pay' && $(this).attr('id') != 'taxes' && $(this).attr('id') != 'payment' && $(this).attr('id') != 'payment2')
                        subtotal += parseFloat(this.value);
                    if(!isNaN(this.value) && this.value.length !=0 && $(this).attr('id') != 'payment' && $(this).attr('id') != 'payment2')
                        grand_total += parseFloat(this.value);
                    if(!isNaN(this.value) && this.value.length !=0 && $(this).attr('id') == 'payment')
                        payment += parseFloat(this.value);
                    if(!isNaN(this.value) && this.value.length !=0 && $(this).attr('id') == 'payment2')
                        payment2 += parseFloat(this.value);
                    
                });
                total_payments = payment + payment2;
                balance = grand_total - total_payments;
                $("#subtotal").val('$'+subtotal.toFixed(2));
                $("#total_charges").val('$'+grand_total.toFixed(2));
                $("#total_payment").val('$'+total_payments.toFixed(2));

                $("#balance").val('$'+balance.toFixed(2));
            });
        });
    }
    function add_Charge()
    {
        var count = $('input[name="charge_description[]"]').length;
        $('#charge_row'+count).after(
                                '<tr class="d-flex" id="charge_row'+(count+1)+'">'+
                                '<td class="col-3"><input type="date"   class="form-control"        name="created_at[]" required></td>'+
                                '<td class="col-3"><input type="text"   class="form-control"        name="charge_description[]" required></td>'+
                                '<td class="col-2"><input type="number" class="form-control charge" name="charge[]" step="any" min="0" max="500" required></td>'+
                                '<td class="col-4"><input type="text"   class="form-control"        name="charge_note[]"></td>'+
                                '</tr>');
        addKeyUpHandlers();
    }
    function add_Payment()
    {
        var count = $('input[name="payment_type[]"]').length;
        $('#payment_row'+count).after(
                                '<tr class="d-flex" id="payment_row'+(count+1)+'">'+
                                '<td class="col-3"><input type="date"   class="form-control"        name="payment_created_at[]" required></td>'+
                                '<td class="col-3"><input type="text"   class="form-control"        name="payment_type[]" maxlength="11" required></td>'+
                                '<td class="col-2"><input type="number" id="payment" class="form-control charge" name="payment[]" step="any" min="0" max="1000" required></td>'+
                                '<td class="col-4"><input type="text"   class="form-control"        name="payment_note[]"></td>'+
                                '</tr>');
        addKeyUpHandlers();
    }
    </script>      
</html>    