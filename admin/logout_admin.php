<?php  
session_start();
if (session_is_registered('username')){
	session_unregister("username");
?>
  <script language="javascript">
	   document.location="index.php";
	</script>
<?php 
}
else{
?>
  <script language="javascript">
	   alert("Maaf, Anda tidak berhak mengakses halaman ini!!");
	   document.location="index.php";
	</script>
<?php 
}
?>
