<?php
session_start();
error_reporting(0);
include_once 'include/db.php';
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
	  // Ambil gambar profile jika membuka daftar teman sendiri
	  if($uid==$member_id){
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
	  <?php 
    } 
    else {
	  // Ambil gambar profile jika membuka daftar teman orang lain
    $query_profil = mysql_query("SELECT gambar_profil FROM `user` WHERE uid='$member_id'");
	  $row=mysql_fetch_array($query_profil);
	  if ($row['gambar_profil'] != NULL){
	      $image = "member/$member_id/$row[gambar_profil]";
		}
		else{
		    $image="images/default.png";
		}
		?>
		<img src="<?php echo $image;?>" class='big_profile'/>    
    <?php  } ?>    	
	</div>
  <div class="link style1">
	
	<?php include('kiri.php'); ?>	
	</div>
	
</div>
 <div class="right">
    <div class="rightleft">
      <div class="list"></div>

<?php
// Menampilkan daftar teman 
if($uid==$member_id){
$query_judul = mysql_query("SELECT * FROM user where uid='$uid'");
$row=mysql_fetch_array($query_judul);
?>
<div class="member_title">
  <img src="images/connect.png" /> Daftar Teman <?php echo $row['nama']; ?>
</div>
<?php
$query = mysql_query("SELECT * FROM user WHERE uid='$uid'");
}
else{
$query_judul = mysql_query("SELECT * FROM user WHERE uid='$member_id'");
$row=mysql_fetch_array($query_judul);
?>
<div class="member_title">
  <img src="images/connect.png" /> Daftar Teman <?php echo $row['nama'];?>
</div>
<?php
$query = mysql_query("SELECT * FROM user WHERE uid='$member_id'");
}
?>
<ul id="member">
<?php
while($row=mysql_fetch_array($query)){
  $arrayTeman = $row["array_teman"];

  if ($arrayTeman != "") { 
	  // Pecah Array Teman
    $array_teman = explode(",", $arrayTeman);
	  $temanCount = count($array_teman);
	  // paging daftar teman dibatasi 10 user perhalaman
	  $batas=10;
	  $halaman=$_GET['halaman'];
	  if(empty($halaman)){
	     $posisi=0;
	     $halaman=1;
	  }
	  else {
	     $posisi=($halaman-1) * $batas; 
	  }
	 // memecah array berdasarkan limit dan posisi paging
	 $array_fix=array_slice($array_teman, $posisi, $batas);
	
	 // Tampilkan daftar array teman
	 foreach ($array_fix as $key => $value) { 
		$sql_teman = mysql_query("SELECT uid, nama, gambar_profil_kecil FROM user WHERE uid='$value' LIMIT 1");
		while($row=mysql_fetch_array($sql_teman)){	
			if ($row['gambar_profil_kecil'] != NULL){
	   		 $image = "member/$row[uid]/profile".$row[uid].".jpg";
			}
			else{
				 $image="images/default.png";
			}
			//Tampilkan List Teman
			?>	
			<li id="list<?php echo $row['uid']; ?>"> <img src="<?php echo $image; ?> " />
			<a href="profile.php?id=<?php echo $row['uid']; ?>" class="user-title"><?php echo $row['nama'];?> </a>
			<span class="add">
			
      <!--form menghapus pertemanan-->
			<form name="hapusteman" method="post">
			<input type="submit" class="greenButton" value="Hapus Teman" name="hapus_teman" />
			<input type="hidden" name="id_mem" value="<?php echo $row['uid']; ?>">
			</form>
			</span>
       		</li>
          
	  <?php
 	  }

		
		//Hapus Pertemanan
		$id_mem=$_POST['id_mem'];
		if (!empty($_POST['hapus_teman'])) {
 		 	// query untuk user yang ingin menghapus pertemanan
			$sql_array_teman1 = mysql_query("SELECT array_teman FROM user WHERE uid='$uid' LIMIT 1");  
			while($row=mysql_fetch_array($sql_array_teman1)) { 
          $array_teman1 = $row["array_teman"]; 
      }
			// query untuk user yang ingin dihapus pertemanan
			$sql_array_teman2 = mysql_query("SELECT array_teman FROM user WHERE uid='$id_mem' LIMIT 1");
			while($row=mysql_fetch_array($sql_array_teman2)) { 
          $array_teman2 = $row["array_teman"]; 
      }
			// Pecah array masing-masing user
			$arrayTeman1 = explode(",", $array_teman1);
			$arrayTeman2 = explode(",", $array_teman2);
			
   		// Cek Apakah user yang ingin dihapus tidak ada pada array  yang ingin menghapus
   		if (!in_array($id_mem, $arrayTeman1)) { 
        echo 'Member ini tidak ada pada daftar teman Anda'; 
        exit(); 
      }
			// Cek Apakah user yang ingin menghapus tidak ada pada array yang ingin dihapus
			if (!in_array($uid, $arrayTeman2)) { 
        echo 'Member Ini tidak ada pada daftar teman Anda'; 
        exit(); 
      }
	
			// inilah perintah untuk menghapus user dalam sebuah array dengan fungsi "unset"
			foreach ($arrayTeman1 as $key => $value) {
			  if ($value == $id_mem) {
			      unset($arrayTeman1[$key]);
				} 
  		}
			foreach ($arrayTeman2 as $key => $value) {
			  if ($value == $uid) {
			      unset($arrayTeman2[$key]);
			  } 
		  } 
			// sekarang gunakan fungsi implode untuk mengembalikan lagi ke dalam string setelah array tadi sebelumnya di unset
			$stringArrayBaru1 = implode(",", $arrayTeman1);
 			$stringArrayBaru2 =  implode(",", $arrayTeman2);
			 
			// Dan setelah kembali menjadi string, update array ke masing2 user yang menghapus dan dihapus
			$sql = mysql_query("UPDATE user SET array_teman='$stringArrayBaru1' WHERE uid='$uid'");
			$sql = mysql_query("UPDATE user SET array_teman='$stringArrayBaru2' WHERE uid='$id_mem'");
			?>
      <script language="javascript">
			   alert("Pertemanan Sudah Dihapus");
			   document.location="home.php";
			</script>
<?php 
		}	  
	}
  }
}
?>
</ul> 
<div class="page">
	<?php
	// tampilkan paging halaman
	if($uid==$member_id){
		$user = $uid;
	}
	else{
		$user = $member_id;
	}
	// Query untuk menampilkan link Next dan Previous
	$jmlhalaman = ceil($temanCount/$batas);
	$file= "daftar_teman.php";
	//Link ke halaman sebelumnya
  if($halaman>1) {
	   $previous=$halaman-1;
	   echo "<a href=$file?id=$user&halaman=1> << First </a> | <a href=$file?id=$user&halaman=$previous> < Previous</a> | ";
  }
  else {
	   echo "<< First | < Previous | ";
  }
  
  // tampilkan Link Halaman 1,2,3 .....
  for($i=1;$i<=$jmlhalaman;$i++)
    if ($i !=$halaman) {
	  echo "<a href=$file?id=$user&halaman=$i>$i</a> | " ;
  }
  else {
	  echo "<b>$i</b> | ";
  }
  // Link ke halaman Berikutnya
  if($halaman < $jmlhalaman) {
	   $next=$halaman+1;
	   echo "<a href=$file?id=$user&halaman=$next> Next > </a> | <a href=$file?id=$user&halaman=$jmlhalaman> Last >> </a> ";
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
