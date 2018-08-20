<?php
session_start();
include_once '../include/db.php';
include_once 'cek_sesi_admin.php';
?>
<html>
<head>
<title>Administrator Website Pertemanan</title>
<link href="../css/dinding.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../js/jquery.1.4.2.min.js"></script>
<script type="text/javascript" src="../js/jquery.livequery.js" ></script>
<script type="text/javascript" src="admin.js"></script>
<style type="text/css">
body {
	background-image: url(../images/NewPicture.jpg);
	background-repeat: repeat-x;
}
.style1 { font-weight: bold }
</style>
</head>
<body>
<div class="main">
  <div class="lefttop1">
    <div class="lefttopleft"><img src="../images/logo.png" width="94" height="21" /></div>
       <div class="lefttoright"></div>
</div>
<div class="righttop1">
<div class="search">
     <img src="../images/admin.png" width="200" height="35" />
</div>   
<div class="nav">
  <ul id="sddm">
    <li><a href="administrator.php">Member</a></li>
    <li><a href="status.php">Status</a></li>
    <li><a href="logout_admin.php">Logout</a></li>
  </ul>
  <div style="clear:both"></div>
  <div style="clear:both"></div>
</div>
  </div>
 <div class="right">
    <div class="rightleft">
      <div class="list">
</div>
<div class="member_title">
  <img src="../images/wal.png" /> Administrasi Hapus Status Dan Komentar 
</div><br />
<div id="wall_container">
<div id="content">
  <?php include('buka_status_admin.php'); ?>
</div>
</div>
</div>
</div>
</body>
</html>
