$(document).ready(function() {
// Update Status
$("#update_button").click(function() {
  var updateval = $("#update").val();
  var id_dinding = $("#id_dinding").val();
  var image_url = $('#ajax_image_url').val();
  var dataString = 'update='+ updateval + '&id_dinding='+ id_dinding + '&image_url='+ image_url;
  if(updateval=='') {
    alert("Status Harus Di isi");
  }
  else {
    $("#flash").show();
    $("#flash").fadeIn(400).html('Loading Update...');
    $.ajax({
      type: "POST",
      url: "status_ajax.php",
      data: dataString,
      cache: false,
      success: function(html) {
        $("#showthumb").html("");
        $("#flash").fadeOut('slow');
        $("#content").prepend(html);
        $("#update").val('');	
        $('#bukafoto').fadeOut('slow');
        $("#update").focus();
        $("#stexpand").oembed(updateval);
      }
    });
  }
  return false;
});

// Update Foto 
$('#photoimg').livequery('change', function(){ 
  $("#showthumb").html('');
  $("#showthumb").html('<img src="images/loaders.gif" alt="Uploading...."/>');
  $('#bukafoto').fadeOut('slow');
	$("#frmUpload").ajaxForm({ target: '#showthumb' }).submit();
});

// Tampilkan 10 posting berikutnya ketika mengklik link "show more post" pada Halaman Home
$('.load_more_home').livequery("click",function(e) {
  var statusakhir = $(this).attr("id");
  if(statusakhir!='end'){
    $.ajax({
      type: "POST",
      url: "buka_status.php",
      data: "statusakhir="+ statusakhir, 
      beforeSend:  function() {
        $('a.load_more').append('<img src="images/facebook_style_loader.gif" />');  
      },
      success: function(html){
        $('#paging').remove();
	      $('#content').append($(html).fadeIn('slow'));
      }
    });
  }
  return false;
});

// Tampilkan 10 posting berikutnya ketika mengklik link "show more post" pada Halaman Profil
$('.load_more').livequery("click",function(e) {
  var statusakhir = $(this).attr("id");
  var id_dinding = $("#id_dinding").val();
  if(statusakhir!='end'){
    $.ajax({
      type: "POST",
      url: "buka_status_profil.php",
      data: "statusakhir="+ statusakhir + "&id_dinding=" + id_dinding, 
      beforeSend:  function() {
        $('a.load_more').append('<img src="images/facebook_style_loader.gif" />');
      },
      success: function(html){
        $('#paging').remove();
	      $('#content').append($(html).fadeIn('slow'));
      }
    });  
  }
  return false;
});

// Toggle upload foto
$('#klikfoto').click(function() {
	$("#photoimg").attr({ value: '' });
	$('#bukafoto').slideToggle();
	return false;
});
	
// Update Komentar
$('.comment_button').live("click",function() {
  var ID = $(this).attr("id");
  var komentar= $("#ctextarea"+ID).val();
  var dataString = 'komentar='+ komentar + '&idstatus=' + ID;
  if(komentar==''){
    alert("Silahkan isi dulu komentarnya");
  }
  else{
    $.ajax({
      type: "POST",
      url: "komentar_ajax.php",
      data: dataString,
      cache: false,
      success: function(html){
        $("#commentload"+ID).append(html);
        $("#ctextarea"+ID).val('');
        $("#ctextarea"+ID).focus();
      }
    });
  }
  return false;
});

// Buka Komentar
$('.commentopen').live("click",function() {
  var ID = $(this).attr("id");
  $("#commentbox"+ID).slideToggle('slow');
  return false;
});	

// Komentar Collapse
$('.commentcoll').live("click",function() {
  var ID = $(this).attr("id");
  $("#commentboxall"+ID).slideDown('slow');
  $("#commentboxfirst"+ID).remove();
  $("#collapse"+ID).remove();
  return false;
});

// Hapus komentar
$('.stcommentdelete').live("click",function() {
  var ID = $(this).attr("id");
  var dataString = 'idkom='+ ID;
  if(confirm("Apakah Anda yakin akan menghapus Komentar?")){
    $.ajax({
      type: "POST",
      url: "hapus_komentar_ajax.php",
      data: dataString,
      cache: false,
      success: function(html){
        $("#stcommentbody"+ID).slideUp();
      }
    });
  }
  return false;
});

// Hapus status
$('.stdelete').live("click",function() {
  var ID = $(this).attr("id");
  var dataString = 'idstatus='+ ID;
  if(confirm("Apakah Anda yakin akan menghapus Status ini?")){
    $.ajax({
      type: "POST",
      url: "hapus_status_ajax.php",
      data: dataString,
      cache: false,
      success: function(html){
        $("#stbody"+ID).slideUp();
      }
    });
  }
  return false;
});
});
