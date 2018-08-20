$(document).ready(function() 
{
// Hapus status
$('.stdelete').live("click",function() 
{
var ID = $(this).attr("id");
var dataString = 'idstatus='+ ID;

if(confirm("Apakah anda yakin akan menghapus status ini!"))
{
$.ajax({
type: "POST",
url: "hapus_status_ajax_admin.php",
data: dataString,
cache: false,
success: function(html){
 $("#stbody"+ID).slideUp();
 }
 });
}
return false;
});

// Hapus komentar
$('.stcommentdelete').live("click",function() 
{
var ID = $(this).attr("id");
var dataString = 'idkom='+ ID;

if(confirm("Apakah anda yakin akan menghapus komentar?!"))
{

$.ajax({
type: "POST",
url: "hapus_komentar_ajax_admin.php",
data: dataString,
cache: false,
success: function(html){
 $("#stcommentbody"+ID).slideUp();
 }
 });

}
return false;
});
	
//tampilkan 10 posting berikutnya ketika mengklik link "show more post" pada halaman admin
$('.load_more_admin').livequery("click",function(e) {
var statusakhir = $(this).attr("id");
if(statusakhir!='end'){
$.ajax({
type: "POST",
url: "buka_status_admin.php",
data: "statusakhir="+ statusakhir, 
beforeSend:  function() {
$('a.load_more').append('<img src="../images/facebook_style_loader.gif" />');
  
},
success: function(html){
    $('#paging').remove();
	$('#content').append($(html).fadeIn('slow'));

}
});
  
}
return false;

});
});