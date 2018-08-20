<?php
session_start();
$uid = $_SESSION['uid'];

include_once 'include/db.php';
include_once 'include/cek_sesi.php';
include_once 'include/tolink.php';
include_once 'include/time_stamp.php';

// Ambil gambar profile
$query_profil = mysql_query("SELECT gambar_profil_kecil FROM `user` WHERE uid='$uid'");
$row=mysql_fetch_array($query_profil);
if ($row['gambar_profil_kecil'] != NULL){
    $image = "member/$uid/profile".$uid.".jpg";
}
else{
    $image="images/default.png";
}

// Tampilkan komentar terupdate
if(isSet($_POST['komentar'])){
    $komentar=$_POST['komentar'];
    $idstatus=$_POST['idstatus'];
    $ip=$_SERVER['REMOTE_ADDR'];
    $komentar=htmlentities($komentar);
    $time=time();
    
    $query = mysql_query("SELECT idkomentar,komentar FROM `komentar` 
             WHERE uid_fk='$uid' AND idstatus_fk='$idstatus' 
             ORDER BY idkomentar DESC LIMIT 1");
    $result = mysql_fetch_array($query);
    
    if ($komentar!=$result['komentar']) {
        $query = mysql_query("INSERT INTO `komentar` (komentar,uid_fk,idstatus_fk,ip,dibuat) 
                 VALUES ('$komentar','$uid','$idstatus','$ip','$time')");

        $newquery = mysql_query("SELECT K.*, U.nama FROM komentar K, user U 
                    WHERE K.uid_fk=U.uid AND K.uid_fk='$uid' AND K.idstatus_fk='$idstatus' 
                    ORDER BY K.idkomentar DESC LIMIT 1");
        $result = mysql_fetch_array($newquery);

        $idkom=$result['idkomentar'];
        $komentar=tolink(htmlentities($result['komentar']));
        $time=$result['dibuat'];
        $nama=$result['nama'];
        $uid=$result['uid_fk'];
        $cface=$image;
 ?>
<div class="stcommentbody" id="stcommentbody<?php echo $idkom; ?>">
<div class="stcommentimg">
  <img src="<?php echo $cface; ?>" class='small_face' />
</div> 
<div class="stcommenttext">
<a class="stcommentdelete" href="#" id='<?php echo $idkom; ?>' title='Hapus Komentar'>x</a>
<b><?php echo $nama; ?></b> <?php echo $komentar; ?>
<div class="stcommenttime"><?php time_stamp($time); ?></div> 
</div>
</div>
<?php
    }
}
?>
