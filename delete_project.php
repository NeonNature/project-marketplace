<?php
include('connect.php');

$ProjectID=$_GET['projectID'];

$delete="DELETE FROM Project WHERE projectID='$ProjectID'";

$ret=mysql_query($delete);

if($ret)
{
	echo "<script>window.alert('Project Deleted!')</script>";
    echo "<script>window.location='add_project.php'</script>";
}
else
{
	echo "<script>window.alert('This project has candidates! Cannot be deleted!')</script>";
    echo "<script>window.location='add_project.php'</script>";
}
?>