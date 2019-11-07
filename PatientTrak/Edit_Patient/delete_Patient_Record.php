<?php
$link = mysqli_connect("localhost", "root", "", "acupuncture");
 
if($link === false)
    die("ERROR: Could not connect. " . mysqli_connect_error());

$customer_id = $_POST['customer_id'];

$sql1 = "DELETE FROM charges WHERE customer_id = '$customer_id'";
mysqli_query($link, $sql1);

$sql2 = "DELETE FROM files WHERE customer_id = '$customer_id'";
mysqli_query($link, $sql2);

$sql3 = "DELETE FROM patients WHERE customer_id = '$customer_id'";
mysqli_query($link, $sql3);

$sql4 = "DELETE FROM payments WHERE customer_id = '$customer_id'";
mysqli_query($link, $sql4);

mysqli_close($link);

//header("refresh:1;url= http://192.168.1.136:5555/Find_Patient/index.php");
header("refresh:1;url= http://192.168.1.113:4444/Find_Patient/index.php");
exit();
?>