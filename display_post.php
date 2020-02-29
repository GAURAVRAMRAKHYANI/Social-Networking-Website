<?php
	function display_post($tid,$username,$likes,$comments,$text,$image,$time)
	{
		$my_info = get_user_info($_SESSION['user']);
		$user_info = get_user_info($username);
		echo "<br/>";
		echo "<table align='center' style='background-color:white' width='50%' border='1' name='".$tid."' id='".$tid."'>";
					
		echo "<tr>";
							
			echo "<td rowspan='2' width='60'>";
			echo "<img src='profile_pictures/".$user_info['profile_pic']."' width='60' height='50'/> ";
			echo "</td>";
							
			echo "<td><a href='see_profile.php?id=".$user_info['username']."' style='color:blue'>".$user_info['name']."</a></td>";
							
		echo "</tr>";
						
		echo "<tr>";
			echo "<td style='color:blue'> ( ".$time." ) </td>";
		echo "</tr>";
						
		echo "<tr>";
			echo "<td colspan='2' height='10'></br>".nl2br($text)."</td>";
		echo "</tr>";
		
		
		if($image){
			echo "<tr>";
				echo "<td colspan='2' height='10' style='background-color:DDD'></br><img src='post_images/".$tid.".jpg' width='300' height='250' style='display: block;margin-left: auto; margin-right: auto;'/></td>";
			echo "</tr>";
		}
		
		$like_by_me = is_like_by_me($my_info['username'],$tid);
						
						
		//Row for displaying no_of_likes and no_of_comments
		echo "<tr>";
			echo "<td colspan='2' height='15' style='background-color:EDD'>";
							

			$tid_like = $tid."_like_span";
			$tid_image = $tid."_image";
			$tid_comment = $tid."_comment";
			$tid_new_comment = $tid."_new_comment";
							
			if(!$like_by_me){
						
				$other_likes = $likes;
							
				echo "<input type='image' src='images/like.jpg' name='".$tid_image."' id='".$tid_image."' width='45' height='20' onclick='change_likes(".$tid.",".$other_likes.")'/>";
							
				echo "<span name='".$tid_like."' id='".$tid_like."'> $other_likes </span>"; 
							
			}
						
			else{
						
				$other_likes = $likes-1;
							
				echo "<input type='image' src='images/dislike.jpg' name='".$tid_image."' id='".$tid_image."' width='45' height='20' onclick='change_likes(".$tid.",".$other_likes.")'/>";
							 
							
							 
				echo "<span name='".$tid_like."' id='".$tid_like."'> You and $other_likes other</span>";
			}
						
			echo "<span title='".other_peoples_like_it($tid)."' style='color:blue'> peoples </span> likes this , ";
							
			echo "<span name='".$tid_comment."' id='".$tid_comment."'>$comments comments</span>";
		echo "</tr>";
						
						
		//Rows for displaying all previous comments
		$comments = get_previous_comments($tid);
						
		while($comment_row=mysqli_fetch_assoc($comments)){
			$comment_by=$comment_row['comment_by'];
			$comment_user_info=get_user_info($comment_by);
			$profile_pic=$comment_user_info['profile_pic'];
			$name=$comment_user_info['name'];
			$comment=$comment_row['comment'];
			echo "</tr>";
				echo "<td colspan='2' style='word-wrap:break-word;max-width:2px;background-color:FFFFEE;max-hieght:20px'>";
					echo "<img src='profile_pictures/".$profile_pic."' width='45' height='40' border='1' style='margin:0;padding:0'/>";
					$_comment_by="'".$comment_by."'";
					echo " <span style='position:relative ; bottom:27px;'>".
						"<a href='see_profile.php?id=$comment_by' style='color:blue'>"  
						.$name.
						"</a>".
						"</span>
						</br><span style='position:relative ;bottom:25px;left:50px;color:blue'>".
						"(".$comment_row['time'].")</span><br />";
						echo "<span style='position:relative;bottom:10px'>".nl2br($comment)."</span>";
				echo "</td>";
			echo "</tr>";
		}
						
						
			//Row for New Comment
			echo "<tr>";
				echo "<td colspan='2'>";
					echo "<img src='profile_pictures/".$my_info['profile_pic']."' width='45' height='35'/>";
					echo "<textarea maxlength='200' rows='2' cols='70' name='".$tid_new_comment."' id='".$tid_new_comment."'></textarea>";
					$my_profile_pic=$my_info['profile_pic'];
					$my_name=$my_info['name'];
					echo "<input type='button' value='comment' style='position:relative;bottom:10' onclick='add_comment(".$tid.",\"".$my_name."\",\"".$my_profile_pic."\",".$image.")'/>"; 
					echo "</td>";
			echo "</tr>";
		echo "</table>";
		echo "</br></br>";
	}
?>