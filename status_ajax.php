<?php
session_start();

// Tampil updates 
include_once 'include/db.php';
include_once 'include/tolink.php';
include_once 'include/time_stamp.php';
include_once 'include/cek_sesi.php';

$uid = $_SESSION['uid'];

// Ambil gambar profile
$query_profil = mysql_query("SELECT gambar_profil_kecil FROM `user` WHERE uid='$uid'");
  $row=mysql_fetch_array($query_profil);
  if ($row['gambar_profil_kecil'] != NULL){
	    $image = "member/$uid/profile".$uid.".jpg";
	}
	else{
		 $image="images/default.png";
	}
	
  if(isSet($_POST['update']) && isSet($_POST['id_dinding'])){
	  $update=htmlentities($_POST['update']);
	  $id_dinding=$_POST['id_dinding'];
	  $image_url = htmlentities($_REQUEST['image_url']);
	  $time=time();
	  $ip=$_SERVER['REMOTE_ADDR'];
	  
    $query = mysql_query("SELECT idstatus,status FROM `status` 
             WHERE uid_fk='$uid' ORDER BY idstatus DESC LIMIT 1");
    $result = mysql_fetch_array($query);
		
    if ($update!=$result['status']) {
    	$query = mysql_query("INSERT INTO `status` (status, uid_fk, id_dinding, foto, ip ,dibuat) 
               VALUES('$update', '$uid','$id_dinding','$image_url','$ip','$time')");
      $newquery = mysql_query("SELECT S.*, U.uid, U.nama FROM status S, user U 
                  WHERE S.uid_fk=U.uid AND S.id_dinding='$id_dinding' 
                  ORDER BY S.idstatus DESC LIMIT 1 ");
      $result = mysql_fetch_array($newquery);

      $idstatus=$result['idstatus'];
      $status=tolink(htmlentities($result['status']));
      $time=$result['dibuat'];
      $uid=$result['uid_fk'];
      $foto=$result['foto'];
      $nama=$result['nama'];
      $face=$image;

      if($uid==$id_dinding){
        $fotostatus = "member/$uid/foto/$foto";
      }
      if($uid!=$id_dinding){
        $fotostatus = "member/$id_dinding/foto/$foto";
      } 
?>
<div class="stbody" id="stbody<?php echo $idstatus; ?>">
<div class="stimg">
  <img src="<?php echo $face; ?>" class='big_face' />
</div> 
<div class="sttext">
<a class="stdelete" href="#" id="<?php echo $idstatus; ?>" title='Delete update'>x</a>
<b><?php echo $nama;?></b> <br /> <?php echo $status; ?>
<div class="sttime"><?php time_stamp($time); ?> | <a href='#' class='commentopen' id='<?php echo $idstatus; ?>' title='Comment'>Comment </a></div><br />

<?php 
if ($foto!="undefined")
	{ ?>
		<img src="<?php echo $fotostatus;?>" width="250" />
	<?php
	}
?>

<div id="stexpandbox">
  <div id="stexpand"></div>
</div>
<div class="commentcontainer" id="commentload<?php echo $id_status; ?>"></div>
<div class="commentupdate" style='display:none' id='commentbox<?php echo $idstatus; ?>'>
<div class="stcommentimg">
  <img src="<?php echo $face;?>" class='small_face'/>
</div> 
<div class="stcommenttext">
<form method="post" action="">
<textarea name="komentar" class="comment" maxlength="200"  id="ctextarea<?php echo $idstatus; ?>"></textarea>
<br />
<input type="submit" value="Comment" id="<?php echo $idstatus; ?>" class="comment_button" />
</form>
</div>
</div>
</div> 
</div>
<?php
  }
}
?>
