<?php
	require('functions.php');
	session_start();
	
	
	if(isset($_POST['submit']))
	{
		$city=$_POST['city'];
		$contact_no=$_POST['contact_no'];
		$email_id=$_POST['email_id'];
		$DOB=$_POST['DOB'];
		if($_POST['gender']=="male")
			$gender='M';
		else if($_POST['gender']=="female")
			$gender='F';
		$username=$_SESSION['user'];
		
		$image_name="no_profile_pic.jpg";
	
		if($_FILES['userfile']['name']=='')
			echo "NO file choosen";
		
		else 
			echo $_FILES['userfile']['name'];
		
		if($_FILES['userfile']['error']>0)
		;
		//echo "Error";
	
		else
		{
			$upfile="profile_pictures/".$username.".jpg";
			
			if(is_uploaded_file($_FILES['userfile']['tmp_name']))
			{
				if(!move_uploaded_file($_FILES['userfile']['tmp_name'],$upfile))
				echo "file could not move";
				
				else
				{
					$image_name=$_SESSION['user'].".jpg";
					//echo "file uploaded successfully";
				}
			}
			else echo "possible file attack";
		}
		
		$conn=connect_db();
		$query="update users set city='$city' , contact_no='$contact_no' , email_id='$email_id' , DOB='$DOB' , gender = '$gender' where username='$username'";
		
		$result=mysqli_query($conn,$query);
		echo mysqli_error($conn);
		
		links();
		echo "<br/><h1>Profile Edited successfully</h1>";
		
		exit();
	}
	
	else
		links();
?>

<html>
	<body>
		<form action="" method="post" enctype="multipart/form-data" >
			<br />
			<table border='1' style="background-color:CCC" align="center">
				<?php
					$user_info = get_user_info($_SESSION['user']);
				?>
				
				<tr>
					<?php
						$image=$user_info['profile_pic'];
						echo '<td><img src="profile_pictures/'.$image.'" width="120" height="100"/></td>';
						echo '<td>
								Change profile picture <br />
								<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>
								<input type="file" name="userfile" id="userfile"/>
							 </td>';
					?>
				</tr>
			
				<tr>
					<th>City</th>
					<td><input type="text" size="30" maxsize="40" name="city" id="city" value="<?php echo $user_info['city']?>"/></td>
				</tr>
				
				<tr>
					<th>Contact No.</th>
					<td><input type="text" size="30" maxsize="40" name="contact_no" id="contact_no" value="<?php echo $user_info['contact_no']?>"/></td>
				</tr>
				
				<tr>
					<th>Email Id</th>
					<td><input type="text" size="30" maxsize="40" name="email_id" id="email_id" value="<?php echo $user_info['email_id']?>"/></td>
				</tr>
				
				<tr>
					<th>Date Of Birth</th>
					<td><input type="Date" name="DOB" id="DOB" value="<?php echo $user_info['DOB']?>"/></td>
				</tr>
				
				<tr>
					<th>Gender</th>
					<td>
						Male <input type="radio" name="gender" value="male" checked="checked"/>
						Female <input type="radio" name="gender" value="female"/>
					</td>
				</tr>
				
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Save" name="submit"/></td>
				</tr>
			</table>
		</form>
	</body>
</html>
