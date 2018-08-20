<?php
session_start();
include_once '../include/db.php';
include_once 'cek_sesi_admin.php';

if(isSet($_POST['idkom'])){
    $idkom=$_POST['idkom'];
    $query = mysql_query("DELETE FROM `komentar` WHERE idkomentar='$idkom'");
}
?>
