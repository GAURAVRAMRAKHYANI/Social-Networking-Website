<?php
include("functions.php");
session_start();
links();

	echo "<form action='change_pic.php' method='POST' enctype='multipart/form-data'/>";
	echo "<br/><h2>Upload your profile picture </h2>";
	echo '<input type="hidden" name="MAX_FILE_SIZE" value="1000000"/>';
	echo '<input type="file" name="userfile" id="userfile"/>';
	echo "<br/><input type='submit' value='submit'/>";

?>