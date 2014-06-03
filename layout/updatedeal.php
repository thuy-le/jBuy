<?php 
session_start();
$isUser = $_SESSION['isUser'];
if($isUser==1){
//add connection
include("../connection/connection.php");

$id="";
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
$image = "";

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
$expiretime = explode(" ",$row["expiredtime"]);
$status = $row["status"];
$categoryid = $row["categoryid"];
$images = $row["images"];
}

$sql2 = "select * from category";
$result2 = $pdo->query($sql2);



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

    <?php include("../template/header.php");?>

    
    <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
    

    
    <script>
    function resetF()
	{
		$('#adddeal')[0].reset();
	}
    </script>
    
<!-- markItUp! -->
<script type="text/javascript" src="../markitup/jquery.markitup.js"></script>
<!-- markItUp! toolbar settings -->
<script type="text/javascript" src="../markitup/sets/default/set.js"></script>
<!-- markItUp! skin -->
<link rel="stylesheet" type="text/css" href="../markitup/skins/markitup/style.css" />
<!--  markItUp! toolbar skin -->
<link rel="stylesheet" type="text/css" href="../markitup/sets/default/style.css" />

<script type="text/javascript">
<!--
$(document).ready(function()	{
	// Add markItUp! to your textarea in one line
	// $('textarea').markItUp( { Settings }, { OptionalExtraSettings } );
	$('#description, #condition').markItUp(mySettings);
		
	// And you can add/remove markItUp! whenever you want
	// $(textarea).markItUpRemove();
	$('.toggle').click(function() {
		if ($("#description.markItUpEditor, #condition.markItUpEditor").length === 1) {
 			$("#description, #condition").markItUpRemove();
			$("span", this).text("get markItUp! back");
		} else {
			$('#description, #condition').markItUp(mySettings);
			$("span", this).text("remove markItUp!");
		}
 		return false;
	});
});
-->
</script>

  	<script>
	$(function(){
	var setD = $("#datehidden").text();
	var today = new Date();
	var y = today.getFullYear();
	var m = today.getMonth()+1;
	var d = today.getDate();
	today = y+"-"+m+"-"+d;
	$( "#datepicker" ).datepicker({minDate: today, dateFormat: "yy-mm-dd"});
	$('#datepicker').datepicker('setDate', setD);

	} );   
    </script>

<script>

$(document).ready(function(){

  $('#adddeal').validate({
	//rules
	rules: {
		
	//deal name
	dealname: {
	required: true,
	minlength: 6
	},
	//description
	description: {
	required: true,
	minlength: 20
	},
	//condition
	condition: {
	required: true,
	minlength: 6,
	},		
	//expiredDate
	datepicker: {
	required: true,
	date: 6
	},
	//originalprice
	originalprice: {
	required: true,
	digits:true,
	},
	//groupprice
	groupprice: {
	required: true,
	digits: true,
	},	
	//maxbuyers
	maxbuyers: {
	required: true,
	digits: true,
	},	
	
	},
	
	//custom message
	messages: {
		
	//deal name
	dealname: {
	required: "Please enter a deal name",
	minlength: "Your deal name must be more than 6 characters"
	},
	//condition
	condition: {
	required: "Please enter a condition",
	minlength: "Your condition must be more than 20 characters"
	},
	//description
	description: {
	required: "Please enter a description",
	minlength: "Your description must be more than 6 characters"	
	},
	//expiredate
	datepicker: {
	required: "Please choose an expired date",
	date: "You should input a valid date"	
	},
	//original price
	originalprice: {
	required: "Please input the original price",
	digits: "Original price should be integer"	
	},
	//group price
	groupprice: {
	required: "Please input the group price",
	digits: "Group price should be integer"	
	},
	//max buyers
	maxbuyers: {
	required: "Please input maximun number of buyers allowed",
	digits: "Maximum buyers number should be integer"	
	},
	
	},
	
	//put messages into a box
	errorContainer: "#messageBox",
	errorLabelContainer: "#messageBox",
	wrapper: "li", debug:true,
	
	submitHandler: function(form) { form.submit() }
	
  });


});
</script>


  </head>
  
  <body onload="heightdv()">
  <p id="datehidden" style="display:none;"><?php echo $expiretime[0] ?></p>



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
          <h1><a href="#" class="h1"><?php echo $name; ?></a></h1>
          
          <div class="ctop"></div>
          
          <!--deals-->
          <div class="deals">
          <div class="clearfloat2"></div>
          <form class="adddeal" id="adddeal" method="POST" action="../process/updatedealaction.php" enctype="multipart/form-data">
          <p>
          <label>Deal ID:</label>
          <input type="text" name="dealid" id="dealnametxt" value="<?php echo $id ?>"/>
          </p>
          
          <p>
          <label>Category:</label>
          <select name="categoryid">
          <?php
          while($row2 = $result2->fetch()){
			$catid = $row2["categoryid"];
			$catname = $row2["categoryname"];
			if($catid == $categoryid){
		  ?>
            <option selected="selected" value="<?php echo $catid ?>"><?php echo $catname ?></option>
          <?php  
			}
			else{
		  ?>
            <option value="<?php echo $catid ?>"><?php echo $catname ?></option>
		  <?php }
		  }
		  ?>
          </select>
          </p>

          <p>
          <label>Deal name:</label>
          <input type="text" name="dealname" id="dealnametxt" value="<?php echo $name ?>"/>
          </p>
          <p>
          <label>Image:</label>
          </p>
          <p>
          <?php
		   $imgLink = explode("*", $images);
		   $img = $imgLink[0];
		   ?>
          <img src="<?php echo $img ?>" style="margin-left:0px;" width="628" height="222" alt=""/>
          <div class="clearfloat"></div>
          <p>
          <label>Description:</label>
          <textarea style="resize:none;" name="description" class="required" id="description" cols="80" rows="20"><?php echo $description ?></textarea>  
          </p>
          <p>
          <label>Condition:</label>
          <textarea name="condition" style="resize:none;" class="required" id="condition" cols="80" rows="20"><?php echo $conditions ?></textarea>          
          </p>
          <p>
          <div class="divLeft">
          <label>Original price:</label>
          <input type="text" name="originalprice" class="pricetxt" value="<?php echo $originalprice ?>"/>
          </div>
          <div class="divLeft">
          <label>Group price:</label>
          <input type="text" name="groupprice" class="pricetxt" value="<?php echo $groupprice ?>"/>
          </div>
          </p>
          <div class="clearfloat"></div>
          <p>
          <div class="divLeft">
          <label>Expired Date:</label>
           <input id="datepicker" onmouseover="datepick()" name="datepicker" type="text">
           </div>
           <div class="divLeft">
          <label>Max Buyers:</label>
          <input type="text" name="maxbuyers" id="maxbuyers" value="<?php echo $maxbuyers ?>"/>
          </div>
          </p>
          <div class="clearfloat"></div>
          <p>
          <label>Is Active:</label>
          <?php
		  if($status=1){
		  ?>          
          <input type="checkbox" name="status" checked="checked"/>
		  <?php
		  }
          else{
		  ?>
          <input type="checkbox" name="status" value="yes"/>
          <?php } ?>
          </p>

          <div class="hr2"></div>
          
          <p><input type="submit" name="add" value="Update Deal" class="buynowbtn" id="adddealbtn"/>
          <input type="button" onclick="resetF()" name="add" value="Reset" class="buynowbtn" id="resetbtn"/>
          </p>
          </form>
          <div class="clearfloat"></div>
          <div id="messageBox"></div>
          
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

<?php }
else header('Location: index.php');

?>