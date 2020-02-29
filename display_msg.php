<?php
	include('functions.php');
	session_start();
	links();
	
	if($_REQUEST['parent']=="inbox")
	echo '<h2 align="center" style="color:888"><u>Inbox Mail</u></h2>';
	
	if($_REQUEST['parent']=="sent")
	echo '<h2 align="center" style="color:888"><u>Sent Mail</u></h2>';
	
	if($_REQUEST['parent']=="draft")
	echo '<h2 align="center" style="color:888"><u>Draft Mail</u></h2>';
	
	
	$conn=connect_db();
	$query="select * from messages where mid='".$_REQUEST['mid']."'";
	$result=mysqli_query($conn,$query);
	$row=mysqli_fetch_assoc($result);
	
	echo "<table border='1' style='background-color:CCC' width='100%'>";
	
	if($_REQUEST['parent']!="draft")
	$from_name=get_name($row['from_id']);
	
	echo "<tr>";
	echo "<td>From  </td>";
	if($_REQUEST['parent']!="draft")
	echo "<td><a href='see_profile.php?id=".$row['from_id']."' style='color:blue' >$from_name </a></td>";
	echo "<td> <a href='see_profile.php?id=".$row['from_id']."' style='color:blue' >".$row['from_id']."</a></td>";
	echo "</tr>";
	
	if($_REQUEST['parent']!="draft")
	$to_name=get_name($row['to_id']);
	
	echo "<tr>";
	echo "<td>To  </td>";
	if($_REQUEST['parent']!="draft")
	echo "<td><a href='see_profile.php?id=".$row['to_id']."' style='color:blue' >$to_name </a></td>";
	echo "<td><a href='see_profile.php?id=".$row['to_id']."' style='color:blue' > ".$row['to_id']."</a></td>";
	echo "</tr>";
	
	echo "<tr>";
	echo "<td>Time  </td>";
	echo "<td colspan='2'>".$row['time']."</td>";
	
	echo "<tr>";
	echo "<td>Subject  </td>";
	echo "<td colspan='2'>".$row['subject']."</td>";
	
	echo "<tr>";
	echo "<td>Message  </td>";
	echo "<td colspan='2'>".$row['message']."</td>";
	echo "</tr>";
	
	if($_REQUEST['parent']=="draft")
	{
		echo "<tr>";
			echo "<form action='compose.php' method='post'>";
			echo "<input type='hidden' name='parent_hidden' value='draft' >";
			echo "<input type='hidden' name='to_hidden' value='".$row['to_id']."'>"; 
			echo "<input type='hidden' name='subject_hidden' value='".$row['subject']."'>";
			echo "<input type='hidden' name='message_hidden' value='".$row['message']."'>";
			echo "<td colspan='3' align='center'><input type='submit' value='send'</td>";
			echo "</form>";
		echo "</tr>";
	}
	
	else
	{
		echo "<tr>";
		
			echo "<td></td>";
		
			echo "<form action='compose.php' method='post'>";
			echo "<input type='hidden' name='parent_hidden' value='reply' >";
			
			if($_REQUEST['parent']=="inbox")
				echo "<input type='hidden' name='to_hidden' value='".$row['from_id']."'>"; 
			
			else
				echo "<input type='hidden' name='to_hidden' value='".$row['to_id']."'>"; 
			
			echo "<td align='center'><input type='submit' value='reply'/></td>";
			echo "</form>";
			
			echo "<form action='compose.php' method='post'>";
				echo "<input type='hidden' name='parent_hidden' value='forword' >";
				echo "<input type='hidden' name='subject_hidden' value='".$row['subject']."'>";
				echo "<input type='hidden' name='message_hidden' value='".$row['message']."'>";
				echo "<td align='center'><input type='submit' value='forward'/></td>";
			echo "</form>";
			
		echo "</tr>";
	}
	
	echo "</table>";
	
	if($row['read_status']==0&&$_REQUEST['parent']=="inbox")
	{
		$query="update messages set read_status=1 where mid='".$_REQUEST['mid']."'";
		$result=mysqli_query($conn,$query);
		if(!$result)
		echo "<br />could not perform update query";
	}
?>