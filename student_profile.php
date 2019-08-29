<?php
session_start();
include('connect.php');

if(!isset($_SESSION['Role']))
{
	echo "<script> window.alert('Please Login to Continue.')</script>";
	echo "<script> window.location='Home.php'</script>";
}
else
{
	if (isset($_GET['id']))
	{
		$StudentID=$_GET['id'];
	}
	else
	{
		$StudentID="";
	}

	$select="SELECT * FROM Students
		WHERE studentID='$StudentID'";
	$ret=mysql_query($select);
	$count=mysql_num_rows($ret);
	$row=mysql_fetch_array($ret);

	$Name=$row['s_name'];
	$Gender=$row['s_gender'];
	$Studentemail=$row['s_email'];
	$Skills=$row['s_skills'];
	$Address=$row['s_location'];
	$EducationDescription=$row['s_edudesc'];
	$WorkExperienceDescription=$row['s_workexpdesc'];
	$Profile=$row['s_profileimage'];
}
?>
<html>
<head>
	<title>Student Profile</title>
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
<form action="#" method="post">
<table align="center" border='2px' cellpadding="20px">
	<tr align="center"> 
		<td colspan="2">
		<img src="<?php echo $Profile ?>" width="200" height="200"/>
		<?php

		
		if(isset($_SESSION['StudentID']))
		{
			$sid=$_SESSION['StudentID'];
		}
		else
		{
			$sid="";
		}

		if ($sid==$StudentID)
		{
			echo "<br><a href='update_student.php?id=$StudentID'>
			<img src='images/edit.png' width='20' height='20'/>
			 Edit Profile</a>";
		}
		?>
		</td>
	</tr>
	<tr align="center">
		<td>Name</td>
		<td><b><?php echo $Name ?></b></td>
	</tr>
	<tr align="center">
		<td>Gender</td>
		<td><b><?php echo $Gender ?></b></td>
	</tr>
	<tr align="center">
		<td><img src="images/email.png" width="50" height="50"</td>
		<td><b><?php echo $Studentemail ?></b></td>
	</tr>
	<tr align="center">
		<td>Work Experience</td>
		<td><b><?php echo $WorkExperienceDescription ?></b></td>
	</tr>
	<tr align="center">
		<td>Education</td>
		<td><b><?php echo $EducationDescription ?></b></td>
	</tr>
	<tr align="center">
		<td>Skills</td>
		<td><b><?php echo $Skills ?></b></td>
	</tr>
	<tr align="center">
		<td>Address</td>
		<td><b><?php echo $Address ?></b></td>
	</tr>


</table>

<?php
if(isset($sid))
		{
			if (isset($_SESSION['StudentID']))
			{
			$sid=$_SESSION['StudentID'];
			}
		}
		else
		{
			$sid="";
		}
$role=$_SESSION['Role'];

$applist="SELECT a.*, p.projectID, p.p_title, s.studentID, s.s_name
		FROM Project p, Application a, Students s
		WHERE p.projectID=a.projectID
		AND s.studentID=a.studentID
		AND a.studentID='$sid'";

$retlist=mysql_query($applist);
$countlist=mysql_num_rows($retlist);

if($sid==$StudentID && $role=="Student")
{
?>
	<fieldset>
	<legend> Project List </legend>
	<table align="center" border="1">
		<tr>
			<th>No</th>
			<th>Project Title</th>
			<th>Apply Date</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		<?php
		for ($x=0; $x<$countlist;$x++)
		{
			$rowlist=mysql_fetch_array($retlist);
			$pid=$rowlist['projectID'];
			echo "<tr>";
			echo "<td>" . ($x+1) . "</td>";
			echo "<td>" . $rowlist['p_title'] . "</td>";
			echo "<td>" . $rowlist['applieddate'] . "</td>";
			echo "<td>" . $rowlist['acceptedstatus'] . "</td>";
			echo "<td><a href='Project_Details.php?projectID=$pid'>More</a></td>";
			echo "</tr>";;
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