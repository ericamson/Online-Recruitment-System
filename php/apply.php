<?php

include_once('conn.php');
include_once('search.php');

$appby = $_SESSION['email'];
$jobid = $_GET['jobid'];
$postby = $_GET['postby'];
$inspect = $_SESSION['email'].$_GET['jobid'];

$SELECT = "SELECT inspect FROM application WHERE inspect = ? LIMIT 1";
$INSERT = "INSERT INTO application (appby, jobid, postby, inspect) values(?, ?, ?, ?)";
//Prepare statement
$stmt = $conn->prepare($SELECT);
$stmt->bind_param("s", $inspect);
$stmt->execute();
$stmt->bind_result($appby);
$stmt->store_result();
$rnum = $stmt->num_rows;
if ($rnum==0)
	{
		$stmt->close();
		$stmt = $conn->prepare($INSERT);
		$stmt->bind_param("siss", $appby, $jobid, $postby, $inspect);
		$stmt->execute();
		echo "<script>
		alert('Applied for the job successful');
		window.location.href='c_login_html.php';
		</script>";
    }
	else
	{
		echo "<script>
		alert('You have already applied for this job');
		window.location.href='c_login_html.php';
		</script>";
    }
$stmt->close();
$conn->close();
	
?>