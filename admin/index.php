<?php
session_start();
include_once '../include/db.php';

// jika admin ingin login
if(isset($_POST['submit'])){
$username=htmlentities((trim($_POST['username'])));
$password=htmlentities(md5($_POST['password']));
$result = mysql_query("SELECT * from admin WHERE username = '$username' and password='$password'");
$user_data = mysql_fetch_array($result);
$data_ada = mysql_num_rows($result);

if ($data_ada == 1)	{
	$_SESSION['username'] = $user_data['username'];
	// login sukses
	header("location: administrator.php");
}
else{
	// login gagal
?>
<script language="javascript">
	alert("Maaf, Username atau Password Anda salah!!");
  document.location="index.php";
</script>
<?php  
	}
}
?>
<html>
<head>
<link href="login.css" rel="stylesheet" type="text/css">
<title>Login Admin Website Pertemanan</title>
</head>

<body>
<div id="login_box">
	<h1>Login Administrator</h1>
	<form id="login" method="post">
    <div id="login_form">
		<p>
			<label for="username">Username:</label>
			<input type="text" name="username" size="20" class="form_field" />			
		</p>
		<p>
			<label for="password">Password:</label>
			<input type="password" name="password" size="20" class="form_field" />			
		</p>
		<p>
			<input type="submit" name="submit" id="submit" value="Login" />
		</p>
	</form>
    </div>
</div>
</body>
</html>
