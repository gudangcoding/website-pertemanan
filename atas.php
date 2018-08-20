<div class="lefttop1">
    <div class="lefttopleft"><img src="images/logo.png" width="94" height="21" /></div>

    <?php 
	  $permintaan_teman=mysql_query("SELECT * FROM permintaan_teman WHERE mem2='$uid'");
	  $jum_permintaan=mysql_num_rows($permintaan_teman);
    ?>
    <div class="lefttoright">
    <a href="permintaan_teman.php?id=<?php echo $uid; ?>">
    <img src="images/Untitled-1.png" width="15" height="15" border="0" />
    </a>
    <font size="2" color="#990000"><b><?php echo $jum_permintaan; ?></b></font>
    
    <?php 
	  $pesan_baru=mysql_query("SELECT * FROM pesan WHERE id_penerima='$uid' and dibuka='1'");
	  $jum_pesan=mysql_num_rows($pesan_baru);
    ?>
	  <a href="inbox.php?id=<?php echo $uid ; ?>">
    <img src="images/messages.png" width="15" height="15" border="0" /></a>
    <font size="2" color="#990000"><b><?php echo $jum_pesan; ?></b></font>
    </div>
</div>

<div class="righttop1">
    <div class="search">
      <form>
        <input type="text" maxlength="30" id="inputString" onkeyup="lookup(this.value);" class="textfield" />
      </form>
    </div>
    <div id="suggestions"></div>
    <div class="nav">
    <ul id="sddm">
      <li><a href="home.php">Home</a></li>
      <li><a href="profile.php?id=<?php echo $_SESSION['uid']; ?>">Profile</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
    <div style="clear:both"></div>
    <div style="clear:both"></div>
    </div>
</div>