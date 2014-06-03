<?php 
session_start();

$_SESSION['menu']=-1;

?>

<?php
//addconnection
include("../connection/connection.php");
$sql_new = "SELECT * FROM `deal` ORDER BY dealid DESC";

$stat_new = $pdo->prepare($sql_new);

$stat_new->execute();


$sql_new2 = "SELECT * FROM `deal` ORDER BY saving DESC";

$stat_new2 = $pdo->prepare($sql_new2);

$stat_new2->execute();

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--title-->
    <title>Just Buy</title>
    <?php include("../template/header.php"); ?>     
    
    	<script>
	$(function() {
	$(".delbutton").click(function(){
		//Save the link in a variable called element
		var element = $(this);
		$( "#dialog" ).dialog({
			resizable: false,
			height:165,
			modal: true,
			buttons: {
				"Delete this deal": function() {
					
					
					//Find the id of the link that was clicked
					var del_id = element.attr("id");
					
					//Built a url to send
					var info = 'id=' + del_id;
					$.ajax({
					type: "GET",
					url: "../process/deletedeal.php",
					data: info,
					success: function(){
					
					}
					});
					element.parents(".record").animate({ backgroundColor: "#e5edfc" }, "fast")
					.animate({ opacity: "hide" }, "slow");
					$( this ).dialog( "close" );

					
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});
		});
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
          <h1><a href="#" class="h1">Newest</a></h1>
          
          <div class="ctop"></div>
          
          <!--newest deals-->
          <div class="deals">
            
            <!--first newest deal-->            
            <?php 
			$i=0;
			while($row_new = $stat_new->fetch()){
			$id = $row_new["dealid"];  
			$name = $row_new["dealname"];  
			$description = $row_new["description"];
			$originalprice = $row_new["originalprice"];
			$groupprice = $row_new["groupprice"];
			$saving = $row_new["saving"];
			$currentbuyers = $row_new["currentbuyers"];
			$maxbuyers = $row_new["maxbuyers"];
			$available = $maxbuyers - $currentbuyers;
			$images = $row_new["images"];
			?>
                      <!--pic & discount-->            
            <?php
		   $imgLink = explode("*", $images);
		   $img = $imgLink[0];
		   ?>
            <img src="<?php echo $img ?>" width="641" height="222" alt=""/>
            <div class="discount2"><p><?php echo $saving ?>%</p></div>
            
            <!--left content-->            
            <div class="left">
              <h2><a href="../layout/dealdetails.php?id=<?php echo $id ?>" class="h2"><?php echo $name ?></a></h2>
              <p><?php echo substr($description,0,251) ?></p>
            </div>
            
            <!--right content-->            
            <div class="right">
              <p><span class="label">Price:</span><span class="text">$<?php echo $groupprice ?></span></p>
              <p><span class="label">Original:</span><span class="text">$<?php echo $originalprice ?></span></p>
              <p><span class="label">Available:</span><span class="text"><?php echo $available ?> / <?php echo $maxbuyers ?></span></p>
              <div class="clearfloat3"></div>
             <p>
              
              <?php if($isUser==1){ ?>
              <a href="../layout/updatedeal.php?id=<?php echo $id ?>" class="details">Update</a>
              <input type="button" id="<?php echo $id; ?>" onclick="deleteD()" class="delbutton" value="Delete"/>
              <?php }
			  else{
			  ?>
              <a href="order.php?id=<?php echo $id ?>" class="details">Buy</a>
              <?php }?>
              
               </p>
            </div>
            
            <div class="clearfloat"></div>
            <div class="hr2"></div> 
            
            <?php 
			$i++;
			if($i>=2) break;
			}?>
            <!--see more--> 
            <a href="../layout/deals.php?id=new" class="more">See more...</a>
          
          <!-- end .deals --></div>
          
          <div class="cbot"></div>
          
          <!--div 2: Hottest-->
          <!--heading-->
          <h1><a href="#" class="h1">Hottest</a></h1>
          
          <div class="ctop"></div>
          
          <!--hottest deals-->
          <div class="deals">
          
<!--first newest deal-->            
            <?php 
			$i=0;
			while($row_new2 = $stat_new2->fetch()){
			$id = $row_new2["dealid"];  
			$name = $row_new2["dealname"];  
			$description = $row_new2["description"];
			$originalprice = $row_new2["originalprice"];
			$groupprice = $row_new2["groupprice"];
			$saving = $row_new2["saving"];
			$currentbuyers = $row_new2["currentbuyers"];
			$maxbuyers = $row_new2["maxbuyers"];
			$available = $maxbuyers - $currentbuyers;
			$images = $row_new2["images"];
			?>
		   <?php
           $imgLink = explode("*", $images);
           $img = $imgLink[0];
           ?>
            <img src="<?php echo $img ?>" width="641" height="222" alt=""/>
            <div class="discount2"><p><?php echo $saving ?>%</p></div>
            
            <!--left content-->            
            <div class="left">
              <h2><a href="../layout/dealdetails.php?id=<?php echo $id ?>" class="h2"><?php echo $name ?></a></h2>
              <p><?php echo substr($description,0,251) ?></p>
            </div>
            
            <!--right content-->            
            <div class="right">
              <p><span class="label">Price:</span><span class="text">$<?php echo $groupprice ?></span></p>
              <p><span class="label">Original:</span><span class="text">$<?php echo $originalprice ?></span></p>
              <p><span class="label">Available:</span><span class="text"><?php echo $available ?> / <?php echo $maxbuyers ?></span></p>
              <div class="clearfloat3"></div>
             <p>
              
              <?php if($isUser==1){ ?>
              <a href="../layout/updatedeal.php?id=<?php echo $id ?>" class="details">Update</a>
              <input type="button" id="<?php echo $id; ?>" onclick="deleteD()" class="delbutton" value="Delete"/>
              <?php }
			  else{
			  ?>
              <a href="order.php?id=<?php echo $id ?>" class="details">Buy</a>
              <?php }?>
              
               </p>
            </div>
            
            <div class="clearfloat"></div>
            <div class="hr2"></div> 
            
            <?php 
			$i++;
			if($i>=3) break;
			}?>
            <!--see more--> 
            <a href="../layout/deals.php?id=hot" class="more">See more...</a>            
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
