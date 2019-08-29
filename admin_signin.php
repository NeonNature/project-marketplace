<?php
session_start();
include('connect.php');

if(isset($_POST['btnsignin']))
{
  $username=$_POST['txtusername'];
  $password=$_POST['txtpassword'];

  $username=mysql_real_escape_string($username);
  $password=mysql_real_escape_string($password);

  $check="SELECT * FROM Admin
      WHERE a_username='$username'
      AND a_password='$password'";

  $ret=mysql_query($check);
  $count=mysql_num_rows($ret);
  $row=mysql_fetch_array($ret);

  if ($count!==1)
  {
    echo "<script>window.alert('Admin Username or Password Incorrect.')</script>";
    echo "<script>window.location='admin_signin.php'</script>";
  }
  else
  {
    $_SESSION['AdminID']=$row['adminID'];   
    $_SESSION['AdminUsername']=$row['a_username'];

    $Name=$_SESSION['a_username'];
    echo "<script> window.alert('Welcome $Name')</script>";
    echo "<script> window.location='project_display.php'</script>";

  }
}


?>

<html>
<head>
  <title>
    Admin Sign-In
  </title>
</head>
<body>
  <form action="admin_signin.php" method="post">
    <fieldset> 
        <legend>
             Admin Sign-In 
        </legend>
        <table align="center" cellspacing="8">
          <tr>
            <td>
              Username
            </td>
            <td>
               : <input type="text" name="txtusername" placeholder="Username">
            </td>
          </tr>
      <tr>
        <td>
          Password 
        </td>
        <td> : 
 <input type="password" name="txtpassword" placeholder="********" required />
    
</td>
</tr>


<tr align="center">
  <td> </td>
  <td>
    <input type='submit'  name='btnsignin'  value='Sign In' />
   
    <input type="reset" value="Clear" />
  </td>
</tr>


</table>
</form>
</fieldset>
</body>
</html>