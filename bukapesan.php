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
<link href="css/surat.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery.1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.livequery.js" ></script>
<script type="text/javascript" src="js/jquery.oembed.js"></script>
<script type="text/javascript" src="js/wall.js"></script>
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
  <?php include('atas.php'); ?>  
 
   <div class="left">
    <div class="propic">
    
    <?php
	 // Ambil gambar profile
	 $query_profil = mysql_query("SELECT gambar_profil, gambar_profil_kecil FROM `user` WHERE uid='$uid'");
	 $row=mysql_fetch_array($query_profil);
	 if ($row['gambar_profil'] != NULL || $row['gambar_profil_kecil'] != NULL) {
	    $image = "member/$uid/$row[gambar_profil]";
		  $image_kecil = "member/$uid/$row[gambar_profil_kecil]";
	 }
	 else{
		 $image="images/default.png";
		 $image_kecil="images/default.png";
	 }
	 ?>
	 <img src="<?php echo $image;?>" class='big_profile'/>	
	</div>
  <div class="link style1">
	<?php include('kiri.php'); ?>	
	</div>
	
</div>
 <div class="right">
      <div class="list"></div>

<div class="inbox_title">
  <img src="images/dibaca.png" /> <a href="inbox.php?id=<?php echo $uid; ?>"> Inbox </a>
</div>

<div class="inbox_content">
<ul>
<?php
$id_pesan=$_GET['baca'];
$query = mysql_query("SELECT U.uid, U.gambar_profil_kecil, U.nama, P.* FROM pesan P, user U 
                     WHERE id='$id_pesan' AND P.id_pengirim=U.uid");
$row=mysql_fetch_array($query);
if ($row['gambar_profil_kecil'] != NULL) {
	  $images = "member/$row[id_pengirim]/profile".$row[id_pengirim].".jpg";
}
else{
		 $images="images/default.png";
}
$tgl=substr($row[tgl],8,2)."-".substr($row[tgl],5,2)."-".substr($row[tgl],0,4); ?>
<li class="hd"><span class="box0">Subject : <?php echo $row['subject']; ?> </span></li>
<li>
<span class="box5" ><img src="<?php echo $images; ?> "  /> &nbsp; &nbsp;  </span>
<span class="box6">From : <a href="profile.php?id=<?php echo $row['id_pengirim']; ?>"><?php echo $row['nama']; ?> </a>, 
Tanggal :&nbsp; <?php echo $tgl; ?> <br /> <?php echo $row['pesan']; ?> </a></span>

<?php 
// Update pesan kalo pesan sudah dibuka 
$qry_dibuka=mysql_query("UPDATE `pesan` SET dibuka='0' WHERE id='$id_pesan'");
?>
</ul>

<div class="inbox_title">
  <img src="images/reply.png" /> <a href="#" id="reply"> Balas</a>
</div>
<p class="success">Pesan Sudah Terbalas.</p>

<div class="replypesan" style="display:none" id="balas">
<div class="replyimg">
  <img src="<?php echo $image_kecil;?>" />
</div> 
<div class="sttext">
<form method="post" action="">
<input type="text" value="Re: <?php echo $row['subject']; ?>" id="subject" size="47" />
<textarea name="textbalas" class="textbalas" id="textbalas" cols="45" rows="5"></textarea>
<input type="hidden" value="<?php echo $row['id_pengirim'] ?>" id="id_penerima"  /><br />
<input type="submit" value="Kirim" id="balas_button" class="balas_button"/>
</form>
</div>
</body>
</html>