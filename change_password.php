<?php
	include("functions.php");
	session_start();
	links();
	echo '<h2 align="center" style="color:888"><u>Change Password</u></h2>';
	
	if(isset($_POST['old']))
	{
		$password=get_password($_SESSION['user']);
		if(md5($_POST['old'])!=$password)
		{
			echo "<h2>Entered password is not correct</h2>";
			echo "<br/><input type='button' value='Go Back' onclick = \" location.href='change_password.php'; \"  />";
		}
		
		else if(strlen($_POST['new'])<5)
		{
			echo "<h2>Please Enter new password of minimum length of 5 characters</h2>";
			echo "<br/><input type='button' value='Go Back' onclick = \" location.href='change_password.php'; \"  />";
		}
		
		else if($_POST['new']!=$_POST['new_again'])
		{
			echo "<h2>Enter same password in both given fields - new password and re enter new password</h2>";
			echo "<br/><input type='button' value='Go Back' onclick = \" location.href='change_password.php'; \"  />";
		}
		
		else
		{
			$username=$_SESSION['user'];
			$new_password=$_POST['new'];
			$conn=connect_db();
			$query="update users set password = 'md5($new_password)' where username='$username'";
			$result=mysqli_query($conn,$query) or die("could not change password");
			echo "<h2>Password changed successfully</h2>";
		}
	}
	
	else
	{
		echo "<form action='change_password.php' method='POST'>";
		
		echo "<table>";
		
			echo "<tr>";
				echo "<td>Enter your password : </td>";
				echo "<td><input type='password' size='30' maxlength='30' name='old'/></td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td>New password : </td>";
				echo "<td><input type='password' size='30' maxlength='30' name='new'/></td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td>Re enter your new password : </td>";
				echo "<td><input type='password' size='30' maxlength='30' name='new_again'/></td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td align='center' colspan='2'><input type='submit' value='submit'/></td>";
			echo "</tr>";
		
		echo "</table>";
		
		echo "</form>";
	
	}
?>