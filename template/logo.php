<?php
//addconnection
include("../connection/connection.php");
$themeSql = "select * from theme";
$themeResult = $pdo->query($themeSql);
?>

<div class="header">
<a href="../index.php"><img src="../images2/logo.png" alt="jBuy" width="135" height="55" name="jBuy" id="jBuy"/></a> 
<select id="theme">
<option value="../style/style.css">Choose Theme</option>
<?php
while($themeRow = $themeResult->fetch()){
	$themeName = $themeRow[1];
	$themeLink = $themeRow[2];
?>
<option id="<?php echo $themeName?>" value="<?php echo $themeLink?>"><?php echo $themeName ?></option>

<?php }?>
</select>
<!-- end .header --></div>
<style>

</style>

<script src="../js/jquery.cookie.js"></script>
<script>
$(function(){
if($.cookie("css")) {
    $("#pageStyle").attr("href",$.cookie("css"));
}

$('#theme').change(function(){
		$('#pageStyle').attr("href",$(this).val());
        $.cookie("css",$(this).val(), {expires: 365, path: '/'});
		$.cookie("cssName",$(this).attr("id"), {expires: 365, path: '/'});
});

});
</script>