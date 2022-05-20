<?php
require_once("c_login.php");
include_once('conn.php');
?>
<html>
<head>
<link href="../css/font.css" rel="stylesheet">
<link href="../css/search_style.css" rel="stylesheet">
<link href="../css/bootstrap.min.css" rel="stylesheet">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="../js/jquery.min.js"></script>
<title>Search</title>
</head>
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
<div class="flex-wrapper">
<section class="header">
<div class="title" id="top" data-aos="fade-down">




<div class="container">
</div>
</div>
<section class="service">
<div class="title" data-aos="fade-up">




<div class="container">
<h2 class="title"><font size= "30px" color="#222225">
	<?php
		if(isset($_GET['int']))
		{
			echo nl2br("Jobs Available in IT Department :\n");
			$result=$conn->query("SELECT * FROM jobs WHERE dept='Software Developer' OR dept='System Analyst' OR dept='Graphic Designer' OR dept='Game Developer' OR dept='Web Designer'");
		}
		else if(isset($_GET['edu']))
		{
			echo nl2br("Jobs Available in Education Department :\n");
			$result=$conn->query("SELECT * FROM jobs WHERE dept='Counselor' OR dept='Coordinator' OR dept='Teacher' OR dept='Receptionist'");
		}
		else if(isset($_GET['pnh']))
		{
			echo nl2br("Jobs Available in Pharmaceuticals & Healthcare Department :\n");
			$result=$conn->query("SELECT * FROM jobs WHERE dept='Lab Chemist' OR dept='Fitness Instructor' OR dept='Medical Representative' OR dept='Nutrition Officer' OR dept='Health Club Manager'");
		}
		else if(isset($_GET['ana']))
		{
			echo nl2br("Jobs Available in Automobile & Aviation Department :\n");
			$result=$conn->query("SELECT * FROM jobs WHERE dept='Workshop Manager' OR dept='Marketing Executive' OR dept='Quality Controller' OR dept='Cabin Crew'");
		}
		else if(isset($_GET['bni']))
		{
			echo nl2br("Jobs Available in Banking & Insurance Department :\n");
			$result=$conn->query("SELECT * FROM jobs WHERE dept='Branch Manager' OR dept='Insurance Agent' OR dept='Loan Officer' OR dept='Telesales Executive' OR dept='Relationship Managers'");
		}
		else if(isset($_GET['ret']))
		{
			echo nl2br("Jobs Available in Retail Department :\n");
			$result=$conn->query("SELECT * FROM jobs WHERE dept='Sales Officer' OR dept='Store Manager' OR dept='Personal Shopper' OR dept='Sales Executive' OR dept='Territory Manager'");
		}
		else if(isset($_GET['inf']))
		{
			echo nl2br("Jobs Available in Infrastructure Department :\n");
			$result=$conn->query("SELECT * FROM jobs WHERE dept='Project Manager' OR dept='Unit Manager' OR dept='Account Manager' OR dept='HR Manager' OR dept='Commercial Manager'");
		}
		else
		{
			$result=$conn->query("SELECT cname FROM jobs");
			while($rows=$result->fetch_assoc())
			{
				if(isset($_GET[$rows["cname"]]))
				{
					echo "Jobs Posted by ".$rows["cname"];
					$result=$conn->query("SELECT * FROM jobs WHERE cname='$rows[cname]'");
					break;
				}
			}
			if(!isset($_GET[$rows["cname"]]))
			{
				echo "No Job Posted";
			}
			
		}
	?>
</h2></font>
</div>


<div class="row">


<?php
while($rows=mysqli_fetch_assoc($result))
{
echo
'<div class="col-md-6"  data-aos="zoom-in" data-aos-duration="1200">
<div class="service-box">
<div class="service-box-inner">
<div class="service-box-front">
<h6>';






echo '<span style="color: #222225;">Post: </span>';
echo nl2br($rows['dept']."\n");
echo '<span style="color: #222225;">Company: </span>';
echo nl2br($rows['cname']."\n");
echo '<span style="color: #222225;">Location: </span>';
echo nl2br($rows['loc']."\n");
echo '<span style="color: #222225;">Minimum Qualification: </span>';
echo nl2br($rows['qual']."\n");
echo '<span style="color: #222225;">Work Experience: </span>';
echo nl2br($rows['exp']."year(s)\n");
echo 
'</h6>
</div>
<div class="service-box-back">
<h5>Descreption</h5><p>';

echo nl2br($rows['des']."\n");
if(!strlen($rows['des']))
{
	echo htmlspecialchars('<No Description>');
}
echo'
</p>';
echo '<div><form><a href="apply.php?postby=';echo $rows['postby'];echo '&jobid=';echo $rows['id'];
echo '" type="submit"class="login" method="post">Apply</a></form>
</div>
</div>
</div>
</div>
</div>';
}
?>
</div>
</div>
</section>
</section>
<section class="footer text-center">
<a class="navbar-brand" href="#top">^Back To Top^</a>
</section>
</body>
</html>

<script type="text/javascript">AOS.init({duration : 1200,})
</script>


<!--Script for Scroll to Top -->
<script type="text/javascript">
$('a[href^="#"]').on('click', function(event) {

    var target = $(this.getAttribute('href'));

    if( target.length ) {
        event.preventDefault();
        $('html, body').stop().animate({
            scrollTop: target.offset().top
        }, 1500);
    }

});
</script>