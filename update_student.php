<?php
session_start();
include('connect.php');

if (isset($_GET['id']))
{
	$StudentID=$_GET['id'];
}
else
{
	$StudentID="";
}

$query="SELECT * FROM Students
		WHERE studentID='$StudentID'";
$ret=mysql_query($query);
$row=mysql_fetch_array($ret);

$Name=$row['s_name'];
$Email=$row['s_email'];
$Skills=$row['s_skills'];
$EduDesc=$row['s_edudesc'];
$WorkExpDesc=$row['s_workexpdesc'];
$Location=$row['s_location'];

if (isset($_POST['btnupdate']))
{
	$u_StudentID=$_POST['txtstudentid'];
	$u_Name=$_POST['txtname'];
	$u_Email=$_POST['txtemail'];
	$u_Skills=$_POST['txtskills'];
	$u_EduDesc=$_POST['txtedudesc'];
	$u_WorkExpDesc=$_POST['txtworkexpdesc'];
	$u_Location=$_POST['txtlocation'];

	$update="UPDATE Students
			SET s_name='$u_Name',
			s_email='$u_Email',
			s_skills='$u_Skills',
			s_edudesc='$u_EduDesc',
			s_workexpdesc='$u_WorkExpDesc',
			s_location='$u_Location'
			WHERE studentID='$u_StudentID'";
	$ret=mysql_query($update);

	if ($ret)
	{
		echo "<script>window.alert('Profile Updated!')</script>";
		echo "<script>window.location='student_profile.php?id=$u_StudentID'</script>";
	}
	else
	{
		echo "<p>Error in Student Info Update:" .mysql_error(). "</p>";
	}
}

?>
<html>
<head>
	<title> Student Update </title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
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
	<form action="#" method="POST" >
		<table align="center" border='2px' cellpadding='2px'>
			<input type="hidden" name="txtstudentid" value="<?php echo $StudentID ?>" />
			<tr align="center">
				<td> Name </td>
				<td>
					<textarea name="txtname"><?php echo $Name ?> </textarea>
				</td>
			</tr>
			<tr align="center">
				<td> Email </td>
				<td>
					<textarea name="txtemail"><?php echo $Email ?> </textarea>
				</td>
			</tr>
			<tr align="center">
				<td> Skills </td>
				<td>
					<textarea name="txtskills"><?php echo $Skills ?></textarea>
				</td>
			</tr>
			<tr align="center">
				<td> Educational Description </td>
				<td>
					<textarea name="txtedudesc"><?php echo $EduDesc ?> </textarea>
				</td>
			</tr>
			<tr align="center">
				<td> Work Experience Description </td>
				<td>
					<textarea name="txtworkexpdesc"><?php echo $WorkExpDesc ?> </textarea>
				</td>
			</tr>
			<tr align="center">
				<td> Location </td>
				<td>
					<textarea name="txtlocation"><?php echo $Location ?></textarea>
				</td>
			</tr>
			<tr align="center">
				<td></td>
				<td>
					<input type="submit" value="Update" name="btnupdate"/>
					<a href="student_profile.php?id=<?php echo $StudentID ?>"><input type="button" value="Cancel" /></a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>


