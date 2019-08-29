<?php
session_start();
include('connect.php');

if(!isset($_SESSION['AdminID']))
{
	echo "<script>window.alert('Please Login to Continue.')</script>";
	echo "<script>window.location='admin_signin.php'</script>";
}
?>

<html>
<head>
	<title>Admin Panel</title>
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
<form>
<fieldset>
<legend>Pending Project</legend>
<?php
$select="SELECT * FROM Project
	WHERE p_status='Pending'
	AND p_vetted=False";
$ret=mysql_query($select);
$count=mysql_num_rows($ret);

if ($count!=0)
{

echo "<table border='2px' cellpadding='2px'>
	<tr>
		<th>ProjectID</th>
		<th>EmployerID</th>
		<th>Title</th>
		<th>StartDate</th>
		<th>EndDate</th>
		<th>Payment</th>
		<th>Description</th>
		<th>NeededSkills</th>
		<th>Status</th>
		<th>Action</th>
	</tr>";

	for($i=0;$i<$count;$i++)
	{
	$row=mysql_fetch_array($ret);
	$ProjectID=$row['projectID'];
	echo "<tr>";
	echo "<td>" . $row['projectID'] . "</td>";
	echo "<td>" . $row['employerID'] . "</td>";
	echo "<td>" . $row['p_title'] . "</td>";
	echo "<td>" . $row['p_startdate'] . "</td>";
	echo "<td>" . $row['p_enddate'] . "</td>";
	echo "<td>" . $row['p_payment'] . "</td>";
	echo "<td>" . $row['p_desc'] . "</td>";
	echo "<td>" . $row['p_skills'] . "</td>";
	echo "<td>" . $row['p_status'] . "</td>";
	echo "<td><a href='project_approve.php?id=$ProjectID'>Accept</a></td>";
	echo "</tr>";
	}
}
else
{
	echo "<p> No Pending Project </p>";
}
?>
</table>
</fieldset>

<fieldset>
<legend>Approved Project</legend>
<?php
$select="SELECT * FROM Project
	WHERE p_status='Pending'
	AND p_vetted=true";
$ret=mysql_query($select);
$count=mysql_num_rows($ret);

if ($count!=0)
{
echo "<table border='2px' cellpadding='2px'>
	<tr>
		<th>ProjectID</th>
		<th>EmployerID</th>
		<th>Title</th>
		<th>StartDate</th>
		<th>EndDate</th>
		<th>Payment</th>
		<th>Description</th>
		<th>NeededSkills</th>
		<th>Status</th>
	</tr>";

	for($i=0;$i<$count;$i++)
	{
	$row=mysql_fetch_array($ret);
	echo "<tr>";
	echo "<td>" . $row['projectID'] . "</td>";
	echo "<td>" . $row['employerID'] . "</td>";
	echo "<td>" . $row['p_title'] . "</td>";
	echo "<td>" . $row['p_startdate'] . "</td>";
	echo "<td>" . $row['p_enddate'] . "</td>";
	echo "<td>" . $row['p_payment'] . "</td>";
	echo "<td>" . $row['p_desc'] . "</td>";
	echo "<td>" . $row['p_skills'] . "</td>";
	echo "<td>" . $row['p_status'] . "</td>";
	echo "</tr>";
	}
}
else
{
	echo "<p> No Approved Projects</p>";
}
?>
</table>
</fieldset>

</form>
</body>
</html>