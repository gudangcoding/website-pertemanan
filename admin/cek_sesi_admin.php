<?php  
session_start();
if (session_is_registered('username')){	
}
else{
	header("location:index.php");
}
?>
