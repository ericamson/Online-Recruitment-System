<?php
include_once('conn.php');
if (isset($_GET['file_id']))
{
    $filepath = '../resume/' . $_GET['file_id'];
    if (file_exists($filepath))
	{		
		header("Content-type: application/pdf"); 		
		header('Content-Disposition: inline; filename=' . basename($filepath));		
		$filepath = readfile($filepath);		
		exit;
    }
	else
	{
		echo "<script>
		alert('File not found');
		window.location.href='r_notification.php';
		</script>";
	}
}
?>