<?php
include_once('conn.php');

$jobid = $_GET['jobid'];

$DELETE = "DELETE FROM jobs WHERE id= ".$jobid."";
if (mysqli_query($conn, $DELETE)) {
  echo"<script>
		alert('Job Offer Deleted Successfully');
		window.location.href='r_notification.php';
		</script>";
} 
?>