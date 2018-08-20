<?php
session_start();
$uid=$_SESSION['uid'];

include_once 'include/db.php';
include_once 'include/cek_sesi.php';
include_once 'include/tolink.php';
include_once 'include/time_stamp.php';

if(isSet($_POST['idkom'])){
$idkom=$_POST['idkom'];
$query = mysql_query("DELETE FROM `komentar` 
         WHERE uid_fk='$uid' AND idkomentar='$idkom'");
}
?>
