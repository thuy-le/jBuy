<?php 
//add connection
include("../connection/connection.php");

//declare avriables
$name = "";
$description = "";
$originalprice = 0;
$groupprice = 0;
$saving = 0;
$currentbuyers = 0;
$maxbuyers = 0;
$status = 0;
$categoryid = 0;
$cId=0;

session_start();
if(isset($_GET["id"])){
$cId = $_GET["id"];

if($_GET["id"]=='new')
{
	$sql = "SELECT * FROM `deal` ORDER BY dealid DESC";	
	$statement = $pdo->prepare($sql);
	$head = "Newest Deals";
	$_SESSION['menu']=0;
}

else if($_GET["id"]=='hot')
{
	$sql = "SELECT * FROM `deal` ORDER BY saving DESC";	
	$statement = $pdo->prepare($sql);
	$head = "Hottest Deals";
	$_SESSION['menu']=0;
}

else if($_GET["id"]=='revenue')
{
	$sql = "SELECT dealid, dealname, description, conditions, originalprice, groupprice, saving, currentbuyers, maxbuyers, expiredtime, status, categoryid, images, thumb, (groupprice*currentbuyers) as revenue FROM `deal` ORDER BY revenue DESC";	
	$statement = $pdo->prepare($sql);
	$head = "Best Revenue";
	$_SESSION['menu']=0;
}

else if($_GET["id"]=='mostwanted')
{
	$sql = "SELECT * FROM `deal` ORDER BY currentbuyers DESC";	
	$statement = $pdo->prepare($sql);
	$head = "Most Wanted";
	$_SESSION['menu']=0;
}

else{
//check if there is a specific category
$categoryid = $_GET["id"];
$_SESSION['menu']=$categoryid;
//select all deals from the category
$sql = "select * from deal where categoryid = :category";
$statement = $pdo->prepare($sql);
$statement->bindValue("category", $categoryid);

//get + set category name
$c_sql = "select * from category where categoryid = :category";
$c_stat = $pdo->prepare($c_sql);
$c_stat->bindValue("category", $categoryid);
$c_stat->execute();
$c_row = $c_stat->fetch();
$head = $c_row["categoryname"];
}
}

else{	
	//selct all deals
	$sql = "select * from deal ORDER BY dealname";
	$statement = $pdo->prepare($sql);
	
	//set category name
	$head = "All deals";
	$_SESSION['menu']=0;
}

$statement->execute();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--title-->
    <title>Just Buy</title>
	<?php include("../template/header.php"); ?>

    <script type="text/javascript" src="../js/paging.js"></script>

	<script type="text/javascript">
    $(document).ready(function() { 
    $("ul.paging").quickPager();   
    $("ul.paging2").quickPager({pagerLocation:"both"});
    });
    </script>

    
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
        
        <?php 
		if($isUser!=1)
		include("../template/sidebar.php"); 
		else{
		?>
        
        <!--side bar for admin-->
        
        <script>
		$(function(){
		  $("#allD").css("background-image","url(../images2/m2.png)");
		  $("#cats .subMenu").css("cursor","pointer");
		  
		  $("#sidebar1").css({
			"background-image" : "none",
			"background-color" : "transparent"
		  });
		  
		  
		  
		  $("#allD").click(function(e){
			  $('.subMenu').css("color","#061d7f"),
			  $("#allD").css("background-image","url(../images2/m1.png)"),
			  $("#cats").slideToggle(),
			  $(this).css("background-image","url(../images2/m2.png)"),
			  $(".content").load("../process/viewDeals.php"),
			  e.preventDefault();
		  });
		  
		  $(".subMenu").click(function(e){
			  var sid = $(this).attr("id");
			  $(".subMenu").css("color","#061d7f"),
			  $("#allD").css("background-image","url(../images2/m1.png)"),
			  $(this).css("color","#7f0606"),
			  $(".content").load("../process/viewDeals.php?id="+sid),
			  e.preventDefault();
		  });
		});
        </script>
		<div id="sidebar1">
        
        <div class='sDiv'>
        <a class='sidebarLink'  id='addD' href='adddeal.php'>Add New Deal</a>
        </div>
        <div class='sDiv' id='allD'>
        <a class='sidebarLink' href='#'>All Deals</a>
        </div>	
		<div class="clearfloat"></div>
		<div id="cats">
		<?php        
        $catsql = "select * from category ORDER BY categoryid ASC";
        $cat_stat = $pdo->prepare($catsql);
        $cat_stat->execute();
        
        while($catrow = $cat_stat->fetch()){
        $catid = $catrow["categoryid"];
        $catname = $catrow["categoryname"];
        ?>	      
        
        <div class="subMenu" id="<?php echo $catid; ?>">
        <?php echo $catname ?>
        </div>
		
		<?php	
		}
		?>
        <div class="subMenu" id="revenue">
        Best revenue
        </div>
        <div class="subMenu" id="hot">
        Best savings
        </div>
        <div class="subMenu" id="mostwanted">
        Most Wanted
        </div>        
        <div class="subMenu" id="new">
        Newest
        </div>
        
        </div>
        <div class='sDiv' id='catD'>
        <a class='sidebarLink' href='../layout/categories.php'>Manage Category</a>
        </div>	
        <div class='sDiv' id='userD'>
        <a class='sidebarLink' href='../layout/users.php'>Manage Users</a>
        </div>
        <div class='sDiv' id='passD'>
        <a class='sidebarLink' href='../layout/changePassword.php'>Change Password</a>
        </div>	
        <div class='sDiv' id='themeD'>
        <a class='sidebarLink' href='../layout/uploadCSS.php'>Theme</a>
        </div>	
        </div>
        <?php
		}
		?>
        
        <!--content-->
        <div class="content">
        
          <!--div 1: Newest-->
          <!--heading-->
          <h1><a href="#" class="h1"><?php echo $head ?></a></h1>
          
          <div class="ctop"></div>
          
          <!--deals-->
          <div class="deals">
          
          <ul class="paging">
          <?php
		  while($row = $statement->fetch()){
			$id = $row["dealid"];  
			$name = $row["dealname"];  
			$description = $row["description"];
			$originalprice = $row["originalprice"];
			$groupprice = $row["groupprice"];
			$saving = $row["saving"];
			$currentbuyers = $row["currentbuyers"];
			$maxbuyers = $row["maxbuyers"];
			$status = 0;
			$categoryid = 0;
			$available = $maxbuyers - $currentbuyers;
			$images = $row["images"];
			$total = $currentbuyers*$groupprice;
		  ?>
          <li>
          <div class="record">
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
              <?php if($isUser==1){ ?>
              <p><span class="label">Sold:</span><span class="text"><?php echo $currentbuyers ?></span></p>
              <p><span class="label">Revenue:</span><span class="text"><?php echo $total ?></span></p>
              <?php }?>
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
           </div>
           </li>
          <?php
		  }
		  ?>
          
         </ul>
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
  
      <script type="text/javascript">
	var pager = new Imtech.Pager();
	$(document).ready(function() {
		pager.paragraphsPerPage = 5; // set amount elements per page
		pager.pagingContainer = $(".deals"); // set of main container
		pager.paragraphs = $('div.record', pager.pagingContainer); // set of required containers
		pager.showPage(1);
	});
	</script>
  
  <!--cufon for IE-->
  <script>Cufon.now();</script> 
  </body>
</html>

<?php 
if($isUser==1){
?>

<script>
$('.menu').hide();
$('.desc').hide();
</script>

<?php }?>