<?php
session_start();
error_reporting(0);
include_once 'include/db.php';
include_once 'include/cek_sesi.php';
$uid=$_SESSION['uid'];
$member_id=$_GET['id'];
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
<script type="text/javascript" src="js/surat.js"></script>
<style type="text/css">
body {
	background-image: url(images/NewPicture.jpg);
	background-repeat: repeat-x;
}
.style1 {font-weight: bold}
</style>
</head>
<body>
<div class="main">
  <?php include('atas.php'); ?>  
 
   <div class="left">
    <div class="propic">
    
   <?php
	 // Ambil gambar profile
	 $query_profil = mysql_query("SELECT gambar_profil FROM `user` WHERE uid='$uid'");
	 $row=mysql_fetch_array($query_profil);
	 if ($row['gambar_profil'] != NULL){
	    $image = "member/$uid/$row[gambar_profil]";
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
    <div class="rightleft">
      <div class="list"></div>
<div class="inbox_title">
  <img src="images/dibaca.png" /><a href="inbox.php?id=<?php echo $uid; ?>"> Inbox </a> 
</div>

<form action="hapus_pesan.php" method="post">
<div class="inbox_content">
<ul>
  <li class="hd">
    <span class="box1">#</span>
    <span class="box2">Pengirim</span>
    <span class="box3">Subject</span>
    <span class="box4">Tanggal</span>
  </li>
<?php
// paging halaman
$batas=5;
$halaman=$_GET['halaman'];
if(empty($halaman)){
	$posisi=0;
	$halaman=1;
}
else {
	$posisi=($halaman-1) * $batas; 
}
$query = mysql_query("SELECT P.*,U.nama, U.gambar_profil_kecil, U.uid FROM pesan P, user U 
                      WHERE P.id_pengirim=U.uid AND P.id_penerima='$uid' 
                      ORDER BY P.id desc LIMIT $posisi, $batas");
while($row=mysql_fetch_array($query)){
if ($row['gambar_profil_kecil'] != NULL) {
   $image = "member/$row[id_pengirim]/profile".$row[id_pengirim].".jpg";
}
else{
	 $image="images/default.png";
}
?>
<li><span class="box1"><input type="checkbox" name="cek[]" value="<?php echo $row['id']; ?>"></span>
<span class="box2"><img src="<?php echo $image; ?> " /> <br /> 
<a href="profile.php?id=<?php echo $row['id_pengirim']; ?>"><?php echo $row['nama']; ?></a> </span>
<?php
if($row['dibuka']==1) {
?>
<span class="box3"><b><a href="bukapesan.php?id=<?php echo $member_id; ?>&baca=<?php echo $row['id']; ?>"> <?php echo $row['subject']; ?> </a></b></span>
<?php
}
else {
?>
<span class="box3"><a href="bukapesan.php?id=<?php echo $member_id; ?>&baca=<?php echo $row['id']; ?>"> <?php echo $row['subject']; ?> </a></span>
<?php 
}
$tgl=substr($row[tgl],8,2)."-".substr($row[tgl],5,2)."-".substr($row[tgl],0,4); ?>
<span class="box4" ><?php echo $tgl; ?></span></li>
<?php } ?>
</ul>
<div align="center">
<input type="submit" name="hapus_button" class="greenButton" value="Hapus Pesan" /><br /><br />
</div>
</form>
<div class="page">
<?php
// Query untuk menampilkan link Next dan Previous
$tampil = mysql_query("SELECT P.*, U.nama, U.gambar_profil_kecil, U.uid FROM pesan P, user U 
                      WHERE P.id_pengirim=U.uid and P.id_penerima='$uid'"); 
$jmldata= mysql_num_rows($tampil);
$jmlhalaman = ceil($jmldata/$batas);
$file= "inbox.php";
// Link ke halaman sebelumnya
if($halaman>1) {
	$previous=$halaman-1;
	echo" <a href=$file?id=$uid&halaman=1> << First </a> | <a href=$file?id=$uid&halaman=$previous> < Previous</a> | ";
}
else {
	echo "<< First | < Previous | ";
}
// Tampilkan Link Halaman 1,2,3 .....
for($i=1;$i<=$jmlhalaman;$i++)
if ($i !=$halaman) {
	echo "<a href=$file?id=$uid&halaman=$i>$i</a> | " ;
}
else {
	echo "<b>$i</b> | ";
}
// Link ke halaman Berikutnya
if($halaman < $jmlhalaman) {
	$next=$halaman+1;
	echo "<a href=$file?id=$uid&halaman=$next> Next > </a> | <a href=$file?id=$uid&halaman=$jmlhalaman> Last >> </a> ";
}
else {
	echo " Next > | Last >>"; 
}
?>
</div>
</div>
</div>
</body>
</html>