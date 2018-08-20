<?php
include_once 'include/cek_sesi.php';

// Query ketika komentar status lebih dari dua
$query_jum_kom=mysql_query("SELECT K.*, U.gambar_profil_kecil 
               FROM komentar K, user U 
               WHERE K.uid_fk=U.uid and K.idstatus_fk='$idstatus' 
               ORDER BY K.idkomentar asc ");
$komentar_count=mysql_num_rows($query_jum_kom);
if($komentar_count>2){
		$koment_seluruhnya=$komentar_count-2;
?>
<div class="commentboxfirst" id='commentboxfirst<?php echo $idstatus;?>'>
<a href='#' class='commentcoll' id='<?php echo $idstatus;?>' title='Comment'> 
<img src="images/komentar.png" /> View All <?php echo $komentar_count; ?> Comment</a>
</div>
<?php
}
else{
		$koment_seluruhnya=0;		
}
?>

<div class="collapse" id='collapse<?php echo $idstatus; ?>'>
<?php 
$newquery=mysql_query("SELECT K.*, U.nama, U.gambar_profil_kecil 
          FROM komentar K, user U 
          WHERE K.uid_fk=U.uid AND K.idstatus_fk='$idstatus' 
          ORDER BY K.idkomentar LIMIT $koment_seluruhnya,2");
while($rowkomdua=mysql_fetch_array($newquery)){
    $idkom2=$rowkomdua['idkomentar'];
    $komentar2=tolink(htmlentities($rowkomdua['komentar']));
    $time2=$rowkomdua['dibuat'];
    $nama2=$rowkomdua['nama'];
    $uid2=$rowkomdua['uid_fk'];
    if ($rowkomdua['gambar_profil_kecil'] != NULL){
	    $image_komen = "member/$uid2/profile".$uid2.".jpg";
		}
		else{
		  $image_komen="images/default.png";
		}
    $cface2= $image_komen;
?>

<div class="stcommentbody2" id="stcommentbody<?php echo $idkom2; ?>">
<div class="stcommentimg">
  <img src="<?php echo $cface2; ?>" class='small_face' />
</div> 
<div class="stcommenttext">
<a class="stcommentdelete" href="#" id='<?php echo $idkom2; ?>' title='Hapus Komentar'>x</a>
<b><a href="profile.php?id=<?php echo $uid2; ?>"><?php echo $nama2; ?></b></a> <?php echo $komentar2; ?>
<div class="stcommenttime"><?php time_stamp($time2); ?></div> 
</div>
</div>
<?php } ?>
</div>

<div style='display:none' id='commentboxall<?php echo $idstatus; ?>'>
<?php
// Query menampilkan keseluruhan komentar pada status
$querykoment=mysql_query("SELECT K.*, U.nama, U.gambar_profil_kecil 
             FROM komentar K, user U 
             WHERE K.uid_fk=U.uid AND K.idstatus_fk='$idstatus' 
             ORDER BY K.idkomentar DESC");
while($rowkoment=mysql_fetch_array($querykoment)){
  $idkom=$rowkoment['idkomentar'];
  $komentar=tolink(htmlentities($rowkoment['komentar']));
  $time=$rowkoment['dibuat'];
  $nama=$rowkoment['nama'];
  $uid=$rowkoment['uid_fk'];
  
  if ($rowkoment['gambar_profil_kecil'] != NULL){
	    $image_koment= "member/$uid/profile".$uid.".jpg";
	}
	else{
		 $image_koment="images/default.png";
	}
  $cface= $image_koment;
?>

<div class="stcommentbody" id="stcommentbody<?php echo $idkom; ?>">
<div class="stcommentimg">
<img src="<?php echo $cface; ?>" class='small_face' />
</div> 
<div class="stcommenttext">
<a class="stcommentdelete" href="#" id='<?php echo $idkom; ?>' title='Delete Comment'>x</a>
<b><a href="profile.php?id=<?php echo $uid; ?>"><?php echo $nama; ?></b></a> <?php echo $komentar; ?>
<div class="stcommenttime"><?php time_stamp($time); ?></div> 
</div>
</div>
<?php } ?>
</div>
