<?php 
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--title-->
    <title>Just Buy</title>

	<?php include("../template/header.php"); ?>

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
          <h1><a href="#" class="h1">Sorry</a></h1>
          
          <div class="ctop"></div>
          
          <!--deals-->
          <div class="deals">
          <div class="clearfloat2"></div>
          <div>
          You cannot perform this action. Please Login!
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
