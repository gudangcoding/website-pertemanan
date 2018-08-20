<?php
session_start();
include_once 'include/db.php';
include_once 'include/cek_sesi.php';
$uid=$_SESSION['uid'];
$path = "member/$uid/"; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Website Pertemanan - Lokomedia</title>
<link href="css/dinding.css" rel="stylesheet" type="text/css">
<link href="css/imgareaselect-default.css" rel="stylesheet" type="text/css"  />
<script type="text/javascript" src="js/jquery.1.4.2.min.js"></script>
<script type="text/javascript" src="js/wall.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
<style type="text/css">
body {
	background-image: url(images/NewPicture.jpg);
	background-repeat: repeat-x;
}
.style1 { font-weight: bold} 
</style>
<script type="text/javascript">
function getSizes(im,obj){
		var x_axis = obj.x1;
		var x2_axis = obj.x2;
		var y_axis = obj.y1;
		var y2_axis = obj.y2;
		var thumb_width = obj.width;
		var thumb_height = obj.height;
		if(thumb_width > 0){
				if(confirm("Apakah Anda akan menyimpan thumbnail gambar ini?")){
						$.ajax({
							type:"GET",
							url:"gambar_profil_ajax.php?t=ajax&img="+$("#image_name").val()+"&w="+thumb_width+"&h="+thumb_height+"&x1="+x_axis+"&y1="+y_axis,
							cache:false,
							success:function(response){
								 $("#cropimage").hide();
								 $("#thumbs").html("");
								$("#thumbs").html("<img src='member/"+$("#uid").val()+"/"+response+"' />");
							}
						});
					}
		}
		else
			alert("Pilih dulu pada area gambar!");
}

$(document).ready(function() {
    $('img#photo').imgAreaSelect({
        aspectRatio: '1:1',
        onSelectEnd: getSizes
    });
});
</script>
<?php
$valid_formats = array("jpg", "png", "gif", "bmp");
if(isset($_POST['submit'])){
	$name = $_FILES['photoimg']['name'];
	$size = $_FILES['photoimg']['size'];
			
	if(strlen($name)){
		list($txt, $ext) = explode(".", $name);
		if(in_array($ext,$valid_formats) && $size<(1024*1024)){
			$actual_image_name = time().substr($txt, 5).".".$ext;
			$tmp = $_FILES['photoimg']['tmp_name'];
			if(move_uploaded_file($tmp, $path.$actual_image_name)){
				mysql_query("UPDATE user SET gambar_profil='$actual_image_name' WHERE uid='$uid'");
				$image="<h2>Pilih dan Drag pada Area Gambar</h2>
                <img src='member/$uid/".$actual_image_name."' id=\"photo\" style='max-width:500px'>";
			}
			else
				echo "Gagal";
		}
		else
			echo "Kesalahan Format File..!";					
		}
	else
		echo "Pilih dulu gambarnya..!";
}
?>
</head>
<body>
<div class="main">
 <?php include ('atas.php'); ?>
  <div class="left">
    <div class="propic">
    <?php
    // Ambil gambar profile
    $query_profil = mysql_query("SELECT gambar_profil FROM user WHERE uid='$uid'");
	  $row=mysql_fetch_array($query_profil);
	  if ($row['gambar_profil'] != NULL){
	    @$images = "member/$uid/$row[gambar_profil]";
		}
		else{
		 @$images="images/default.png";
		}
		?>
		<img src="<?php echo $images;?>" class='big_profile' />
	  </div>
    <div class="link style1">
      <p align="right"><a href="profile_photo.php" style="text-decoration:none; color:#2ba314">Edit Profile Pic</a></p>
	 </div>
</div>

 <div class="right">
    <div class="rightleft">
      <div class="list">
</div>

<div id="wall_container">
<div id="content">
<div style="margin:0 auto; width:600px">
<?php echo @$image; ?>
<div id="thumbs" style="padding:5px; width:600px"></div>
<div style="width:600px">
<form id="cropimage" method="post" enctype="multipart/form-data">
	Upload Foto Anda : <input type="file" name="photoimg" id="photoimg" />
	<input type="hidden" name="image_name" id="image_name" value="<?php echo($actual_image_name)?>" />
	<input type="hidden" name="uid" id="uid" value="<?php echo($uid)?>" />
	<input type="submit" name="submit" value="Submit" />
</form>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
