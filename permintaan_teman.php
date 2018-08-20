<?php
session_start();
error_reporting(0);
include_once 'include/db.php';
$uid=$_SESSION['uid'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Website Pertemanan - Lokomedia</title>
<link href="css/dinding.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.oembed.js"></script>
<script type="text/javascript" src="js/wall.js"></script>
<style type="text/css">
body {
	background-image: url(images/NewPicture.jpg);
	background-repeat: repeat-x;
}
.style1 { font-weight: bold }
</style>
</head>
<body>
<div class="main">
  <?php include('atas.php'); ?>  
 
<div class="left">
  <div class="propic">
    
  <?php
	$member_id = $_GET['id'];
	// Jika yang dibuka profile sendiri
	if($uid==$member_id){
	// Ambil gambar profile
	$query_profil = mysql_query("SELECT gambar_profil FROM `user` WHERE uid='$member_id'");
	$row=mysql_fetch_array($query_profil);
	if ($row['gambar_profil'] != NULL) {
	    $image = "member/$member_id/$row[gambar_profil]";
	}
	else{
		  $image="images/default.png";
	}
	?>
	<img src="<?php echo $image; ?>" class='big_profile' />		
	</div>
  <div class="link style1">
	   <?php include('kiri.php'); ?>	
	</div>
	                                                       
</div>
 <div class="right">
    <div class="rightleft">
      <div class="list"></div>

<div class="member_title">
  <img src="images/friends_request.png" /> &nbsp; Permintaan Teman
</div>
<ul id="member">
<?php
$query = mysql_query("SELECT P.id, P.mem1, P.mem2, U.nama, U.gambar_profil_kecil, U.uid 
                      FROM permintaan_teman P, user U WHERE P.mem1=U.uid and P.mem2='$uid'");
while($row=mysql_fetch_array($query)){
  if ($row['gambar_profil_kecil'] != NULL){
	   $image = "member/$row[mem1]/profile".$row[mem1].".jpg";
  }
	else{
		 $image="images/default.png";
	}
?>

<li>
<img src="<?php echo $image; ?>" />
<a href="#" class="user-title"><?php echo $row['nama'];?> </a>
<span class="add">
<form name="terimateman" method="post">
<input type="submit" class="greenButton" value="Terima Teman" name="app_teman" />
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="hidden" name="id_mem" value="<?php echo $row['uid']; ?>">
</form>
</span>
<span class="reject">
<form name="rejectteman" method="post">
<input type="submit" class="greenButton" value="Tolak Teman" name="reject_teman" />
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
<input type="hidden" name="id_mem" value="<?php echo $row['uid']; ?>">
</form>
</span>
</li>
<?php } ?>
</ul> 

<?php 
$id=$_POST['id'];
$id_mem=$_POST['id_mem'];
if (!empty($_POST['app_teman'])) {
	// Simpan Permintaan ke tabel array_teman
	// Query untuk user yang meminta pertemanan
	$sql_array_teman1 = mysql_query("SELECT array_teman FROM user WHERE uid='$uid' LIMIT 1");  
	while($row=mysql_fetch_array($sql_array_teman1)) { 
    $array_teman1 = $row["array_teman"]; 
  }
	 // Query untuk user yang dimintai pertemanan
	$sql_array_teman2 = mysql_query("SELECT array_teman FROM user WHERE uid='$id_mem' LIMIT 1");
	while($row=mysql_fetch_array($sql_array_teman2)) { 
    $array_teman2 = $row["array_teman"]; 
  }
	// Pecah array masing-masing user
	$arrayTeman1 = explode(",", $array_teman1);
	$arrayTeman2 = explode(",", $array_teman2);
	// Cek Apakah user yang diminta sudah ada pada array 
  if (in_array($id_mem, $arrayTeman1)) { 
    echo  'Member ini telah menjadi teman Anda'; 
    exit(); 
  }
	// Cek Apakah user yang meminta sudah ada pada array 
	if (in_array($uid, $arrayTeman2)) { 
    echo  'Member Ini telah menjadi teman Anda'; 
    exit(); 
  }
	// Jika user yang meminta pertemanan masih kosong arraynya
	if ($array_teman1 != "") { 
    $array_Teman1 = "$array_teman1,$id_mem"; 
  } 
  else { 
    $array_Teman1 = "$id_mem"; 
  }
	// Jika user yang diminta pertemanannya masih kosong arraynya
	if ($array_teman2 != "") { 
    $array_Teman2 = "$array_teman2,$uid"; 
  } 
  else { 
    $array_Teman2 = "$uid"; 
  }
  // Update data array bagi user yang meminta pertemanan
	$UpdateArrayTeman1 = mysql_query("UPDATE user SET array_teman='$array_Teman1' WHERE uid='$uid'");
  // Update data array bagi user yang diminta pertemanannya
  $UpdateArrayTeman2 = mysql_query("UPDATE user SET array_teman='$array_Teman2' WHERE uid='$id_mem'");
	
	// Hapus Permintaan Teman dari tabel permintaan
   $delete = mysql_query("DELETE FROM permintaan_teman WHERE id='$id'");
?>
<script language="javascript">
			alert("Approval Teman Berhasil");
			document.location="home.php";
</script>
<?php 
}
if (!empty($_POST['reject_teman'])) {
   // Hapus Permintaan Teman
   $delete = mysql_query("DELETE FROM permintaan_teman WHERE id='$id'");
?>
<script language="javascript">
			alert("Permintaan Teman Sudah Ditolak");
			document.location="home.php";
</script>
<?php 
}
}
?>
</div>
</div>
</body>
</html>