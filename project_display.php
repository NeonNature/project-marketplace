<?php
session_start();
include('connect.php');
?>
<html>
<head>
     <title>Project Display</title>
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
	<form action="Project_Display.php" method="post">
<?php
if(isset($_SESSION['Role']))
{
	$Role=$_SESSION['Role']; 
	if ($Role==="Student")
	{
		$studentID=$_SESSION['StudentID'];
		$Profile=$_SESSION['ProfileImage'];
		echo "<a href='Student_Profile.php?id=$studentID'><img src='$Profile' width='50' height='50'/></a>";
		echo "<b>" . $_SESSION['Name'] . "</b>";
	}
	elseif($Role==="Employer")
	{
		$EmployerID=$_SESSION['EmployerID'];
		$Profile=$_SESSION['ProfileImage'];
		echo "<a href='Employer_Profile.php?id=$EmployerID'><img src='$Profile' width='50' height='50'/></a>"; 
	}
	echo "| <a href='Logout.php'>Logout</a>";
}
else
{
	echo "<p>Welcome <b>Guest</b></p>";
}
?>

<fieldset>
<legend>Available Project List :</legend>
<table align="right">
<tr>
<td>
<input type="text" name="txtdata" placeholder="Search"/>
<input type="submit" name="btnsearch" value="Search"/>
</td>
</tr>
</table>
<br/><br/>
<hr/>
	<table align="center" cellpadding="5">
	<?php
	if(isset($_POST['btnsearch'])) 
	{
		$data=$_POST['txtdata'];
		$query="SELECT * FROM Project
		        WHERE p_status='Pending'
		        AND p_vetted=True
		        AND ( p_title LIKE '%$data%'
		        OR p_desc LIKE '%$data%')" ;
		        $ret=mysql_query($query);
		        $count=mysql_num_rows($ret);

		        if ($count==0)
		        {
		        	echo "No Match Record Found!";
		        }
		        else
		        {
                    echo "<tr>";
                    echo "<td>ProjectID</td>";
                    echo "<td>ProjectTitle</td>";
                    echo "<td>ProjectDescription</td>";
                    echo "<td>Action</td>";
                    echo "</tr>";
                    for ($i=0; $i < $count; $i++)
                    {
                    	$row=mysql_fetch_array($ret);
                    	$ProjectID=$row['projectID'];
                    	echo "<tr>";
                    	echo "<td>" . $row['projectID'] . "</td>";
                    	echo "<td>" . $row['p_title'] . "</td>";
                    	echo "<td>" . $row['p_desc'] . "</td>";
                    	echo "<td><a href='project_details.php?projectID=$ProjectID'>More</a></td>";
                    	echo "</tr>";
                    }
		        }
	} 
	else
	{
		$query="SELECT * FROM Project
		       WHERE p_status='Pending'
		       AND p_vetted=True
		       ORDER BY projectID DESC";
		 $ret=mysql_query($query);
		 $count=mysql_num_rows($ret);

        if ($count==0)
        {
        	echo "No Match Record Found!";
        }
        else
        {
            echo "<tr>";
            echo "<td>ProjectID</td>";
            echo "<td>Project Title</td>";
            echo "<td>ProjectDescription</td>";
            echo "<td>Action</td>";
            echo "</tr>";
            for ($i=0; $i < $count; $i++)
            {
            	$row=mysql_fetch_array($ret);
            	$ProjectCode=$row['projectID'];
            	echo "<tr>";
            	echo "<td>" . $row['projectID'] . "</td>";
            	echo "<td>" . $row['p_title'] . "</td>";
            	echo "<td>" . $row['p_desc'] . "</td>";
            	echo "<td><a href='project_details.php?projectID=$ProjectCode'>More</a></td>";
            	echo "</tr>";
            }
        }
	} 
	?>
</table>
</fieldset>
</form>
</body>
</html>

