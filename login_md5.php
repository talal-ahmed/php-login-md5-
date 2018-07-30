<?php 
session_start();
$result="";
include("inc/con1.php");

if(isset($_POST['submit']))
{
$user = $_POST['user'];
$pass = $_POST['password'];
$pass = md5($pass);

$query= "select * from login_tbl 
		where user = '$user' 
		AND password ='$pass'";

$cmd=mysqli_query($con,$query);
$row = mysqli_fetch_array($cmd);		

if($user == $row[1] && $pass == $row[2])
{

 $_SESSION['user'] = $user;
 $_SESSION['password'] = $pass;
$type = $_SESSION['type'] = $row[3];

if($type == 'A')
{
header('location:welcome.php');
}
if($type == 'U')
{
header('location:user.php');
}
}	
else
{
$result = "invalid login";	
}

}
if(empty($user))
{
$result = "fill the required field";	
}	

?>
<!DOCTYPE html>
<html>
<head>
	<title>login page</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript" src="js/jquery-2.2.0.min.js"></script>	
</head>
<body>
<div class="container">
<h1 class="col-sm-offset-4">login page</h1>
<form class="form-horizontal" method="post" action="login_md5.php">

<div class="form-group">

<!-- opposite style -->
<div class="col-sm-4">
<label class="label-control">user</label>
<input type="text" class="form-control" name="user">
</div>	
</div>

<div class="form-group">
<div class="col-sm-4">
<label class="label-control">password</label>
<input type="password" class="form-control" name="password">	
</div>
</div>

<div class="form-group">
<button type="submit" class="btn btn-success col-sm-offset-2" name="submit">submit</button>	
<?php echo $result; ?>
</div>

</form>
</div>
</body>
</html>