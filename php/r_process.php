<?php
require_once("conn.php");
session_start();

	if(isset($_POST["r_login"]))
	{
		$query="SELECT * FROM r_register WHERE email='".$_POST['email']."' AND pass='".$_POST['pass']."'";
		$result=mysqli_query($conn,$query);
		
		if(mysqli_fetch_assoc($result))
		{
			$_SESSION["email"]=$_POST["email"];
			header("location:r_login.php");
		}
		else
		{
			echo "<script type='text/javascript'>alert('Invalid Email or Password\\nTry Again');window.location.href='../';</script>";
		}
	}

?>