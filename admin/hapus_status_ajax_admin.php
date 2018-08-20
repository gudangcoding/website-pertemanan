<?php
session_start();
include_once '../include/db.php';
include_once 'cek_sesi_admin.php';

if(isSet($_POST['idstatus'])){
$idstatus=$_POST['idstatus'];
$query = mysql_query("DELETE FROM `status` WHERE idstatus = '$idstatus'");
$query = mysql_query("DELETE FROM `komentar` WHERE idstatus_fk = '$idstatus'");
}
?>
