<?php
session_start();
include_once 'include/db.php';
include_once 'include/cek_sesi.php';

$uid=$_SESSION['uid'];
$t_width = 50;	// Maximum thumbnail width
$t_height = 50;	// Maximum thumbnail height
$nama = "profile".$uid.".jpg"; // Thumbnail image name
$path = "member/$uid/";
if(isset($_GET['t']) and $_GET['t'] == "ajax"){
		extract($_GET);
		$ratio = ($t_width/$w); 
		$nw = ceil($w * $ratio);
		$nh = ceil($h * $ratio);
		$nimg = imagecreatetruecolor($nw,$nh);
		$im_src = imagecreatefromjpeg($path.$img);
		imagecopyresampled($nimg,$im_src,0,0,$x1,$y1,$nw,$nh,$w,$h);
		imagejpeg($nimg,$path.$nama,90);
		mysql_query("UPDATE user SET gambar_profil_kecil='$nama' WHERE uid='$uid'");
		echo $nama."?".time();
		exit;
}
?>
