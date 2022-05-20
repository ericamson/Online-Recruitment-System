<?php
include_once('conn.php');
include_once('r_login.php');


$query=mysqli_query($conn,"SELECT * FROM application WHERE postby='".$_SESSION['email']."'");
$result=mysqli_num_rows($query);
$temp=mysqli_fetch_assoc($query);
$query=mysqli_query($conn,"SELECT * FROM application WHERE postby='".$_SESSION['email']."'");
$result=mysqli_num_rows($query);
$querys=mysqli_query($conn,"SELECT * FROM c_register WHERE email='".$temp['appby']."'");
$results=mysqli_num_rows($querys);
$rows=mysqli_fetch_assoc($querys);
$queryz=mysqli_query($conn,"SELECT * FROM jobs WHERE id='".$temp['jobid']."'");
$resultz=mysqli_num_rows($queryz);
$rowz=mysqli_fetch_assoc($queryz);



$queryzz=mysqli_query($conn,"SELECT * FROM resume WHERE name='".$temp['appby'].".pdf'");
$resultzz=mysqli_num_rows($queryzz);
$rowzz=mysqli_fetch_assoc($queryzz);





if(!$result)
{
echo '<h2 align="center" style="margin-top: 25px;margin-bottom: 25px;color: #9c0909;">No New Application</h2>';
}
else
{
?>
<div>
<h2 align="center" style="margin-top: 25px;margin-bottom: 25px;color: #9c0909;" >Applications</h2>
<table align="center" style="border: 5px solid black;width: 90%;" class="table table-bordered">
	<Tr style="border: 5px solid black;">
		<th style='border: 5px solid black;color: #f44336;text-align:center;'>Sr.No</th>
		<th style='border: 5px solid black;color: #f44336;text-align:center;'>Candidate</th>
		<th style='border: 5px solid black;color: #f44336;text-align:center;'>Applied for</th>
		<th style='border: 5px solid black;color: #f44336;text-align:center;'>Resume</th>
		<th style='border: 5px solid black;color: #f44336;text-align:center;'>Status</th>
	</Tr>
<?php


	$i=1;
	
	while($row=mysqli_fetch_assoc($query))
	{

		echo '<Tr>';
		echo "<td style='border: 5px solid black;text-align:center;'>".$i."</td>";
		echo "<td style='border: 5px solid black;'><b>Name: </b>".$rows['name']."<br><b>Highest Qualification: </b>".$rows['hq']."<br><b>Work Exp.: </b>".$rows['wexp']."yr(s).<br><b>E-mail Id: </b>".$rows['email']."<br><b>Mobile No.: </b>".$rows['mobile']."</td>";
		echo "<td style='border: 5px solid black;'><b>Post: </b>".$rowz['dept']."<br><b>Location: </b>".$rowz['loc']."<br><b>Min. Qualification Req.: </b>".$rowz['qual']."<br><b>Work Exp. Req.: </b>".$rowz['exp']."</td>";
		echo "<td style='border: 5px solid black;text-align:center;'><a href=";
		echo '"r_download.php?file_id=';
		echo $rowzz['name'];
		echo '"target="_blank">View Resume</a></td>';
		
		
		$queryzzz=mysqli_query($conn,"SELECT * FROM accepted WHERE inspect='".$rows['email'].$row['jobid']."'");
		$resultzzz=mysqli_num_rows($queryzzz);
		$rowzzz=mysqli_fetch_assoc($queryzzz);
		if(!$resultzzz)
		{
			$queryzzzz=mysqli_query($conn,"SELECT * FROM hire WHERE inspect='".$rows['email'].$row['jobid']."'");
			$resultzzzz=mysqli_num_rows($queryzzzz);
			$rowzzzz=mysqli_fetch_assoc($queryzzzz);
			if(!$resultzzzz)
			{
				echo "<td style='border: 5px solid black;text-align:center;'><a href=";
				echo '"hire.php?jobid=';
				echo $rowz['id'];
				echo "&email=";
				echo $rows['email'];
				echo '">Hire</a><br><br>';
			
				echo "<a href=";
				echo '"hire.php?jobid=';
				echo $rowz['id'];
				echo "&email=";
				echo $rows['email'];
				echo '">Reject</a></td>';		
				echo "</Tr>";
			}
			else
			{
				echo "<td style='border: 5px solid black;text-align:center;'><b>Pending</b></td></Tr>";
			}
		}
		
		
		
		
		else
		{
			$queryzzzzz=mysqli_query($conn,"SELECT * FROM jobs WHERE id='".$row['jobid']."'");
			$resultzzzzz=mysqli_num_rows($queryzzzzz);
			if(!$resultzzzzz)
			{
				echo "<td style='border: 5px solid black;text-align:center;'><b>";
				echo $rowzzz['status'];
				echo "<br><br>";
				echo 'Job Offer Deleted</b>';
				echo "</td></Tr>";
			}
			else
			{
				echo "<td style='border: 5px solid black;text-align:center;'><b>";
				echo $rowzzz['status'];
			
				echo "</b><br><br><a href=";
				echo '"delete.php?jobid='.$row['jobid'].'">Delete Job Offer</a>';
			
			
			
				echo "</td></Tr>";
			}
			
			
		}
		$i++;
	}
?>

</table>
</div>
<?php }?>
