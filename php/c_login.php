<?php
	require_once("conn.php");
	include 'filesLogic.php';
	session_start();
	if(isset($_SESSION["email"]))
	{
		$query = "SELECT * FROM c_register WHERE email='".$_SESSION["email"]."'";
		$result = mysqli_query($conn,$query);
		$rows = mysqli_fetch_array($result);
		if(!$rows["name"])
		{
			header("location:r_login.php");
		}
	}
	else
	{
		header("location:../");
	}
?>