<?php
	session_start();
	include('functions.php');
	$conn = connect_db();
	$my_username = $_SESSION['user'];
	$tid = $_REQUEST['tid'];
	$comment = $_REQUEST['comment'];
	
	$query = "insert into comments(tid,comment_by,comment) values($tid,'$my_username','$comment')";
	$result = mysqli_query($conn,$query);
	if(!$result)
		echo mysqli_error($conn);
			
	$query = "update timeline set comments=comments+1 where tid=$tid";
	$result = mysqli_query($conn,$query);
	if(!$result)
		echo mysqli_error($conn);
			
	$username = get_username_from_tid($tid);
	
	if($username!=$my_username){
		$query = "insert into notifications(id,username,from_id,notice) values($tid,'$username','$my_username','comment')";
		$result = mysqli_query($conn,$query);
		if(!$result)
			echo mysqli_error($conn);
	}
?>