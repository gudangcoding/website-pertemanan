<?php
session_start();
include_once 'include/db.php';
define('INCLUDE_CHECK',1);

// Jika user ingin login
if(isset($_POST['login'])) {
  $emaila=htmlentities((trim($_POST['emaila'])));
  $passa=htmlentities(md5($_POST['passa']));
  $result = mysql_query("SELECT uid FROM user WHERE email = '$emaila' and password='$passa'");
  $user_data = mysql_fetch_array($result);
  $data_ada = mysql_num_rows($result);
	if ($data_ada == 1){
		$_SESSION['uid'] = $user_data['uid'];
		// Login sukses
		header("location: home.php");
	}
	else{
	// Login gagal
	?>
  <script language="javascript">
			alert("Maaf, Username atau Password Anda salah!!");
			document.location="index.php";
	</script>
  <?php  
	}
}
?>

<html>
<head>
<title>Website Pertemanan - Lokomedia</title>
<link href="css/login.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery.1.4.2.min.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<body>
<div class="topbar">
<div class="logo" id="logo" align="left"><br /><br />
  <img src='images/logo.png' />
</div>
<div class="login" id="login" align="right">
  <form id="regForm2" method="post">
  <table align="left" style="color:#FFFFFF">
  <tbody>
  <tr>
    <td align="left"><label>Email:</label></td>
    <td align="left"><label>Password:</label></td>
  </tr>
  <tr>
    <td><div class="input-container"><input name="emaila" id="emaila" type="text" /></div></td>
    <td><div class="input-container"><input name="passa" id="passa" type="password" /></div></td>
    <td><input type="submit" name="login" class="greenButton" value="Login" /></td>
  </tr>
  </table>
  </form> 
</div><br /><br />
</div>

<div id="wrap">
<div id="sidebar">
TemanKita Membantu Anda terhubung dan berbagi dengan orang-orang dalam kehidupan Anda
<div id="map"></div>
</div>

<div id="main">
<div id="div-regForm">
<div class="form-title" align="left">Mendaftar</div>
<div class="form-sub-title" align="left">Gratis dan siapapun bisa ikut bergabung</div>
<form id="regForm" method="post">
<table>
  <tbody>
  <tr>
    <td><label for="name">Nama Anda:</label></td>
    <td><div class="input-container"><input name="nama" id="nama" type="text" /></div></td>
  </tr>
  <tr>
    <td><label for="email">Email Anda:</label></td>
    <td><div class="input-container"><input name="email" id="email" type="text" /></div></td>
  </tr>
  <tr>
    <td><label for="pass">Password:</label></td>
    <td><div class="input-container"><input name="pass" id="pass" type="password" /></div></td>
  </tr>
  <tr>
    <td><label for="gender">Gender:</label></td>
    <td>
    <div class="input-container">
    <select name="gender" id="gender">
    <option value="0">Pilih Gender:</option>
    <option value="1">Laki-Laki</option>
    <option value="2">Perempuan</option>
    </select>
    </div>    
    </td>
  </tr>
  <tr>
    <td><label>Tanggal Lahir:</label></td>
    <td><div class="input-container">
	  <?php
	    // Tampilkan pilihan tanggal dari 1 s/d 31 pada ComboBox
      echo "<select name=tgl id=tgl><option value=0>Tanggal:</option>";
	    for($tgl=1; $tgl<=31; $tgl++) {
      	echo "<option value=$tgl>$tgl</option>";
	    }
	    echo "</select>";

	    // Tampilkan pilihan bulan dalam format Indonesia pada ComboBox
	    $nama_bln=array(1=>"Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agt","Sep","Okt","Nov","Des");
	    echo "<select name=bulan id=bulan>
	          <option value=0>Bulan:</option>";
 	    for ($bln=1; $bln<=12; $bln++) {
	       echo "<option value=$bln>$nama_bln[$bln]</option>";
	    }
	    echo "</select>";
	
	    // Tampilkan pilihan tahun dari 1970 s/d saat ini pada ComboBox
	    $thn_sekarang=date("Y");
	    echo "<select name=tahun id=tahun><option value=0>Tahun:</option>";
	    for($thn=1970; $thn<=$thn_sekarang;$thn++) {
	       echo "<option value=$thn>$thn</option>";
	    }
	    echo "</select>";
	  ?>
    </div>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="register" class="greenButton" value="Sign Up" />
    <img id="loading" src="images/ajax-loader.gif" alt="working.." />
    </td>
  </tr>
  </tbody>
</table>
</form>

<div id="error">&nbsp;</div>
</div>
			</div>
	</div>
 	</div>

<br clear="all" /><br clear="all" /><br clear="all" />
<br clear="all" />			  
</body>
</html>
