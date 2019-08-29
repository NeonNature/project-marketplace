<?php
session_start();
include('connect.php');

if (isset($_GET['id']))
{
	$EmployerID=$_GET['id'];
}
else
{
	$EmployerID="";
}

$query="SELECT * FROM Employers
		WHERE employerID='$EmployerID'";
$ret=mysql_query($query);
$row=mysql_fetch_array($ret);

$Name=$row['e_name'];
$Email=$row['e_email'];
$Phone=$row['e_phoneno'];
$Desc=$row['e_desc'];
$Address=$row['e_address'];
$ProfileImage=$row['e_profileimage'];

if (isset($_POST['btnupdate']))
{
	$u_EmployerID=$_POST['txtemployerid'];
	$u_Name=$_POST['txtname'];
	$u_Email=$_POST['txtemail'];
	$u_Phone=$_POST['txtphoneno'];
	$u_Desc=$_POST['txtdesc'];
	$u_Address=$_POST['txtaddress'];

	$update="UPDATE Employers
			SET e_name='$u_Name',
			e_email='$u_Email',
			e_phoneno='$u_Phone',
			e_desc='$u_Desc',
			e_address='$u_Address'
			WHERE employerID='$u_EmployerID'";
	$ret=mysql_query($update);

	if ($ret)
	{
		echo "<script>window.alert('Profile Updated!')</script>";
		echo "<script>window.location='employer_profile.php?id=$u_EmployerID'</script>";
	}
	else
	{
		echo "<p>Error in Employer Info Update:" .mysql_error(). "</p>";
	}
}


?>
<html>
<head>
	<title> Employer Update </title>
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
	<form action="#" method="POST" enctype="multipart/formdata">
		<table align="center" border='2px' cellpadding='2px'>
			<input type="hidden" name="txtemployerid" value="<?php echo $EmployerID ?>" />
			<tr align="center">
				<td> Name </td>
				<td>
					<textarea name="txtname"><?php echo $Name ?> </textarea>
				</td>
			</tr>
			<tr align="center">
				<td> Email </td>
				<td>
					<textarea name="txtemail"> <?php echo $Email ?> </textarea>
				</td>
			</tr>
			<tr align="center">
				<td> Description </td>
				<td>
					<textarea name="txtdesc"><?php echo $Desc ?> </textarea>
				</td>
			</tr>
			<tr align="center">
				<td> Phone Number </td>
				<td>
					<textarea name="txtphoneno"> <?php echo $Phone ?> </textarea>
				</td>
			</tr>
			<tr align="center">
				<td> Address </td>
				<td>
					<textarea name="txtaddress"> <?php echo $Address ?> </textarea>
				</td>
			</tr>
			<tr align="center">
				<td></td>
				<td>
					<input type="submit" value="Update" name="btnupdate"/>
					<a href="employer_profile.php?id=<?php echo $EmployerID ?>"><input type="button" value="Cancel" /></a>
				</td>
			</tr>
		</table>
	</form>
</body>
</html>


