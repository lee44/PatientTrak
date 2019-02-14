<?php
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
if($link === false) die("ERROR: Could not connect. " . mysqli_connect_error());

// When inserting data into mysql, it will convert the data to the proper datatype. For example, total is a decimal datatype in the DB. As long as the data
//being inserted doesnt contain any characters other than numbers, it will be accepted.
$customer_id = $_POST['customer_id']; 
$total_charges = trim($_POST['total_charges'],'$');
$subtotal = trim($_POST['subtotal'],'$');
$balance = trim($_POST['balance'],'$');
$total_payment = trim($_POST['total_payment'],'$');
$co_pay = $_POST['co_pay'];
$taxes = $_POST['taxes'];

if(empty($co_pay)) $co_pay = 0.00;
if(empty($taxes)) $taxes = 0.00;

$charge_id = uniqid();
for($i = 0; $i < count($_POST['charges']); $i++)
{
	$sql = "INSERT INTO charges (charge_descriptions,total_charges,charges,subtotal,co_pay,taxes,customer_id,charge_notes,charge_created_at,charge_id) 
	VALUES ('".$_POST['charge_descriptions'][$i]."','$total_charges','".$_POST['charges'][$i]."','$subtotal','$co_pay','$taxes','$customer_id',
		    '".$_POST['charge_notes'][$i]."','".$_POST['created_at'][$i]."','$charge_id')";
	mysqli_query($link, $sql);
}

for($i = 0; $i < count($_POST['payments']); $i++)
{
	$sql = "INSERT INTO payments (total_payments,payments,payment_type,customer_id,payment_notes,payment_created_at,charge_id) 
	VALUES ('$total_payment','".$_POST['payments'][$i]."','".$_POST['payment_type'][$i]."','$customer_id',
		    '".$_POST['payment_notes'][$i]."','".$_POST['payment_created_at'][$i]."','$charge_id')";
	mysqli_query($link, $sql);
}

$customer_id = mysqli_insert_id($link);

header("refresh:1;url= http://192.168.1.136:5555/Payments/index.php");
mysqli_close($link);
?>