<?php

	$conn=mysqli_connect("localhost", "root", "", "project");

	if(!$conn)
	{
		die("Please Check Your Connection".mysqli_error($conn));
	}

?>