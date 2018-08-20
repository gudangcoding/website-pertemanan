<?php
include_once '../include/db.php';
include_once 'cek_sesi_admin.php';

// id member yang ingin dihapus
$id_member=$_POST['id_mem'];

// jika tombol "hapus member ini" diklik
if($_POST['hapus_member']) {
  // hapus member dari semua pertemanan 
  $query_user=mysql_query("SELECT * FROM user");
  while($row=mysql_fetch_array($query_user)){
    $uid=$row['uid'];
    $array_teman = $row["array_teman"];
    $arrayTeman = explode(",", $array_teman);
    // cek apakah member yang ingin dihapus ada
    if (in_array($id_member, $arrayTeman)) { 
	    // jika ada, hapus member array dengan fungsi unset
			foreach ($arrayTeman as $key => $value) {
			  if ($value == $id_member) {
			      unset($arrayTeman[$key]);
				} 
  		}
	  // gabungkan array member kembali setelah menghapus user dari pertemanan
	  $stringArrayBaru = implode(",", $arrayTeman);
	  $sql = mysql_query("UPDATE user SET array_teman='$stringArrayBaru' WHERE uid='$uid'");
	  }
	  
    // hapus semua status dari member yang telah dihapus 
    $query = mysql_query("DELETE FROM `status` WHERE uid_fk='$id_member'");

    // hapus semua komentar dari member yang telah dihapus 
    $query = mysql_query("DELETE FROM `komentar` WHERE uid_fk='$id_member'");

    // hapus member dari tabel user
    mysql_query("DELETE FROM user WHERE uid='$id_member'");
?>
<script language="javascript">
		alert("Member Telah Dihapus");
		document.location="administrator.php";
</script>
<?php 
  }
}
?>
