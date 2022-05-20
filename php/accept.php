<?php
include_once('conn.php');
include_once('c_notification.php');

$jobid = $_GET['jobid'];
$inspect = $_SESSION['email'].$jobid;
$status = $_GET['status'];

$SELECT = "SELECT inspect FROM accepted WHERE inspect = ? LIMIT 1";
$INSERT = "INSERT INTO accepted (jobid, acceptby, inspect, status) values(?, ?, ?, ?)";
//Prepare statement
$stmt = $conn->prepare($SELECT);
$stmt->bind_param("s", $inspect);
$stmt->execute();
$stmt->bind_result($inspect);
$stmt->store_result();
$rnum = $stmt->num_rows;
if ($rnum==0)
{
	$stmt->close();
	$stmt = $conn->prepare($INSERT);
	$stmt->bind_param("isss", $jobid, $_SESSION['email'], $inspect, $status);
	$stmt->execute();
	if($status=='Accepted')
	{
		echo"<script>
		alert('Job offer Accepted');
		window.location.href='c_login_html.php';
		</script>";
	}
	
	else if($status=='Rejected')
	{
		echo"<script>
		alert('Job offer Rejected');
		window.location.href='c_login_html.php';
		</script>";
	}
} 
else
{
	$query=mysqli_query($conn,"SELECT status FROM accepted WHERE inspect='".$inspect."'");
	$result=mysqli_num_rows($query);
	$row=mysqli_fetch_assoc($query);
	
	echo"<script>
	alert('Job offer already ";
	echo $row["status"];
	echo "');
	window.location.href='c_login_html.php';
	</script>";
}

$stmt->close();
$conn->close();


?>