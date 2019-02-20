<?php
session_start();
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
if($link === false) die("ERROR: Could not connect. " . mysqli_connect_error());

// When inserting data into mysql, it will convert the data to the proper datatype. For example, total is a decimal datatype in the DB. As long as the data
//being inserted doesnt contain any characters other than numbers, it will be accepted.
$customer_id = $_SESSION['customer_id']; 
$total_charge = trim($_POST['total_charge'],'$');
$subtotal = trim($_POST['subtotal'],'$');
$balance = trim($_POST['balance'],'$');
$total_payment = trim($_POST['total_payment'],'$');

if(empty($_POST['co_pay'])) $co_pay = 0.00; else $co_pay = $_POST['co_pay'];
if(empty($_POST['tax'])) $tax = 0.00; else $tax = $_POST['tax'];

$charge_id = uniqid();
for($i = 0; $i < count($_POST['charge']); $i++)
{
	//print_r($sql."\n");
	$sql = "INSERT INTO charges (charge_description,total_charge,charge,subtotal,co_pay,tax,customer_id,charge_note,charge_created_at,charge_id) 
	VALUES ('".$_POST['charge_description'][$i]."','$total_charge','".$_POST['charge'][$i]."','$subtotal','$co_pay','$tax','$customer_id',
		    '".$_POST['charge_note'][$i]."','".$_POST['created_at'][$i]."','$charge_id')";
	mysqli_query($link, $sql);
}

for($i = 0; $i < count($_POST['payment']); $i++)
{
	$sql = "INSERT INTO payments (total_payment,payment,payment_type,customer_id,payment_note,payment_created_at,charge_id,balance) 
	VALUES ('$total_payment','".$_POST['payment'][$i]."','".$_POST['payment_type'][$i]."','$customer_id',
		    '".$_POST['payment_note'][$i]."','".$_POST['payment_created_at'][$i]."','$charge_id','$balance')";
	mysqli_query($link, $sql);
}
mysqli_close($link);

//header("refresh:1;url= http://192.168.1.113:5555/Edit_Patient/index.php");
header("refresh:1;url= http://192.168.1.113:4444/Edit_Patient/index.php");
?>