<?php
$email = $_POST['email'];
$cname = $_POST['cname'];
$dept = $_POST['dept'];
$qual = $_POST['qual'];
$exp = $_POST['exp'];
$loc = $_POST['loc'];
$des = $_POST['des'];

	$host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "project";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT cname FROM jobs WHERE id = ? LIMIT 1";
     $INSERT = "INSERT INTO jobs (postby, cname, dept, qual, exp, loc, des) values(?, ?, ?, ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $cname);
     $stmt->execute();
     $stmt->bind_result($cname);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     
		$stmt->close();
		$stmt = $conn->prepare($INSERT);
		$stmt->bind_param("ssssiss", $email, $cname, $dept, $qual, $exp, $loc, $des);
		$stmt->execute();
		echo "<script>
		alert('Job Successfully Posted');
		window.location.href='r_login.php';
		</script>";
     
     $stmt->close();
     $conn->close();
    }
?>