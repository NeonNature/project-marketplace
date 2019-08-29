<?php
session_start();
include('connect.php');

if(isset($_GET['projectID']))
{
	$ProjectID=$_GET['projectID'];
}
else
{
	$ProjectID="";
}

if(isset($ProjectID))
{
	$select="SELECT p.*,e.employerID,e.e_profileimage
			 FROM Project p,Employers e
			 WHERE p.projectID='$ProjectID'
			 AND e.employerID=p.employerID
			 AND p.p_vetted=True
			 AND p.p_status='Pending'";

	$ret=mysql_query($select);
	$row=mysql_fetch_array($ret);
	$count=mysql_num_rows($ret);

	if ($count==0)
	{
		if ($_SESSION['Role']=="Employer")
		{
			echo "<script> window.location='project_display.php' </script>";
		}
		
		if ($_SESSION['Role']=="Employer")
		{
			echo "<script> window.location='add_project.php' </script>";
		}
	}

	$ProjectTitle=$row['p_title'];
	$ProjectDescription=$row['p_desc'];
	$NeededSkills=$row['p_skills'];
	$Payment=$row['p_payment'];
	$StartDate=$row['p_startdate'];
	$EndDate=$row['p_enddate'];
	$Profile=$row['e_profileimage'];
	list($width,$height)=getimagesize($Profile);
	$w=$width /3;
	$h=$height /3;

	if(isset($_POST['btnapply']))
	{
		$ProjectID=$_POST['txtpid'];
		$StudentID=$_SESSION['StudentID'];

		$insert="INSERT INTO Application
				(projectID,studentID,acceptedstatus)
				VALUES 
				('$ProjectID','$StudentID','Pending')";
		$ret=mysql_query($insert);

		if($ret)
		{
			echo"<script>window.alert('Project Applying Succeeded!')</script>";
			echo"<script>window.location='project_display.php'</script>";
		}
		else
		{
			echo"<p>Error in Project Applying." . mysql_error(). "</p>";
		}
	}
}
else
{
	echo "<script>window.alert('Project Not Found')</script>";
	echo "<script>window.location='project_display.php'</script>";	
}
?>
<html>
<head>
	<title>Project Detail</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div align="center">
			<img src='images/logo.jpg'/>
	</div>	
	<ul>
  		<li><a class="active" href="home.php">Home</a></li>
  		<li><a href="signin.php">Sign In</a></li>
  		<li><a href="student_signup.php">Student Sign Up</a></li>
  		<li><a href="employer_signup.php">Employer Sign Up</a></li>
  		<li><a href="logout.php">Logout</a></li>

	</ul>
	<form action="project_details.php" method="post">
	<input type="hidden" name="txtpid" value="<?php echo $ProjectID; ?>"/>
	<form>
		<table cellspacing="7" align="center">
			<tr>
				<td>
					<img src="<?php echo $Profile ?>" width="<?php echo $w ?>" height="<?php echo $h ?>"/>
				</td>
				<td>
					<b><h2><?php echo $ProjectTitle ?></h2></B>
				</td>
			</tr>
			<table border="2" align="center">
			<tr>
				<td>
					Project Description <br/>					
				</td>
				<td>
					Needed skills <br/>					
				</td>
				<td>
					Payment <br/>					
				</td>
				<td>
					Start Date <br/>					
				</td>
				<td>
					End Date <br/>					
				</td>
			</tr>
			<tr>
				<td> <b><?php echo $ProjectDescription; ?></b> </td>
				<td> <b><?php echo $NeededSkills; ?></b> </td>
				<td> <b><?php echo $Payment; ?></b> </td>
				<td> <b><?php echo $StartDate; ?></b> </td>
				<td> <b><?php echo $EndDate; ?></b> </td>

			</table>
			<table align="center">
			<tr>
				<td colspan="2">
					<?php
					if(isset($_SESSION['StudentID']))
					{
						$StudentID=$_SESSION['StudentID'];
					}
					else
					{
						$StudentID="";
					}
					$checkstatus="SELECT * FROM Application
								  WHERE projectID='$ProjectID'
								  AND studentID='$StudentID'";
					$ret=mysql_query($checkstatus);
					$count=mysql_num_rows($ret);

					if($count!=0 || $_SESSION['Role']=='Employer')
					{
						echo "<input type='submit' name='btnapply' value='Apply Now' disabled/>";
					}
					else
					{
						echo "<input type='submit' name='btnapply' value='Apply Now'/>";
					}

					?>
				</td>
			</tr>
			</table>
		</table>
		<?php

		if(isset($_SESSION['EmployerID']))
		{
			$eid=$_SESSION['EmployerID'];
		}
		else
		{
			$eid="";
		}
		if(isset($_SESSION['Role']))
		{
			$role=$_SESSION['Role'];
		}
		else
		{
			$role="";
		}

		if($role=='Employer')
		{
			$applist="SELECT app.*,p.projectID,p.employerID,
					  e.employerID,s.studentID,s.s_name
					  FROM Project p,Application app, Students s,Employers e
					  WHERE p.projectID=app.projectID
					  AND s.studentID=app.studentID
					  AND e.employerID=p.employerID
					  AND p.employerID='$eid'
					  AND p.projectID='$ProjectID'";
			$retlist=mysql_query($applist);
			$countlist=mysql_num_rows($retlist);		
		?>
		<fieldset>
		<legend>Candidate List for This Project</legend>
		<table align="center" border=1>
			<tr>
				<th>No.</th>
				<th>Student Name</th>
				<th>Applied Date</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
			<?php
			for($x=0;$x<$countlist;$x++)
			{
				$rowlist=mysql_fetch_array($retlist);
				$sid=$rowlist['studentID'];
				$pid=$rowlist['projectID'];
				echo "<tr>";
				echo "<td>" . ($x+1) . "</td>";
				echo "<td>" . $rowlist['s_name'] . "</td>";
				echo "<td>" . $rowlist['applieddate'] . "</td>";
				echo "<td>" . $rowlist['acceptedstatus'] . "</td>";
				echo "<td>
					<a href='student_profile.php?id=$sid'>Profile</a>  |
					<a href='project_accept.php?sid=$sid&pid=$pid'>Accept</a>
					</td>";
				echo "</tr>";
			}
			?>
		</table>
		</fieldset>
		<?php
		}
		else
		{
			echo "-";
		}
		?>
</form>
</body>
</html>