<?php 
	unlink('C:\Users\Lee\Desktop\Git\Web-Projects\Acupuncture_FullCalendar\Add_Patient\Uploads\\'.$_POST['file']);
	
	$link = mysqli_connect("localhost", "root", "", "acupuncture");

	// Check connection
	if($link === false)
	    die("ERROR: Could not connect. " . mysqli_connect_error());

	$customer_id = $_POST['customer_id'];
	$file_name = $_POST['file'];

	$sql = "DELETE FROM files WHERE customer_id = '$customer_id' AND file_name = '$file_name' ";

	mysqli_query($link, $sql);
    mysqli_close($link);
?>