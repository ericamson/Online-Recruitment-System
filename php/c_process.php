<?php
require_once("conn.php");
session_start();

	if(isset($_POST["c_login"]))
	{
		$query="SELECT * FROM c_register WHERE email='".$_POST['email']."' AND pass='".$_POST['pass']."'";
		$result=mysqli_query($conn,$query);
		
		if(mysqli_fetch_assoc($result))
		{
			$_SESSION["email"]=$_POST["email"];
			header("location:c_login_html.php");
		}
		else
		{
			echo "<script type='text/javascript'>alert('Invalid Email or Password\\nTry Again');window.location.href='../';</script>";
		}
	}

?>