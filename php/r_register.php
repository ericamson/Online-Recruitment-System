<?php
include_once('conn.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['pass'];
$cname = $_POST['compname'];
$gender = $_POST['gender'];
$mobile = $_POST['number'];

	
     $SELECT = "SELECT email FROM r_register WHERE email = ? LIMIT 1";
     $INSERT = "INSERT INTO r_register (name, email, pass, cname, gender, mobile) values(?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssssi", $name, $email, $password, $cname, $gender, $mobile);
      $stmt->execute();
      echo "<script>
		alert('Registration Successful');
		window.location.href='../';
		</script>";
     } 
	 else {
		echo "<script>
		alert('Someone already registered using this email');
		window.location.href='../';
		</script>";
     }
     $stmt->close();
     $conn->close();
   
?>