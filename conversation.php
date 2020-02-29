<?php
	session_start();
	include('functions.php');
	links();
	$messages_to = $_REQUEST['messages_to'];
	$messages_from = $_SESSION['user'];
	
	$user_to = get_user_info($messages_to);
	$name_to = $user_to['name'];
	$image_to = $user_to['profile_pic'];
	
	$user_from = get_user_info($messages_from);
	$name_from = $user_from['name'];
	$image_from = $user_from['profile_pic'];
	
	$conversation = get_messages($messages_to,$messages_from);
?>

<html>
<head>
<script src="conversation.js" ></script>
</head>
<body>
	</br>
	<table width="100%" border="1" name="message_table" id="message_table">
	
	
	<?php
		
	
		echo '<tr>';
			
			echo '<td><img src="profile_pictures/'.$image_from.'" width="100" height="80" /><h2><a href="see_profile.php?id=
			'.$messages_from.'" style="color:blue">'.$name_from.'</a></h2></td>';
			echo '<td><img src="profile_pictures/'.$image_to.'" width="100" height="80" /><h2><a href="see_profile.php?id=
			'.$messages_to.'" style="color:blue">'.$name_to.'</a></h2></td>';
		echo '</tr>';
		
		echo "<tr>";
			echo "<td width='90'>";
				echo "<textarea rows='3' cols='90' name='new_message' id='new_message'></textarea>";
				echo "</br>";
				echo "<input type='button' value='Send' name='send' id='send' onclick='process(\"$messages_to\");'/>";
			echo "</td>";
			
			echo "<td></td>";
		echo "</tr>";
		
		echo '<div name="messages" id="messages">';
		while($row = mysqli_fetch_assoc($conversation)){
			
			$a_message = $row['message'];
			echo "<tr>";
			
			if($row['from_id']==$messages_to){
			
				echo "<td></td>";
				echo "<td style='background-color:9CC'>$a_message<br/>(".$row['time'].")</td>";
				
			
			}else{
				echo "<td style='background-color:pink'>$a_message<br/>(".$row['time'].")</td>";
				echo "<td></td>";
			}
			
			echo "</tr>";
		}
		
		messages_read($messages_to,$messages_from);//make read status = 1 for messages displayed 
	?>
	
	</div>
	</table>	
	
	
</body>