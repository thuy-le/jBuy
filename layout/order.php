<?php 
session_start();
//add connection
include("../connection/connection.php");
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
        <?php 
		  if($isUser==0)
		  {
		  ?>
          <script>
          window.location.href = 'permission.php';
          </script>
          <?php
		  }
		  else{
			  $uID = $_SESSION["userID"];
		?>
          <!--div 1: Newest-->
          <!--heading-->
          <h1><a href="#" class="h1">Order</a></h1>
          
          <div class="ctop"></div>
          
          <!--deals-->
          <div class="deals">

          <div class="clearfloat2"></div>
          <h2 style="margin-left:15px; margin-bottom:20px;">You're buying: <?php echo $name ?></h2>          
          <div>
          <form id="orderForm">
          <input type="text" name="dID" value="<?php echo $dealid ?>" style="display:none;"/>
          <input type="text" name="price" id="price" value="<?php echo $groupprice ?>" style="display:none;"/>
          <input type="text" name="userID" value="<?php echo $uID ?>" style="display:none;"/>
          <p><label>Quantity: </label> <input type="text" name="quantity" id="quantity" value="1"/></p>
          <p><label>Total Value: </label> <input type="text" name="total" readonly="readonly" id="total" value="<?php echo $groupprice ?>"/></p>
          <p><label>Payment Method: </label> 
          <input type="radio" checked="checked" name="payment" value="direct"/> <label class="rValue">Pay directly when receiving the deal </label>
          <input type="radio" name="payment" value="visa"/> <label class="rValue">Visa Card</label>
          </p>
          <div class="clearfloat" style="margin-bottom:7px;"></div>
          <p><input type="checkbox" name="gift" value="gift" id="gift"/> <label class="rValue">Give this deal as a gift</label></p>
          <div class="clearfloat"></div>
          <div id="giftDIV">
          <div class="hr2"></div>
          <p><label>Please input username of the friend you want to give this deal to:</label></p>
          <p><input type="text" name="giftTxt" id="giftTxt"/></p>
          <p id='error1' class="error"></p>
          </div>
          <div class="clearfloat"></div>
          <input type="button" name="orderBtn" value="Order This Deal" id="orderBtn"/>
          </form>
                   
          <script>
		  $(function(){$('#giftDIV').hide();});
		  $('#gift').click(function() {
		  $("#giftDIV").toggle(this.checked);
		  });
		  
		  jQuery('#quantity').keyup(function () { 
		  this.value = this.value.replace(/[^0-9\.]/g,'');
		  $('#total').val(this.value*$('#price').val());
		  });


		  $("#giftTxt").blur(function(){
		  var name=$('#giftTxt').val();
		  $.ajax({
		  url:"../process/checkUser.php?name="+name,
		  success: function(msg){
		  if(msg!="1"){
		  $('#error1').html('Username doesnot exist').css('color','red');
		  isExist = 0;
		  }else{ $('#error1').html('');
		  isExist = 1;
		  }
		  }
		  })
		  });
		  
		  $("#orderBtn").click(function(){
			var isGift = $('#gift').is(':checked');
			alert('clicked');
			alert(isGift);
			if(isGift==1 && isExist == 0)
				alert("Please input the correct username of the frient you want to give this deal to");	
			else{
			var info = $('#orderForm').serialize();
			$.ajax({
			type: "POST",
			data: info,
			url:"../process/order.php",
			success: function(msg){
			  alert(msg);
			}
			})		}	
			
		  });
		  
          </script>
          
          </div>
          
          
          
          
          
          <!-- end .deals --></div>
          
          <div class="cbot"></div>
          
<?php }

?>
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

<style>
#giftDIV{display:block;}
label{font-size:1.1em;}
.rValue{
display:inline; float:left;
margin-top:0px;
font-size:1.1em;
margin:2px 5px 0 4px;
}

input[type=text], input[type=password]{
	width:350px;
	height:27px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	border:2px solid #a9c5ee;
	color:#06357c;
	font-size:1.1em;
	padding:3px 5px;
}

input[type=submit], input[type=button]{
	background:#092c6c;	
	-webkit-border-radius: 7px;
	-moz-border-radius: 7px;
	border-radius: 7px;
	border:0;
	padding:5px 12px;
	font-size:1.2em;
	color:white;
	font-family:"Century Gothic", Sans-Serif;
	cursor:pointer;
	float:left;
	margin:10px 18px;
}

input[type=submit]:hover, input[type=button]:hover{
background:#0e3e97;
}

input[type=radio], input[type=checkbox]{display: inline; float:left; margin-top:5px;}


</style>
