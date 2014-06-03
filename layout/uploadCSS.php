<?php 
session_start();
$_SESSION['menu']='uploadCSS';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--title-->
    <title>Just Buy</title>

	<?php include("../template/header.php"); ?>
<!-- Uploadify -->
    <script type="text/javascript" src="../uploadify/jquery.uploadify.v2.1.4.js"></script>
    <script type="text/javascript" src="../uploadify/swfobject.js"></script>

	<script type="text/javascript">
    $(document).ready(function() {		
      $('#file_upload').uploadify({
        'uploader'  : '../uploadify/uploadify.swf',
        'script'    : '../uploadify/uploadify.php',
        'cancelImg' : '../uploadify/cancel.png',
        'folder'    : '../images/',
		'buttonImg' : '../images/browse.png',
		'width' : 140,
		'height' : 35,
		'fileExt'     : '*.css',
		'fileDesc'    : 'Style Sheet',
		'queueSizeLimit' : 3,
		'queueID'        : 'queue',
        'auto'      : true,
		'simUploadLimit' : 2,
		'multi'     : true,
		'onComplete': function(event, ID, fileObj, response, data) {
			$('#queue').append('<div style="display:table-row; "><div style="display:table-cell;width:250px; overflow:hidden;color:#0a4895; font-size:1.1em; padding:5px 10px;">'+fileObj.name+'</div><div style="display:table-cell; padding:5px 10px;"><img align="bottom" src="../images/check.png"/></div></div>');
                $('#uploadCSSForm').append('<input style="display:none" type="text" name="themeLink" value="'+response+'"/>');
            }
      });
	  
	  $('.uploadCSSBtn').click(function(){
		  var info = $('#uploadCSSForm').serialize(); 
		  $.ajax(
		  {
			type: "POST",
			url: "../process/uploadCSSAction.php",
			data: info,
			success: function(data, textStatus, jqXHR){
				window.location.href = 'uploadCSS.php';
			}
		  }
		  )
	  });
    });
    </script>
    <script>
    $(function(){
		$("#themeD").css("background-image","url(../images2/m2.png)");
		$("#addD").css("background-image","url(../images2/m1.png)");
		$('#catList').fadeIn(400).load('../process/viewCSSFiles.php');	
	});
    
    </script>

  </head>
  
  <body onload="heightdv()">

  <!--container-->
    <div class="container">
    
      <!--top-->    
	  <?php include("../template/top.php"); ?>
      
      <!--header--> 
	  <?php include("../template/logo.php"); ?>
      
      <!--wrapper--> 
      <div id="wrapper">      
      
        <!--menu--> 
        <?php include("../template/menu.php"); ?>
        <!--banner--> 
       <?php include("../template/banner.php"); ?>        
        <!--sidebar--> 
        <?php include("../template/sidebar.php"); ?>
        
        <!--content-->
        <div class="content">
        
          <!--div 1: Newest-->
          <!--heading-->
          <h1><a href="#" class="h1">Theme</a></h1>
          
          <div class="ctop"></div>
          
          <!--deals-->
          <div class="deals">
          <div class="clearfloat2"></div>
          <div class="catContainer">
          <div class="validate"></div>
		<div class="clearfloat"></div>          
          <!--add deal form-->
		  <form id="uploadCSSForm" action='' method='POST'>
          <p><input type="file" id="file_upload" name="file_upload" style="float:left; width:100px; margin-top:10px; margin-left:10px;"/></p>
          <div id="queue" style="width:300px; position:relative; left:300px; top:-70px;"></div>
          		<div class="clearfloat"></div>          
          <p><label style="display:inline; font-size:1.2em; margin-top:7px; margin-right:5px; float:left;">CSS Name:</label><input type='text' name='themeName' id="catNameTxt"/></p>
          <div class="clearfloat"></div> 
          <p><input type='button' value='Upload CSS' style="float:left; margin-left:315px;" class="uploadCSSBtn" id="addCatBtn"/></p>
          </form>
          
          <div class="clearfloat"></div>
		  <div class="hr2" style="margin-left:0;"></div>
          
          <div id="catList"></div>
          
          <div class="clearfloat"></div>
          </div>
          <!-- end .deals --></div>
          
          <div class="cbot"></div>
          
        <!-- end .content --></div>
        
      <!-- end .wrapper --></div>
      <!--footer--> 
      <?php include("../template/footer.php"); ?>
      <div class="clearfloat"></div>
    <!-- end .container --></div>
    
  <!--extra nav-->
  <?php include("../template/extranav.php"); ?>
  
  <!--cufon for IE-->
  <script>Cufon.now();</script> 
  </body>
</html>
