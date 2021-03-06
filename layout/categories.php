<?php 
session_start();
$_SESSION['menu']=-3;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--title-->
    <title>Just Buy</title>

	<?php include("../template/header.php"); ?>
    <script type="text/javascript" >
	$(function(){
		$("#catD").css("background-image","url(../images2/m2.png)");
		
		$('#catList').fadeIn(400).load('../process/viewcategories.php');
		});
	function addCat() {
		
		$.ajax({
		type: "POST",
		url: "../process/addcategoryaction.php",
		data: "scategoryname="+$("#catNameTxt").val(),
		cache: false,
		 success: function(html){
                if(html=='true')
                {
					 $(".validate").hide();
					$('#catList').fadeIn(400).load('../process/viewcategories.php');

                }
                else
                {
					 $(".validate").show();
                    $(".validate").html("This category is already existing. Please choose another one");
                }
            },
		});
		
	
	}
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
          <h1><a href="#" class="h1">Categories</a></h1>
          
          <div class="ctop"></div>
          
          <!--deals-->
          <div class="deals">
          <div class="clearfloat2"></div>
          <div class="catContainer">
          <div class="validate"></div>
		<div class="clearfloat"></div>          
          <!--add deal form-->
		  <form action='../process/addcategoryaction.php' method='POST'>
          <input type='text' name='scategoryname' id="catNameTxt"/>
          <input type='button' onclick="addCat()" value='Add Category' id="addCatBtn"/>
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
