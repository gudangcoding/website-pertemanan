<?php
session_start();
include_once 'include/db.php';
include_once 'include/cek_sesi.php';
include_once 'include/tolink.php';
include_once 'include/time_stamp.php';
$uid_pemilik=$_SESSION['uid'];
$uid=$_GET['id'];
		 
		 //ambil gambar komentar
$query_gbr_komen = mysql_query("SELECT gambar_profil_kecil FROM `user` WHERE uid='$uid_pemilik'") or die(mysql_error());
	   $row_gbr=mysql_fetch_array($query_gbr_komen);
	   if ($row_gbr['gambar_profil_kecil'] != NULL)
	   {
	    $image_komentr = "member/$uid_pemilik/profile".$uid_pemilik.".jpg";
		 }
		 else
		 {
		 $image_komentr="images/default.png";
		 }

//Tampilkan status terupdate dari database 
if(isset($_POST['statusakhir']) && is_numeric($_POST['statusakhir']))
{
$statusakhir=$_POST['statusakhir'];
$id_dinding=$_POST['id_dinding'];
$query = mysql_query("SELECT S.*, U.* FROM status S, user U  WHERE S.uid_fk=U.uid and S.id_dinding='$id_dinding' AND S.idstatus<'$statusakhir' order by S.idstatus desc limit 10 ") or die(mysql_error());
}
else
{
$query = mysql_query("SELECT S.*, U.* FROM status S, user U  WHERE S.uid_fk=U.uid and S.id_dinding='$uid' order by S.idstatus desc limit 0,10");
}


while($row=mysql_fetch_array($query))
{
//ambil gambar status
  if ($row['gambar_profil_kecil'] != NULL)
	   {
	    $image = "member/$row[uid]/profile".$row['uid'].".jpg";
		 }
		 else
		 {
		 $image="images/default.png";
		 }

 $idstatus=$row['idstatus'];
 $oristatus=$row['status'];
 $userid=$row['uid'];
 $status=tolink(htmlentities($row['status']));
 $time=$row['dibuat'];
 $nama=$row['nama'];
 $foto = $row['foto'];
 $fotostatus= "member/$uid/foto/$foto";
 $face=$image;
 $face_komen=$image_komentr;
?>
<script type="text/javascript"> 
$(document).ready(function(){$("#stexpand<?php echo $idstatus;?>").oembed("<?php echo  $oristatus; ?>",{maxWidth: 400, maxHeight: 300});});
</script>
<div class="stbody" id="stbody<?php echo $idstatus;?>">

<div class="stimg">
<img src="<?php echo $face;?>" class='big_face'/>
</div> 
<div class="sttext">
<a class="stdelete" href="#" id="<?php echo $idstatus;?>" title="Delete update">x</a>
<b><a href="profile.php?id=<?php echo $userid; ?>"> <?php echo $nama;?></b></a><br /><?php echo $status;?> 
<div class="sttime"><?php time_stamp($time);?> | <a href='#' class='commentopen' id='<?php echo $idstatus;?>' title='Comment'>Comment </a></div>
<?php 
if ($foto!="undefined"){
?>
<img src="<?php echo $fotostatus;?>"  width="250" />
<?php } ?>
<div id="stexpandbox">
<div id="stexpand<?php echo $idstatus;?>"></div>
</div>

<div class="commentcontainer" id="commentload<?php echo $idstatus;?>">
<?php

include ('buka_komentar.php');
 ?>
</div>

<div class="commentupdate" style='display:none' id='commentbox<?php echo $idstatus;?>'>
<div class="stcommentimg">
<img src="<?php echo $face_komen;?>" class='small_face'/>
</div> 
<div class="stcommenttext" >
<form method="post" action="">

<textarea name="komentar" class="comment" maxlength="200"  id="ctextarea<?php echo $idstatus;?>"></textarea>
<br />
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
 <a id="<?php echo $idstatus; ?>" href="#" class="load_more" >Show Older Posts <img src="images/arrow1.png" /></a></div>
<?php
 }else {
    
?> <div  id="paging">
  <a  id="end" href="#" class="load_more" >No More Posts</a>
  </div>
<?php
  }

?>