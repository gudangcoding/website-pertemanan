<?php
session_start();
include_once '../include/db.php';
include_once 'cek_sesi_admin.php';
?>
<html>
<head>
<title>Administrator Website Pertemanan</title>
<link href="../css/dinding.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
	background-image: url(../images/NewPicture.jpg);
	background-repeat: repeat-x;
}
.style1 { font-weight: bold }
</style>
</head>
<body>
<div class="main">
  <div class="lefttop1">
    <div class="lefttopleft"><img src="../images/logo.png" width="94" height="21" /></div>
   
    <div class="lefttoright">
</div>
</div>
<div class="righttop1">
<div class="search">
     <img src="../images/admin.png" width="200" height="35" />
</div>   
<div class="nav">
  <ul id="sddm">
    <li><a href="administrator.php">Member</a></li>
    <li><a href="status.php">Status</a></li>
    <li><a href="logout_admin.php">Logout</a></li>
  </ul>
  <div style="clear:both"></div>
  <div style="clear:both"></div>
</div>
</div>
 <div class="right">
    <div class="rightleft">
      <div class="list"></div>
<div class="member_title">
  <img src="../images/connect.png" /> Administrasi Hapus Member 
</div>
<ul id="member">
<?php
$batas=5;
$halaman=$_GET['halaman'];
if(empty($halaman)){
	   $posisi=0;
	   $halaman=1;
}
else {
	   $posisi=($halaman-1) * $batas; 
}
	
$query = mysql_query("SELECT * FROM user LIMIT $posisi, $batas");
while($row=mysql_fetch_array($query)){
	if ($row['gambar_profil_kecil'] != NULL){
		$image = "../member/$row[uid]/profile".$row[uid].".jpg";
	}
	else{
		$image="../images/default.png";
	}
//Tampilkan List Teman
?>	
			<li id="list<?php echo $row['uid']; ?>"> <img src="<?php echo $image; ?> " />
			<a href="profile.php?id=<?php echo $row['uid']; ?>" class="user-title"><?php echo $row['nama'];?> </a>
			<span class="add">
      <!--form menghapus pertemanan-->
			<form name="hapusmember" method="post" action="hapus_member.php">
			<input type="submit" class="greenButton" value="Hapus Member Ini" name="hapus_member" />
			<input type="hidden" name="id_mem" value="<?php echo $row['uid']; ?>">
			</form>
			</span>
      </li>     
<?php
}
?>
</ul> 
<div class="page">
<?php
$paging = mysql_query("SELECT * FROM user");
// Query untuk menampilkan link Next dan Previous
$jmldata= mysql_num_rows($paging);
$jmlhalaman = ceil($jmldata/$batas);
$file= "administrator.php";
// Link ke halaman sebelumnya
if($halaman>1) {
	   $previous=$halaman-1;
	   echo " <a href=$file?halaman=1> << First </a> | <a href=$file?halaman=$previous> < Previous</a> | ";
}
else {
	   echo "<< First | < Previous | ";
}
//Tampilkan Link Halaman 1,2,3 .....
for($i=1;$i<=$jmlhalaman;$i++)
  if ($i!=$halaman) {
	   echo "<a href=$file?halaman=$i>$i</a> | " ;
  }
  else {
	   echo "<b>$i</b> | ";
  }
  //Link ke halaman Berikutnya
  if($halaman < $jmlhalaman) {
	   $next=$halaman+1;
	   echo "<a href=$file?halaman=$next> Next > </a> | <a href=$file?halaman=$jmlhalaman> Last >> </a> ";
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
