<?php
include_once('conn.php');

$jobid = $_GET['jobid'];
$email = $_GET['email'];
$inspect = $email.$jobid;

$SELECT = "SELECT inspect FROM hire WHERE inspect = ? LIMIT 1";
$INSERT = "INSERT INTO hire (jobid, email, inspect) values(?, ?, ?)";
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
	$stmt->bind_param("iss", $jobid, $email, $inspect);
	$stmt->execute();
	echo "<script>
		 alert('Job offer sent successfully');
		 window.location.href='r_notification.php';
		 </script>";
} 
else
{
		echo "<script>
		alert('Job offer already sent');
		window.location.href='r_notification.php';
		</script>";
}
$stmt->close();
$conn->close();

?>