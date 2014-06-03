<?php 
session_start();
//add connection
include("../connection/connection.php");

$name = "";
$description = "";
$conditions = "";
$originalprice = 0;
$groupprice = 0;
$saving = 0;
$currentbuyers = 0;
$maxbuyers = 0;
$expiretime = "";
$status = 0;
$categoryid = 0;

if(isset($_GET["id"])){
$dealid = $_GET["id"];
$sql = "select * from deal where dealid = $dealid";
$result = $pdo->query($sql);
$row = $result->fetch();
$id = $row["dealid"];
$name = $row["dealname"];
$description = $row["description"];
$conditions = $row["conditions"];
$originalprice = $row["originalprice"];
$groupprice = $row["groupprice"];;
$saving = $row["saving"];;
$currentbuyers = $row["currentbuyers"];;
$maxbuyers = $row["maxbuyers"];
$expiretime = $row["expiredtime"];
$status = $row["status"];
$categoryid = $row["categoryid"];
$images = explode("*",$row["images"]);
}

if(isset($_SESSION['menu']))
{
$_SESSION['menu']=$categoryid;
}
else
{
$_SESSION['menu']=$categoryid;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--title-->
    <title>Just Buy</title>
	<?php include("../template/header.php"); ?>
    <script type="text/javascript" src="../js/countdown.js"></script>
    <script src="../js/jqFancyTransitions.1.8.js" type="text/javascript"></script>
    <link rel="stylesheet" href="../style/colorbox.css" />
	<script src="../js/jquery.colorbox.js"></script>    

    <script type="text/javascript">
	  $(document).ready(function() {
		  
		  $("#hiddenDate").hide();
		  var exDate = $("#hiddenDate").text();
		  exDateArr = exDate.split("-");
		  var d = exDateArr[0]+"/"+exDateArr[1]+"/"+exDateArr[2];
		  //alert(d);
			$('#extime').countdown({
			   date: new Date(d),
			   msgNow: 'Expired!!!',
			   msgFormat: '%d [day|days] : %hh %mm %ss',
		  });
		  
		  $('#updateDeal').click(function(){
			  var id = $('#hiddenID').val();
			  window.location = '../layout/updatedeal.php?id='+id;
			  });
		  $('#deleteDeal').click(function(){
			  //Save the link in a variable called element
		var element = $(this);
		$( "#dialog" ).dialog({
			resizable: false,
			height:165,
			modal: true,
			buttons: {
				"Delete this deal": function() {
					
					
					//Find the id of the link that was clicked
					var del_id = $('#hiddenID').val();
					
					//Built a url to send
					var info = 'id=' + del_id;
					$.ajax({
					type: "GET",
					url: "../process/deletedeal.php",
					data: info,
					success: function(){
					alert("Deal deleted");
					window.location = '../layout/deals.php';
					}
					});
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
    
	<script type="text/javascript">
	  $(function(){
	  $('#slideshowHolder').jqFancyTransitions({ width: 641, height: 232, navigation: true, position: 'alternate', direction: 'fountainAlternate' });
	  $(".group4").colorbox({rel:'group4', slideshow:true});
	  });	  
	</script>
    
  </head>
  
  <body onload="heightdv()">
  <div id="dialog" title="Delete deal" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:3px 10px 20px 0;"></span>This deal will be deleted permanently. Are you sure?</p>
</div>
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
        <div id="hiddenDate"><?php echo $expiretime; ?></div>
          <!--div 1: Newest-->
          <!--heading-->
          <h1><a href="#" class="h1"><?php echo $name; ?></a></h1>
          
          <div class="ctop"></div>
          
          <!--newest deals-->
          <div class="deals" style="padding-top:2px;">
          	shdfgk            
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

<input type='text' style="display:none;" id="hiddenID" value="<?php echo $id ?>"/>