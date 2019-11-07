<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
if($link === false) die("ERROR: Could not connect. " . mysqli_connect_error());

$customer_id = $_SESSION['customer_id']; 
$charge_id = $_SESSION['charge_id'];
$total_charge = trim($_POST['total_charge'],'$');
$subtotal = trim($_POST['subtotal'],'$');
$balance = trim($_POST['balance'],'$');
$total_payment = trim($_POST['total_payment'],'$');
$co_pay = $_POST['co_pay'];
$tax = $_POST['tax'];

if(empty($co_pay)) $co_pay = 0.00;
if(empty($tax)) $tax = 0.00;

//var_dump($_POST);

$sql = "DELETE FROM payments WHERE customer_id = '$customer_id' AND charge_id = '$charge_id' ";
mysqli_query($link, $sql);

$sql2 = "DELETE FROM charges WHERE customer_id = '$customer_id' AND charge_id = '$charge_id' ";
mysqli_query($link, $sql2);

if(isset($_POST['submit_Update']))
{
	for($i = 0; $i < count($_POST['charge']); $i++)
	{
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
}

mysqli_close($link);
header("refresh:1;url= http://192.168.1.136:5555/Edit_Patient/index.php");
//header("refresh:1;url= http://192.168.1.113:4444/Edit_Patient/index.php");
?>