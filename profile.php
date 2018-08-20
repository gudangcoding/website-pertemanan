<?php
session_start();
error_reporting(0);
include_once 'include/db.php';
include_once 'include/cek_sesi.php';
$uid=$_SESSION['uid'];
// Ambil profile id
$member_id = $_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Website Pertemanan - Lokomedia</title>
<link href="css/dinding.css" rel="stylesheet" type="text/css">
<link href="css/surat.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.livequery.js" ></script>
<script type="text/javascript" src="js/jquery.oembed.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript" src="js/wall.js"></script>
<script type="text/javascript" src="js/suggest.js"></script>
<script type="text/javascript" src="js/surat.js"></script>

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

<?php 
include ('atas.php');

// Jika yang dibuka adalah Profile Sendiri
if($uid==$member_id){ 
?>
<div class="left">
  <div class="propic">
	<?php 
  // Ambil gambar profile
	$query_profil = mysql_query("SELECT gambar_profil,nama 
                  FROM `user` WHERE uid='$member_id'");
	$row=mysql_fetch_array($query_profil);
	if ($row['gambar_profil'] != NULL) {
	    $image = "member/$member_id/$row[gambar_profil]";
	}
	else{
		  $image="images/default.png";
	}
	?>
	<img src="<?php echo $image;?>" class='big_profile'/>	
	</div>
 
  <div class="link style1">
	   <?php include('kiri.php'); ?>
	</div>	
</div>

<div class="right">
      <div class="list">
</div>

<div id="wall_container">
<h3><?php echo $row['nama']; ?>&nbsp; &nbsp; &nbsp; <a href="#" id="klikfoto"><img src="images/foto.png" /> </a></h3>
<div id="updateboxarea">
<textarea cols="30" rows="4" name="update" id="update" maxlength="200"></textarea>
<input type="hidden" name="id_dinding" id="id_dinding" value="<?php echo $member_id; ?>" />
<div id="showthumb"></div>
<input type="submit" value="Update" id="update_button" class="update_button"/>
<form method="post" action="uploadgambar.php" enctype="multipart/form-data" id="frmUpload">
<div style="display:none" id="bukafoto" class="bukafoto">
<b>Silahkan Upload Foto Anda dengan Max ukuran foto 1 MB</b> <br />
<input type="file" name="photoimg" id="photoimg" />
<input type="hidden" name="id_dinding2" value="<?php echo $member_id; ?>" />
</div>
</form>
</div>
<div id='flashmessage'>
  <div id="flash" align="left" ></div>
</div>
<div id="content">
  <?php include('buka_status_profil.php'); ?>
</div>
</div>

<?php 
} 
// Jika yang dibuka bukan Profile Sendiri
else{
?>
<div class="left">
  <div class="propic">
	<?php
	$sql_array_teman = mysql_query("SELECT array_teman 
                     FROM user WHERE uid='$uid' LIMIT 1"); 
	while($row=mysql_fetch_array($sql_array_teman)) { 
     $arrayTeman = $row["array_teman"]; 
  }
	$array_teman = explode(",", $arrayTeman);
	
	// Jika member ini sudah menjadi teman, tampilkan profile-nya
  if (in_array($member_id, $array_teman)) {  
	// Ambil gambar profile
	$query_profil = mysql_query("SELECT gambar_profil,nama, gambar_profil_kecil 
                  FROM `user` WHERE uid='$member_id'");
	$row=mysql_fetch_array($query_profil);
	if ($row['gambar_profil'] != NULL){
	    $image = "member/$member_id/$row[gambar_profil]";
	}
	else {
		  $image="images/default.png";
	}
	?>
	<img src="<?php echo $image;?>" class='big_profile'/>		
	</div>

  <div class="link style1">
	 <?php include('kiri.php'); ?>
	</div>	
</div>
<div class="right">
      <div class="list">
</div>

<div id="wall_container">
<h3><?php echo $row['nama']; ?>&nbsp;&nbsp;<a href="#" class="modal">
<img src="images/messages.png" alt="Kirim Pesan"/></a>&nbsp; <a href="#" id="klikfoto"><img src="images/foto.png" /></a></h3> 
<!--Form kirim pesan-->
<div id="contact">
	<div id="close">Close</div>

	<div id="contact_header">Kirim Pesan</div>
	<p class="success">Pesan Sudah Terkirim.</p>

  <form action="kirim_pesan.php" method="post" name="formPesan" id="formPesan">
  <p><input name="id_pengirim" id="id_pengirim" type="hidden" size="30" value="<?php echo "$uid"; ?>" /></p>
  <p><input name="id_penerima" id="id_penerima" type="hidden" size="30" value="<?php echo "$member_id"; ?>" /></p>
  <p><label>Kepada </label> : <input name="penerima" id="penerima" type="text" size="50" value="<?php echo $row['nama']; ?>" disabled /> 
  &nbsp;&nbsp; <img src="<?php echo "member/$member_id/$row[gambar_profil_kecil]";?>" /></p>
  <p><label>Subject </label> : <input name="subject" id="subject" type="text" size="50" /></p>
  <p><textarea name="pesan" id="pesan" rows="5" cols="60"></textarea></p>
  <p><input type="submit" id="simpan_pesan" name="simpan_pesan" value="Kirim" /></p>
 </form>
</div>
<div id="mask"></div>
<!--end contact form-->

<div id="updateboxarea">
<textarea cols="30" rows="4" name="update" id="update" maxlength="200" ></textarea>
<input type="hidden" name="id_dinding" id="id_dinding" value="<?php echo $member_id; ?>" />
<div id="showthumb"></div>
<input type="submit"  value=" Update "  id="update_button"  class="update_button"/>
<form method="post" action="uploadgambar.php" enctype="multipart/form-data" id="frmUpload">
<div style="display:none" id="bukafoto" class="bukafoto">
<b>Silahkan Upload Foto Anda dengan Max ukuran foto 1 MB</b> <br />
<input type="file" name="photoimg" id="photoimg" />
<input type="hidden" name="id_dinding2" value="<?php echo $member_id; ?>" />
</div>
</form>
</div>
<div id='flashmessage'>
  <div id="flash" align="left"  ></div>
</div>
<div id="content">
  <?php include('buka_status_profil.php'); ?>
</div>
</div>

<?php 
} 
// Jika member ini belum menjadi teman
if (!in_array($member_id, $array_teman)) {
  // Ambil gambar profile
	$query_profil = mysql_query("SELECT * FROM `user` WHERE uid='$member_id'");
	   $row=mysql_fetch_array($query_profil);
	   if ($row['gambar_profil'] != NULL) {
	     $image = "member/$member_id/$row[gambar_profil]";
		 }
		 else {
		   $image="images/default.png";
		 }
?>
<img src="<?php echo $image;?>" class='big_profile'/>

<?php
// Cek apakah permintaan teman sudah pernah dilakukan atau belum?
$cek_minta_teman = mysql_query("SELECT * FROM `permintaan_teman` 
                   WHERE mem2='$uid' AND mem1='$member_id' OR mem2='$member_id' AND mem1='$uid'");
$user_ada=mysql_num_rows($cek_minta_teman);
if($user_ada==1){
?>
<script language="javascript">
		alert("Maaf, Anda sudah memiliki permintaan teman dari user ini!!");
		document.location="home.php";
</script>
<?php } ?>		
	</div>
	</div>
<div class="right">
      <div class="list">
</div>

<div id="wall_container">
<div id="updateboxarea">
<div>
Jadikan <b><?php echo $row['nama']; ?> </b>Teman Kamu 
</div>
<!--Form Untuk Menambah Teman-->
<form method="POST" action="tambah_teman.php" name="proses_tambah">
<input type="submit" class="greenButton" value="Add Friend" name="tambah_teman" />
<input type="hidden" name="mem2" value="<?php echo $member_id; ?>" />
</form>
</div>
<div id='flashmessage'>
<div id="flash" align="left"></div>
</div>
<div id="content">
</div>
</div>

<?php
}  
// Cek apakah user id terdaftar atau tidak, jika tidak munculkan pesan
$query_cek_user=mysql_query("SELECT * FROM `user` WHERE uid='$member_id'");
$user_ada=mysql_num_rows($query_cek_user);
if($user_ada==0){
?>
<script language="javascript">
	alert("Maaf, User ini tidak terdaftar!!");
	document.location="home.php";
</script>
<?php
	}
}
?>
</body>
</html>
