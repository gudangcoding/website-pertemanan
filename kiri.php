<?php
$uid=$_SESSION['uid'];
// Ambil profile id
$member_id = $_GET['id'];
if($uid==$member_id){
	$query = mysql_query("SELECT * FROM `user` WHERE uid='$uid'");
	$row=mysql_fetch_array($query);
}
else {
	$query = mysql_query("SELECT * FROM `user` WHERE uid='$member_id'");
	$row=mysql_fetch_array($query);
}
?>
<ul id="sddm1">
	<li><a href="profile.php?id=<?php echo $row['uid']; ?>" >
      <img src="images/wal.png" width="17" height="17" border="0" /> &nbsp;Wall</a>
	</li><br />
	<li><a href="galeri.php?id=<?php echo $row['uid']; ?>" >
      <img src="images/photos.png" width="16" height="14" border="0" /> &nbsp; Photo</a>
	</li><br />
	<li><a href="daftar_teman.php?id=<?php echo $row['uid']; ?>">
      <img src="images/friends.png" width="18" height="15" border="0" /> &nbsp; Friends</a>
	</li>
</ul>
<div style="clear:both"></div>
<div style="clear:both"></div>