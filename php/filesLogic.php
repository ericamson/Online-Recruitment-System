<?php

require_once("conn.php");


// Uploads files
if (isset($_POST['save']))
{ // if save button on the form is clicked
    // name of the uploaded file
    $filename = $_GET['name'].'.'. pathinfo($_FILES['myfile']['name'],PATHINFO_EXTENSION);

    // destination of the file on the server
    $destination = '../resume/' . $filename;

    // get the file extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];

    if (!in_array($extension, ['pdf'])) {
		
		echo "<script>
		alert('You file extension must be .pdf');
		window.location.href='c_login.php';
		</script>";
    } elseif ($_FILES['myfile']['size'] > 2000000) { // file shouldn't be larger than 2Megabyte
        
		echo "<script>
		alert('File should not exceed 2MB');
		window.location.href='c_login.php';
		</script>";
    } else {
        // move the uploaded (temporary) file to the specified destination
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO resume (name, size) VALUES ('$filename', $size)";
            if (mysqli_query($conn, $sql)) {
                
				echo "<script>
				alert('File uploaded successfully');
				window.location.href='c_login.php';
				</script>";
            }
        } else {
			echo "<script>
				alert('Failed to upload file.');
				window.location.href='c_login.php';
				</script>";
        }
    }
}
?>