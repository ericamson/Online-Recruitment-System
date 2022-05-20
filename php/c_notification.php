<?php
include_once('conn.php');
include_once('c_login.php');

$i=1;
$query=mysqli_query($conn,"SELECT * FROM application WHERE appby='".$_SESSION['email']."'");
$result=mysqli_num_rows($query);

if(!$result)
{
echo '<h2 align="center" style="margin-top: 25px;margin-bottom: 25px;color: #9c0909;">Apply for jobs to see job notification here.</h2>';
}
else
{
?>
<div>
<h2 align="center" style="margin-top: 25px;margin-bottom: 25px;color: #9c0909;" >Applied For</h2>
<table align="center" style="border: 5px solid black;width: 90%;" class="table table-bordered">
	<Tr style="border: 5px solid black;">
		<th style='border: 5px solid black;color: #f44336;text-align:center;'>Sr.No</th>		
		<th style='border: 5px solid black;color: #f44336;text-align:center;'>Jobs</th>
		<th style='border: 5px solid black;color: #f44336;text-align:center;'>Status</th>
	</Tr>
<?php


	
	while($row=mysqli_fetch_assoc($query))
	{
		$queryz=mysqli_query($conn,"SELECT * FROM jobs WHERE id='".$row['jobid']."'");
		$resultz=mysqli_num_rows($queryz);
		$rowz=mysqli_fetch_assoc($queryz);			

		echo '<Tr>';
		echo "<td style='border: 5px solid black;text-align:center;'>".$i."</td>";
		
		echo "<td style='border: 5px solid black;'><b>Company: </b>".$rowz['cname']."<br><b>Post: </b>".$rowz['dept']."<br><b>Location: </b>".$rowz['loc']."<br><b>Min. Qualification Req.: </b>".$rowz['qual']."<br><b>Work Exp. Req.: </b>".$rowz['exp']."</td>";
		
		
		$querys=mysqli_query($conn,"SELECT inspect FROM hire WHERE inspect='".$_SESSION['email'].$row['jobid']."'");
		$results=mysqli_num_rows($querys);
		if(!$results)
		{
			echo "<td style='border: 5px solid black;text-align:center;'>Pending</td></Tr>";
		}
		else
		{
			$queryss=mysqli_query($conn,"SELECT * FROM accepted WHERE inspect='".$_SESSION['email'].$row['jobid']."'");
			$resultss=mysqli_num_rows($queryss);
			if(!$resultss)
			{
				echo "<td style='border: 5px solid black;text-align:center;'><a href=";
				echo '"accept.php?jobid=';			
				echo $row['jobid'];
				echo "&status=Accepted";
				echo '">Accept Job</a><br><br>';
				echo "<a href=";
				echo '"accept.php?jobid=';			
				echo $row['jobid'];
				echo "&status=Rejected";
				echo '">Reject Job</a><br><br></td>';
				echo "</Tr>";
			}
			else
			{
				$rowss=mysqli_fetch_assoc($queryss);
				echo "<td style='border: 5px solid black;text-align:center;'><b>";
				echo $rowss['status'];
				echo "</b></td>";
				echo "</Tr>";
			
			
			
			
			}
			
		}
		
		
		
		
		$i++;

	}
?>

</table>
</div>
<?php }?>
