<?php
	include('functions.php');
	session_start();
	links();
?>

<html>
<head>
	<script type="text/javascript">
		function send()
		{
			msg_type.value="send";
			message_form.submit();
		}
		
		function save()
		{
			msg_type.value="save";
			message_form.submit();
		}
	</script>
</head>

<body>
	<br/>
	<br/>
	<form action="send_msg.php" method="post" id="message_form">
		<table>
			<tr>
				<td>To</td>
				<?php
					if(isset($_POST['to_hidden']))
					{	
						$to_hidden=$_POST['to_hidden'];
						echo '<td><input type="text" name="to" id="to" maxlength="100" size="150" value="'.$to_hidden.'"/>';
					}
					
					else
					echo '<td><input type="text" name="to" id="to" maxlength="100" size="150"/>';
				?>
			</tr>
			
			<tr>
				<td>Subject</td>
				<?php
					if(isset($_POST['subject_hidden']))
					{	
						$subject_hidden=$_POST['subject_hidden'];
						echo '<td><input type="text" name="subject" id="subject" maxlength="100" size="150" value="'.$subject_hidden.'"/>';
					}
					
					else
					echo '<td><input type="text" name="subject" id="subject" maxlength="100" size="150"/>';
				?>
			</tr>
			
			<tr>
				<td>Message</td>
				<?php
					if(isset($_POST['message_hidden']))
					{
						$message_hidden=$_POST['message_hidden'];
						echo '<td><textarea name="message" id="message" rows="20" cols="150">'.$message_hidden.'</textarea></td>';
					}
					
					else
						echo '<td><textarea name="message" id="message" rows="20" cols="150"></textarea></td>';
				?>
			</tr>
			
			<input type="hidden" id="msg_type" name="msg_type" />
			
			<tr>
				<td colspan="2" align="center"><input type="button" value="Send" onclick="send()"/></td>
			</tr>
			
			<tr>
				<td colspan="2" align="center"><input type="button" value="Save" onclick="save()"/></td>
			</tr>
			
			<?php
				/*
				if(isset($_POST['to_hidden']))
				{
					to.value="$_POST['to_hidden']";
				}
				
				if(isset($_POST['subject_hidden']))
				{
					subject.value="$_POST['subject_hidden']";
				}
				
				if(isset($_POST['message_hidden']))
				{
					message.value="$_POST['message_hidden']";
				}
				*/
			?>
			
		</table>
	</form>
</body>
</html>