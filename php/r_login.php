<?php
	require_once("conn.php");
	session_start();
	if(isset($_SESSION["email"]))
	{
		$query = "SELECT * FROM r_register WHERE email='".$_SESSION["email"]."'";
		$result = mysqli_query($conn,$query);
		$rows = mysqli_fetch_array($result);
		if(!$rows["name"])
		{
			header("location:c_login.php");
		}
	}
	else
	{
		header("location:../");
	}
?>


<html>
<head>



<link href="../css/font.css" rel="stylesheet">
<link href="../css/r_login_style.css" rel="stylesheet">
<link href="../css/bootstrap.min.css" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1.0">



<title>Welcome</title></head>
<body>


<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-primary">
<small class="navbar-brand">Welcome, <?php echo $rows["name"]; echo ' ('.$rows["cname"].')'?></small>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav ml-auto text-right">
<li class="nav-item">
<a class="nav-link active-home" href="r_login.php">Home</a>
</li>
<li class="nav-item">
<a class="nav-link" id="navbarDropdownMenuLink" href="#" onclick="document.getElementById('id01').style.display='block'">
Post Job
</a>
</li>
<li class="nav-item dropdown">
<a class="nav-link" id="navbarDropdownMenuLink" href="r_notification.php" onclick="r_notification.php">
Applications
</a>
</li>
<li class="nav-item">
<a class="nav-link" href="logout.php?logout">Log-out</a>
</li>
</ul>
</div>  
</nav>





<div id="id01" class="modal">   

  
  
<form id="clogin" class="modal-content animate" action="post.php" method="post">
<div class="head">
	
</div>

    <div class="container">
		<h2 align="center">Post Job</h2>
		<label><b>Posted By: <?php echo $rows["name"]?></b></label><br>
		<input type="text" label="fix" style="display:none;" value="<?php echo $rows["email"]?>" name="email" readonly><br>
		<label><b>Company</b></label>
		<input type="text" label="fix"  style="text-align:center;" value="<?php echo $rows["cname"]?>" name="cname" readonly><br>
		
		
		<label><b>Department & Post</b></label>
		<select name="dept" style="margin-left: 2.8vw !important;" required>
		<option selected hidden value="">Select</option>
		<optgroup label="Information Technology">
		<option value="Software Developer">Software Developer</option>
		<option value="System Analyst">System Analyst</option>
		<option value="Graphic Designer">Graphic Designer</option>
		<option value="Game Developer">Game Developer</option>
		<option value="Web Designer">Web Designer</option>
		</optgroup>
		<optgroup label="Education">
		<option value="Counselor">Counselor</option>
		<option value="Coordinator">Coordinator</option>
		<option value="Teacher">Teacher</option>
		<option value="Receptionist">Receptionist</option>
		</optgroup>
		<optgroup label="Pharmaceuticals & Healthcare">
		<option value="Lab Chemist">Lab Chemist</option>
		<option value="Fitness Instructor">Fitness Instructor</option>
		<option value="Medical Representative">Medical Representative</option>
		<option value="Nutrition Officer">Nutrition Officer</option>
		<option value="Health Club Manager">Health Club Manager</option>
		</optgroup>
		<optgroup label="Automobile & Aviation">
		<option value="Workshop Manager">Workshop Manager</option>
		<option value="Marketing Executive">Marketing Executive</option>
		<option value="Quality Controller">Quality Controller</option>
		<option value="Cabin Crew">Cabin Crew</option>
		</optgroup>
		<optgroup label="Banking and Insurance">
		<option value="Branch Manager">Branch Manager</option>
		<option value="Insurance Agent">Insurance Agent</option>
		<option value="Loan Officer">Loan Officer</option>
		<option value="Telesales Executive">Telesales Executive</option>
		<option value="Relationship Managers">Relationship Managers</option>
		</optgroup>
		<optgroup label="Retail">
		<option value="Sales Officer">Sales Officer</option>
		<option value="Store Manager">Store Manager</option>
		<option value="Personal Shopper">Personal Shopper</option>
		<option value="Sales Executive">Sales Executive</option>
		<option value="Territory Manager">Territory Manager</option>
		</optgroup>
		<optgroup label="Infrastructure">
		<option value="Project Manager">Project Manager</option>
		<option value="Unit Manager">Unit Manager</option>
		<option value="Account Manager">Account Manager</option>
		<option value="HR Manager">HR Manager</option>
		<option value="Commercial Manager">Commercial Manager</option>
		</optgroup>
		</select><br><br>

		<label><b>Minimum Qualification</b></label>
		<select name="qual" required>
		<option selected hidden value="">Select</option>
		<optgroup label="Under Graduation">
		<option value="B.B.A.">B.B.A.</option>
		<option value="B.C.A.">B.C.A.</option>
		<option value="B.Com.">B.Com.</option>
		<option value="B.Sc.">B.Sc.</option>
		<option value="B.A.">B.A.</option>
		</optgroup>
		<optgroup label="Post Graduation">
		<option value="M.B.A.">M.B.A.</option>
		<option value="M.C.A.">M.C.A.</option>
		<option value="M.Com.">M.Com.</option>
		<option value="M.Sc.">M.Sc.</option>
		<option value="M.A.">M.A.</option>
		</optgroup>
		</select><br>

		<label><b><br>Work Experience</b></label>
		<input type="text" label="exp" onkeypress="return isNumberKey(event)" placeholder="0" name="exp" required size="1px" value="0" onclick="this.select();">
        <label><b>yrs</b></label><br>

		<label><b>Location</b></label>
		<input type="text" label="ftext" placeholder="Enter Job Location" onfocus="this.placeholder=''" onblur="this.placeholder='Enter Job Location'" name="loc" required>

		<label><b>Description</b>
		<textarea rows="4" cols="32" placeholder="Job details in 200 characters max. (optional)" onfocus="this.placeholder=''" onblur="this.placeholder='Job Details (optional)'" name="des" maxlength="150"></textarea>
		</label>
		
		
		
		
		
        <div id="container">
			<button type="submit" name="post" value="Submit" class="login">Post</button>
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


