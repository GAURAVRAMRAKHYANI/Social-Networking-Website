<?php
	include('functions.php');
	session_start();
	
	links();
	$conn=connect_db();

	
	echo '<h2 align="center" style="color:888"><u>Draft Mails</u></h2>';
	
	$query="select * from messages where from_id = '".$_SESSION['user']."' and read_status=2 order by time desc";
	$result=mysqli_query($conn,$query);

	if(!$result) 
	echo "Error in select query : " . mysqli_error($conn);

	$count=mysqli_num_rows($result);
	
	echo "<h2 align='center'>You have total <span style='color:blue'>$count</span> draft messages</h2>";
	
	echo "<table border='1' width='100%' style='background-color:DDD'>";
	echo "<tr>";
			echo "<td width='5'></td>";
			echo "<td style='background-color:AAA'>To</td>";
			echo "<td style='background-color:AAA'>Subject</td>";
			echo "<td style='background-color:AAA'>Time</td>";
	echo "</tr>";
	while($row = mysqli_fetch_assoc($result))
	{
		echo "<form action='display_msg.php' method='get'>";
			echo "<tr>";
				$mid=$row['mid'];
				$message=$row['message'];
				echo "<input type='hidden' name='mid' id='mid' value='$mid'/>";
				echo "<input type='hidden' name='parent' id='parent' value='draft'/>";
				echo "<td><input type='submit' value='See Message'/></td>";
				echo "<td>".$row['to_id']."</td>";
				echo "<td>".$row['subject']."</td>";
				echo "<td>".$row['time']."</td>";
			
			echo "</tr>";
		echo "</form>";
	}
	echo "</table>";
?>