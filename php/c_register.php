<?php
include_once('conn.php');

$name = $_POST['name'];
$email = $_POST['e-mail'];
$password = $_POST['password'];
$mob = $_POST['mm'];
$dob = $_POST['dd'];
$yob = $_POST['yyyy'];
$gender = $_POST['gender'];
$mobile = $_POST['number'];
$hq = $_POST['qual'];
$wexp = $_POST['exp'];

	$SELECT = "SELECT email FROM c_register WHERE email = ? LIMIT 1";
    $INSERT = "INSERT INTO c_register (name, email, pass, dob, mob, yob, gender, mobile, hq, wexp) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
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
      $stmt->bind_param("sssiiisisi", $name, $email, $password, $dob, $mob, $yob, $gender, $mobile, $hq, $wexp);
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