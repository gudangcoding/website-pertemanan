<p id="searchresults">
<?php
include_once 'include/db.php';
		// Apakah string sudah terisi
		if(isset($_POST['queryString'])) {
			$queryString = mysql_real_escape_string($_POST['queryString']);
			
			// Apakah panjang string lebih dari 0?
			if(strlen($queryString) > 0) {
				$query = mysql_query("SELECT * FROM user 
                 WHERE nama LIKE '%" . $queryString . "%' 
                 ORDER BY uid LIMIT 8");				
				if($query) {
					while($row = mysql_fetch_array($query)) {
	         	echo '<a href="profile.php?id='.$row['uid'].'">';
						
						if ($row['gambar_profil_kecil'] != NULL ){
              echo '<img src="member/'.$row['uid'].'/'.$row['gambar_profil_kecil'].'" alt="" width="40" height="40" />';
            }
						else {
						  echo '<img src="images/default.png" alt="" width="40" height="40" />';							
						}
	         	$nama = $row['nama'];
	         	if(strlen($name) > 35) { 
	         		$nama = substr($nama, 0, 35) . "...";
	         	}	         			
	         	echo '<span class="searchheading">'.$nama.'</span></a>';
	        }
				} 
        else {
					echo 'ERROR: Ada kesalahan pada Query.';
				}
			} 
		} 
?>
</p>
