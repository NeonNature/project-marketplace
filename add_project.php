<?php
session_start();
include('connect.php');

if(isset($_SESSION['EmployerID']))
		{
			$EmployerID=$_SESSION['EmployerID'];
		}
		else
		{
			$EmployerID="";
		}


if(isset($_GET['Mode']))
{
	$ProjectID=$_GET['projectID'];
	$select="SELECT * FROM Project WHERE projectID='$ProjectID'";
	$ret=mysql_query($select);
	$row=mysql_fetch_array($ret);
	$ProjectTitle=$row['p_title'];
	$ProjectDescription=$row['p_desc'];
	$Payment=$row["p_payment"];
	$StartDate=$row["p_startdate"];
	$EndDate=$row["p_enddate"];
	$Vetted=$row["p_vetted"];
	$Status=$row["p_status"];
	$ProjectSkills=$row["p_skills"];
}

if(isset($_POST['btnSave']))
{
	$ProjectTitle=$_POST['txtptitle'];
	$ProjectDescription=$_POST['txtpdesc'];
	$ProjectSkills=$_POST['txtpskills'];
	$Payment=$_POST['txtppayment'];
	$StartDate=date("Y-m-d",strtotime($_POST['txtpstartdate']));
	$EndDate=date("Y-m-d",strtotime($_POST['txtpenddate']));
	$EmployerID=$_SESSION['EmployerID'];

	$Status="Pending";
	$Vetted="False";
	
	$AdminID="1";

	$checkProject="SELECT * FROM Project
				WHERE p_title='$ProjectTitle'";
	$ret=mysql_query($checkProject);
	$count=mysql_num_rows($ret);

	if($count!==0)
	{
		echo"<script>window.alert('ProjectTitle $ProjectTitle Already Exist.')</script>";
		echo "<script>window_location='add_project.php'</script>";
	}
	else
	{
		$insert="INSERT INTO Project
				(p_title,p_desc,p_payment,p_startdate,p_enddate,p_vetted,p_status, employerID, adminID, p_skills)
				VALUES
				('$ProjectTitle','$ProjectDescription','$Payment','$StartDate','$EndDate','$Vetted','$Status', '$EmployerID', '$AdminID', '$ProjectSkills')";
				$ret=mysql_query($insert);
	
		if($ret)
	{
		echo"<script>window.alert('Project Successfully Added.')</script>";
		echo "<script>window_location='add_project.php'</script>";
	}
	else
	{
		echo "<p>Error in Project Insert: " . mysql_error() . "</P>";
	}
}
}

if(isset($_POST['btnupdate']))
{
	$u_ProjectID=$_POST['txtprojectid'];  
	$u_ProjectTitle=$_POST['txtptitle'];
	$u_ProjectDescription=$_POST['txtpdesc'];
	$u_Payment=$_POST['txtppayment'];
	$u_StartDate=date("Y-m-d",strtotime($_POST['txtpstartdate']));
	$u_EndDate=date("Y-m-d",strtotime($_POST['txtpenddate']));
	$u_Status=$_POST['rdostatus'];
	$u_ProjectSkills=$_POST['txtpskills'];

	$update="UPDATE Project
			SET p_title='$u_ProjectTitle',
			p_desc='$u_ProjectDescription',
			p_payment='$u_Payment',
			p_startdate='$u_StartDate',
			p_enddate='$u_EndDate',
			p_status='$u_Status',
			p_skills='$u_ProjectSkills'
			WHERE projectID='$u_ProjectID'";
	$ret=mysql_query($update);
	if($ret)
	{
		echo "<script>window.alert('Project Successfully Updated!')</script>";
		echo "<script>window.location='add_project.php'</script>";
	}
	else
	{
		echo "<p>Error in Project Update:" . mysql_error() . "</P>";
	}
}
?>
<html>
<head>
<title>Add Project</title>
<link rel="stylesheet" type="text/css" href="style.css">
<link type="text/css" href="DatePicker/datepicker.css" rel="stylesheet"/>
<script type="text/javascript" src="DatePicker/datepicker.js"></script>
<script type="text/javascript" src="DatePicker/jquery.js"></script>
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
	<form action="add_project.php" method="POST">
		<?php
if(isset($_SESSION['Role']))
{
	$Role=$_SESSION['Role']; 
	if ($Role==="Employer")
	{
		$employerID=$_SESSION['EmployerID'];
		$Profile=$_SESSION['ProfileImage'];
		echo "<a href='Employer_Profile.php?id=$employerID'><img src='$Profile' width='50' height='50'/></a>";
		echo "<b>" . $_SESSION['Name'] . "</b>";
	}
	elseif($Role==="Student")
	{
		echo "<script> window.alert('You do not have permission to view this page')</script>";
		echo "<script> window.location('project_display.php') </script>";
	}
	echo "| <a href='Logout.php'>Logout</a>";
}
else
{
	echo "<p>Welcome <b>Guest</b></p>";
}
?>
		<input type="hidden" name="txtprojectid" value="<?php echo $ProjectID ?>"/>
	<table align="center" cellspacing="3">
		<tr>
			<td>Project Title</td>
			<td><input type="text" value="<?php if(isset($ProjectTitle)) {echo $ProjectTitle;}else{$ProjectTitle="";}?>" 
				name="txtptitle" placeholder="Enter Project Name"/></td>
		</tr>
		<tr>
			<td>Project Description</td>
			<td><input type="text" value="<?php if(isset($ProjectDescription)) {echo $ProjectDescription;}else{$ProjectDescription="";}?>" 
				name="txtpdesc" placeholder="Enter Project Name"/></td>
		<tr>
			<td>Payment</td>
			<td><input type="text" value="<?php if(isset($Payment)) {echo $Payment;}else{$Payment="";}?>"  name="txtppayment" placeholder="Enter Payment"/></td>
		</tr>
		<tr>
			<td>Start Date</td>
 <td>
   <input name="txtpstartdate" type="text" size="20" id="StartDate"
                      maxlength="50" value="<?php echo date("d-M-Y")?>" onFocus="showCalender(calender,this)" readonly="true"/> 
	 
    </td>
</tr>
<tr>
	<td>End Date</td>
 <td>
   <input name="txtpenddate" type="text" size="20" id="EndDate"
                      maxlength="50" value="<?php echo date("d-M-Y")?>" onFocus="showCalender(calender,this)" readonly="true"/> 
	 
    </td>
</tr>
		
		<tr>
			<td>Status</td>
		<td><input type="radio" name="rdostatus"  value="Pending" checked />Pending
			<input type="radio" name="rdostatus"  value="Finished" />Finished
		</td>
		</tr>
		<tr>
			<td>Needed Skills</td>
			<td><input type="text" value="<?php if(isset($ProjectSkills)) {echo $ProjectSkills;}else{$ProjectSkills="";}?>" 
				name="txtpskills" placeholder="Enter Skills Needed for the Project"/></td>
		</tr>
		<tr align="center">
			<td></td>
			<td>
				<?php
				if(isset($_GET['Mode']))
				{
					echo "<input type='submit' name='btnupdate' value='Update'/>";
				}  
				else
				{
					echo "<input type='submit' name='btnSave' value='Save'/>";
				}
				?>
			
			   <input type="reset"  name="btnClear" value="Clear"  />
			</td>
		</tr>
	</table>
	<fieldset>
	<legend>Project Listing:</legend>
	<table align ="center" cellpadding="5" cellspacing="5" border="2px"/>
		<tr>
			<th>ProjectID</th>
			<th>Project Title</th>
			<th>Project Description</th>
			<th>Payment</th>
			<th>StartDate</th>
			<th>EndDate</th>
			<th>Vetted</th>
			<th>Status</th>
			<th>EmployerID</th>
			<th>Needed Skills</th>
			<th>Action</th>
		</tr>
		<?php
			$selectb="SELECT * FROM Project
					WHERE employerID='$EmployerID'
					ORDER BY projectID DESC";
			$ret=mysql_query($selectb);
			$bcount=mysql_num_rows($ret);

			for($i=0; $i<$bcount; $i++)
			{
				$row=mysql_fetch_array($ret);
				$ProjectID=$row['projectID'];

				echo "<tr align='center'>";
				echo "<td>$ProjectID</td>";
				echo "<td><a href='project_details.php?projectID=$ProjectID'>" . $row['p_title'] . "</a></td>";
				echo "<td>" . $row['p_desc'] . "</td>";
				echo "<td>" . $row['p_payment'] . "</td>";
				echo "<td>" . $row['p_startdate'] . "</td>";
				echo "<td>" . $row['p_enddate'] . "</td>";
				echo "<td>" . $row['p_vetted'] . "</td>";
				echo "<td>" . $row['p_status'] . "</td>";
				echo "<td>" . $row['employerID'] . "</td>";
				echo "<td>" . $row['p_skills'] . "</td>";

				echo "<td><a href='add_project.php?projectID=$ProjectID&Mode=Update'>Edit</a> | <a href='delete_project.php?projectID=$ProjectID'>Delete</a></td>";
				echo "</tr>";
			}
		?>
	</table>
	</fieldset>
</body>
</html>