<?php
	session_start();
	include('functions.php');
	$conn=connect_db();
	$change=$_REQUEST['change'];
	$tid=$_REQUEST['tid'];
	$username=$_SESSION['user'];
	
	if($change=="positive")
	{
		$query="update timeline set likes=likes+1 where tid=$tid";
		
		$result = mysqli_query($conn,$query);
		
		if(!$result)
			mysqli_error();
			
		$query="insert into likes(tid,liked_by) values($tid,'$username')";
		
		$result = mysqli_query($conn,$query);
		
		if(!$result)
			mysqli_error();
	}
	
	if($change=="negative")
	{
		$query="update timeline set likes=likes-1 where tid=$tid";
		
		$result = mysqli_query($conn,$query);
		
		if(!$result)
			mysqli_error();
			
		$query="delete from likes where tid=$tid and liked_by='$username'";
		
		$result = mysqli_query($conn,$query);
		
		if(!$result)
			mysqli_error();
	}
?>