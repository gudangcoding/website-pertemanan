<?php
include_once 'include/db.php';

// Jika user melakukan pendaftaran
$nama     = $_POST['nama'];
$gender   = $_POST['gender'];
$tgl      = $_POST['tgl'];
$bln      = $_POST['bulan'];
$thn      = $_POST['tahun'];
$tanggal  = "$thn-$bln-$tgl";
$email    = $_POST['email']; 
$pass     = $_POST['pass']; 
$password = md5($pass);

// Cek apakah semua field sudah terisi
if(empty($nama) || empty($email) || empty($pass)){
	die(msg(0,"Semua Field Harus Di isi!"));
}

// Apakah sudah memilih gender?
if(!(int)$gender){
	die(msg(0,"Pilih Jenis Kelamin Dulu"));
}

if($gender=="1"){ $jenkel = "Laki-Laki"; }
else{ $jenkel = "Perempuan"; } 

// Apakah sudah memilih tgl lahir?
if(!(int)$tgl || !(int)$bln || !(int)$thn) {
	die(msg(0,"Pilih Tanggal Lahir"));
}

// Apakah email valid?
if(!(preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['email']))) {
	die(msg(0,"Masukkan Alamat Email Yang Benar"));
}

// Cek apakah email sudah pernah terdaftar, kalo belum terdaftar lakukan penyimpanan data user
$sql = mysql_query("SELECT uid FROM user WHERE email='$email'");
$no_rows = mysql_num_rows($sql);

if ($no_rows == 0) {
  $result = mysql_query("INSERT INTO user(password, nama,tgl_lahir,gender, email) 
            VALUES('$password','$nama','$tanggal','$jenkel','$email')");
  $uid = mysql_insert_id();
  mkdir("member/$uid", 0755);
  mkdir("member/$uid/foto", 0755);

  // Registrasi Sukses
  die(msg(1,"Registrasi Berhasil, silahkan Login"));
}
else {
  // Registrasi gagal
  die(msg(1,"Registrasi Gagal, Email sudah terdaftar"));
}

function msg($status,$txt) {
	return '{"status":'.$status.',"txt":"'.$txt.'"}';
}
