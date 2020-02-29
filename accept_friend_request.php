<?php
	include("functions.php");
	session_start();
	
	$conn = connect_db();
	$id1 = $_REQUEST['requested_to'];
	$id2 = $_SESSION['user'];
	
	$query = "update friends set status = 'accepted' where requested_by='$id1' and requested_to='$id2'" ;
		
	$result = mysqli_query($conn , $query) or die("Could not insert friend request");
	
	$query = "insert into notifications(username,from_id,notice) values('$id1','$id2','request accepted')" ;
	$result = mysqli_query($conn , $query);
	if(!$result)
	mysqli_error($conn);
	
?>