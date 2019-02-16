<?php
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
if($link === false) die("ERROR: Could not connect. " . mysqli_connect_error());

$customer_id = $_POST['customer_id']; 
$total_charge = trim($_POST['total_charge'],'$');
$subtotal = trim($_POST['subtotal'],'$');
$balance = trim($_POST['balance'],'$');
$total_payment = trim($_POST['total_payment'],'$');
$co_pay = $_POST['co_pay'];
$tax = $_POST['tax'];

if(empty($co_pay)) $co_pay = 0.00;
if(empty($tax)) $tax = 0.00;

for($i = 0; $i < count($_POST['charge']); $i++)
{
	$sql = "UPDATE charges
	        SET charge_description = '".$_POST['charge_description'][$i]."',
	            total_charge = '$total_charge',
	            charge = '".$_POST['charge'][$i]."',
	            subtotal = '$subtotal',
		        co_pay = '$co_pay',
		        tax = '$tax',
		        charge_note = '".$_POST['charge_note'][$i]."',
		        charge_created_at = '".$_POST['created_at'][$i]."'		        		 
		    WHERE customer_id = '$customer_id' AND charge_id = '".$_POST['charge_id']."'";
	mysqli_query($link, $sql);
}

for($i = 0; $i < count($_POST['payment']); $i++)
{
	$sql = "UPDATE payments
	SET total_payment = '$total_payment',
	    payment = '".$_POST['payment'][$i]."',
	    payment_type = '".$_POST['payment_type'][$i]."',
	    payment_note = '".$_POST['payment_note'][$i]."',
		payment_created_at = '".$_POST['payment_created_at'][$i]."',
		balance = '$balance'
    WHERE customer_id = '$customer_id' AND charge_id = '".$_POST['charge_id']."'";
	mysqli_query($link, $sql);
}

header("refresh:1;url= http://192.168.1.136:5555/Find_Patient/index.php");
mysqli_close($link);
?>