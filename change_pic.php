<?php
include("functions.php");
	session_start();
	$image_name="no_profile_pic.jpg";
	$username=$_SESSION['user'];
	if($_FILES['userfile']['error']>0)
	{
		links();
		echo "Error";
	}
	
	else
	{
		$upfile="profile_pictures/".$username.".jpg";
		
		if(is_uploaded_file($_FILES['userfile']['tmp_name']))
		{
			if(!move_uploaded_file($_FILES['userfile']['tmp_name'],$upfile))
			echo "file could not move";
			
			else
			{
				$image_name="$username.jpg";
				$conn=connect_db();
				$query="update users set profile_pic='$username.jpg' where username='".$username."'";
				$result=mysqli_query($conn,$query) or die("could not update profile pic");
				links();
				echo "<h2>Profile pic changed successfully</h2>";
			}
		}
		else 
		{
			links();
			echo "possible file attack";
		}
	}
?>