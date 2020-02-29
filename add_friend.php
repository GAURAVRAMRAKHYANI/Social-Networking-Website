<?php
	include("functions.php");
	session_start();
	
	$conn = connect_db();
	$requested_to = $_REQUEST['requested_to'];
	$requested_by = $_SESSION['user'];
	
	$query = "insert into friends(requested_by,requested_to) values('$requested_by','$requested_to')" ;
		
	$result = mysqli_query($conn , $query);
	
	
	$query = "insert into notifications(username,from_id,notice) values('$requested_to','$requested_by','friend request')" ;
	$result = mysqli_query($conn , $query);
	if(!$result)
	mysqli_error($conn);
?>