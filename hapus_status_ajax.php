<?php
session_start();
$uid = $_SESSION['uid'];
include_once 'include/db.php';
include_once 'include/cek_sesi.php';
include_once 'include/tolink.php';
include_once 'include/time_stamp.php';

if(isSet($_POST['idstatus'])){
  $idstatus=$_POST['idstatus'];
  $query = mysql_query("DELETE FROM `komentar` WHERE idstatus_fk='$idstatus'");
  $query = mysql_query("DELETE FROM `status` WHERE idstatus = '$idstatus' AND uid_fk='$uid'");
}
?>
