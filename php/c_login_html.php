<?php
require_once("c_login.php");

?>

<html>
<head>



<link href="../css/font.css" rel="stylesheet">
<link href="../css/style.css" rel="stylesheet">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Welcome</title></head>
<body>


<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-primary">
<small class="navbar-brand">Welcome, <?php echo $rows["name"]?></small>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
<span class="navbar-toggler-icon"></span>
</button>


<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ml-auto text-right">
<li class="nav-item">
<a class="nav-link active-home" href="c_login_html.php">Home</a>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Department
</a>





<div class="dropdown-menu text-left ml-auto" aria-labelledby="navbarDropdownMenuLink">
<a class="dropdown-item" href="search.php?int">Information<br>Technology</a>
<a class="dropdown-item" href="search.php?edu">Education</a>
<a class="dropdown-item" href="search.php?pnh">Pharmaceuticals<br>& Healthcare</a>
<a class="dropdown-item" href="search.php?ana">Automobile &<br>Aviation</a>
<a class="dropdown-item" href="search.php?bni">Banking &<br>Insurance</a>
<a class="dropdown-item" href="search.php?ret">Retail</a>
<a class="dropdown-item" href="search.php?inf">Infrastructure</a>
</div>

</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Company
</a>

<div class="dropdown-menu text-left ml-auto" aria-labelledby="navbarDropdownMenuLink">
<?php $result=$conn->query("SELECT cname FROM r_register ORDER BY cname");
			$rowsp="";
			while($rows=$result->fetch_assoc())
			{
				if($rowsp!=$rows["cname"])
			{
				echo '<a class="dropdown-item" href="search.php?';
				echo $rows['cname'];
				echo '">';
				echo $rows["cname"];
				$rowsp=$rows["cname"];
				echo "</a>";
			}
			}
?>
</div>

</li>
<li class="nav-item">
<a class="nav-link" href="logout.php">Log-out</a>
</li>
</ul>
</div>  
</nav>

<div id="container">
		<button onclick="document.getElementById('id01').style.display='block'" type="submit" name="upload" value="Submit" class="login">Upload Resume</button>
		
</div>


<div id="id01" class="modal">   

  
  
<form id="clogin" enctype="multipart/form-data" class="modal-content animate" action="filesLogic.php?name=<?php echo $_SESSION["email"]; ?>" method="post">
<div class="head">
	
</div>

    <div class="container">
		<h2 align="center">Upload Resume</h2><br>
		<?php
		
			$queryzz=mysqli_query($conn,"SELECT * FROM resume WHERE name='".$rows['email'].".pdf'");
			$resultzz=mysqli_num_rows($queryzz);
			$rowzz=mysqli_fetch_assoc($queryzz);
			$result=$conn->query("SELECT name FROM resume");
			while($rows=$result->fetch_assoc())
			{
				if($rows['name']==$_SESSION["email"].'.pdf')
			{
				echo nl2br('Your resume has already been uploaded.<br>Uploading new file will overwrite the previous one.<br><br>');
				echo "<a href=";
				echo '"c_download.php?file_id=';
				echo $_SESSION["email"].".pdf";
				echo '"target="_blank">View Resume</a><br><br>';
			}
			}
		
		
		
		
		?>
		<input type="file" name="myfile"><br><br>

		
        <div id="container">
			<button type="submit" name="save" value="Submit" class="login">Upload</button>
			<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
		</div>
	</div>
	</form>
  
</div>

</body>
</html>

<script>
var modal0 = document.getElementById('id01');
var modal1 = document.getElementById('id02');
var modal2 = document.getElementById('id03');
var modal3 = document.getElementById('id04');
window.onclick = function(event) {
    if (event.target == modal0) {
        modal0.style.display = "none";
    }
	if (event.target == modal1) {
        modal1.style.display = "none";
    }
	if (event.target == modal2) {
        modal2.style.display = "none";
    }
	if (event.target == modal3) {
        modal3.style.display = "none";
    }
}
</script>

<?php
require_once('c_notification.php');
?>
