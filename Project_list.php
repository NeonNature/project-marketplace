<?php
session_start();
include('connect.php');
?>
<html>
<head><title>Project List</title></head>
<body>
	<form action="Project_list.php" method="POST">
	<?php
		if(isset($_SESSION['Role']))
		{
			$role=$_SESSION['Role'];
			$UserID=$_SESSION['UserID'];
			$Name=$_SESSION['Name'];
			$profile=$_SESSION['ProfileImage'];
				echo "<a href='Student_profile.php?id=$UserID'><img src='$profile' width='50px' height='50px'/></a>";
				echo "<p>Welcome <b>$Name</b> | <a href='user_logout.php'>Logout</a></p>";
		}
		else
		{
			echo "<p>Welcome <b>Guest</b></p>";
		}
	?>
<fieldset>
<legend>Available Project List</legend>
<table align="right">
	<tr>
		<td><input type="text" name="txtdata"/><input type="submit" name="btnsearch" value="Search"/></td>
	</tr>
</table>
<br/><br/><hr/>
<table align="center" cellpadding="10px" cellspacing="10px">
<?php
if(isset($_POST['btnsearch']))
{
	$data=$_POST['txtdata'];
	$query="SELECT * FROM Projects
			WHERE pVetted='True'
			AND pStatus='Pending'
			AND projectTitle LIKE '%$data%'
			OR projectPayment LIKE '%$data%'";
	$ret=mysql_query($query);
	$count=mysql_num_rows($ret);
	if($count==0)
	{
		echo "<p>No results found.</p>";
	}
	else
	{
		echo "<tr>";
			echo "<th>Project ID</th>";
			echo "<th>Project Title</th>";
			echo "<th>Project Payment</th>";
		echo "</tr>";

		for($i=0;$i<$count;$i++)
		{
			$row=mysql_fetch_array($ret);
			$id=$row['projectID'];
			$title=$row['projectTitle'];
			$payment=$row['projectPayment'];

			echo "<tr>";
				echo "<td>$id</td>";
				echo "<td>$title</td>";
				echo "<td>$payment</td>";
				echo "<td><a href='project_details.php?id=$id'>More</a></td>";
			echo "</tr>";
		}
	}
}
else
{
	$query="SELECT * FROM Projects WHERE pVetted='True'
			AND pStatus='Pending'
			ORDER BY projectID DESC";
	$ret=mysql_query($query);
	$count=mysql_num_rows($ret);
		echo "<tr>";
			echo "<th>Project ID</th>";
			echo "<th>Project Title</th>";
			echo "<th>Project Payment</th>";
		echo "</tr>";

		for($i=0;$i<$count;$i++)
		{
			$row=mysql_fetch_array($ret);
			$id=$row['projectID'];
			$title=$row['projectTitle'];
			$payment=$row['projectPayment'];

			echo "<tr>";
				echo "<td>$id</td>";
				echo "<td>$title</td>";
				echo "<td>$payment</td>";
				echo "<td><a href='project_details.php?id=$id'>More</a></td>";
			echo "</tr>";
		}
}
?>
</table>
</fieldset>
</form>
</body>
</html>
