<?php
include_once '../include/db.php';
include_once 'cek_sesi_admin.php';
include_once '../include/tolink.php';
include_once '../include/time_stamp.php';

//Tampilkan data komentar 
if(isset($_POST['statusakhir']) && is_numeric($_POST['statusakhir'])){
    $statusakhir=$_POST['statusakhir'];
    $query = mysql_query("SELECT S.*, U.* FROM status S, user U 
                          WHERE S.uid_fk=U.uid AND S.idstatus<'$statusakhir' 
                          ORDER BY S.idstatus DESC LIMIT 10");
}
else{
    $query = mysql_query("SELECT S.*, U.* FROM status S, user U 
                          WHERE S.uid_fk=U.uid ORDER BY S.idstatus DESC LIMIT 0,10");
}

while($row=mysql_fetch_array($query)){
  // Ambil gambar profile kecil untuk gambar status
 	if ($row['gambar_profil_kecil'] != NULL){
	    $image = "../member/$row[uid]/profile".$row['uid'].".jpg";
  }
  else{
		  $image="../images/default.png";
	}
		 
  $idstatus=$row['idstatus'];
  $userid=$row['uid'];
  $oristatus=$row['status'];
  $status=tolink(htmlentities($row['status']));
  $time=$row['dibuat'];
  $nama=$row['nama'];
  $foto = $row['foto'];
  $fotostatus= "../member/$row[uid]/foto/$foto";
  $face=$image;
  $face_komen=$image_komentr;
?>

<div class="stbody" id="stbody<?php echo $idstatus; ?>">
<div class="stimg">
  <img src="<?php echo $face;?>" class='big_face' />
</div> 
<div class="sttext">
<a class="stdelete" href="#" id="<?php echo $idstatus;?>" title="Delete update">x</a>
<b><a href="profile.php?id=<?php echo $userid; ?>"> <?php echo $nama;?> </a></b> <br /><?php echo $status;?> 
<div class="sttime"><?php time_stamp($time);?> </div>
<?php 
if ($foto!="undefined"){
?>
<img src="<?php echo $fotostatus;?>" width="250" /> 
<?php } ?>
<div id="stexpandbox">
<div id="stexpand<?php echo $idstatus; ?>"></div>
</div>

<div class="commentcontainer" id="commentload<?php echo $idstatus; ?>">
<?php include ('buka_komentar_admin.php'); ?>
</div>

<div class="commentupdate" style='display:none' id='commentbox<?php echo $idstatus;?>'>
<div class="stcommentimg">
  <img src="<?php echo $face_komen;?>" class='small_face' />
</div> 
<div class="stcommenttext" >
<form method="post" action="">
<textarea name="komentar" class="comment" maxlength="200"  id="ctextarea<?php echo $idstatus;?>"></textarea><br />
<input type="submit"  value=" Comment "  id="<?php echo $idstatus;?>" class="comment_button"/>
</form>
</div>
</div>
</div> 
</div>
<?php
}
if( mysql_num_rows($query)==10){
?>
<div id="paging">
 <a id="<?php echo $idstatus; ?>" href="#" class="load_more_admin" >Show Older Posts <img src="../images/arrow1.png" /></a></div>
<?php
}
else {
?> 
<div id="paging">
  <a id="end" href="#" class="load_more_admin">No More Posts</a>
  </div>
<?php } ?>
