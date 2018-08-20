           <?php
include_once 'include/db.php';
include_once 'include/cek_sesi.php';

if($_POST['hapus_button']) {
	$cek = $_POST['cek'];
	//Hitung jumlah yang dicek (dihapus)
	$jumlah=count($cek);
	if ($jumlah==0){
	?>
  <script language="javascript">
			alert("Centang dulu pesan yang mau dihapus");
			document.location="inbox.php";
	</script>
  <?php 
	}
	// Looping delete sebanyak jumlah yang di cek
	for($i=0;$i<$jumlah;$i++) {
	mysql_query("DELETE FROM pesan WHERE id='$cek[$i]'");
	?>
  <script language="javascript">
			alert("Pesan Sudah Dihapus");
			document.location="inbox.php";
	</script>
  <?php 
	}
}
?>
