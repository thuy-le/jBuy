<?php 
session_start();
//add connection
include("../connection/connection.php");

$uid = $_GET['id'];
$usql = "select * from userdetails where id=".$uid;
$uresult = $pdo->query($usql);
$urow = $uresult->fetch();

$fullname = $urow[1];
$email = $urow[2];
$phone = $urow[3];
$address = $urow[4];

$usql2 = "select * from user where userid=$uid";
$uresult2 = $pdo->query($usql2);
$urow2 = $uresult2->fetch();

$username1 = $urow2[1];
$password1 = $urow2[2];



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
          <h1><?php echo $username1 ?>'s personal information</h1>
          
          <div class="ctop"></div>
          
          <!--deals-->
          <div class="deals" style="min-height:800px;">
          <div class="clearfloat2"></div>
<?php
if($isUser == 1 || ($isUser == 2&& $userID == $uid)){
?>

          <div id="userInfo">          
          <div id="info">
          <label class="l1">Fullname: </label><label class="l2"><?php echo $fullname ?></label>
          <div class="userHR"></div>          
          <label class="l1">Email: </label><label class="l2"><?php echo $email ?></label>
          <div class="userHR"></div>
          <label class="l1">Phone: </label><label class="l2"><?php echo $phone ?></label>
          <div class="userHR"></div>
          <label class="l1">Address: </label><label class="l2"><?php echo $address ?></label>
          <div class="userHR"></div>
          </div>
          </div>
          
<?php 
if($isUser==1){
?>
	<input type="button" value="Delete User" id="deleteUserBtn"/>

<?php } 
else{
?>
          <input type="button" value="Edit Info" id="editBtn"/>
          <input type="button" value="Change Password" id="changePassBtn" style="margin-right:7px;"/>
          
<?php }?>

          
          
          <div id="editInfo" style="display:none;">     
          <form id="editUserForm" method="POST" action="../process/editUserInfo.php">     
          <input type="text" style="display:none" value="<?php echo $uid ?>" id="hiddenID" name="uid"/>
          <label class="l1">Fullname: </label><input type="text" name="fullname" id="fullname" value="<?php echo $fullname ?>"/>
          <div class="userHR"></div>          
          <label class="l1">Email: </label><input type="text" name="email" id="email"  value="<?php echo $email ?>"/>
          <div class="userHR"></div>
          <label class="l1">Phone: </label><input type="text" name="phone" id="phone"  value="<?php echo $phone ?>"/>
          <div class="userHR"></div>
          <label class="l1">Address: </label><input type="text" name="address" id="address"  value="<?php echo $address ?>"/>
          <div class="userHR"></div>
          <input type="button" value="Finish" id="finishBtn"/>
          </form>
          </div>
          <div class="clearfloat"></div>
          
          <div id="changePassDiv" style="display:none;">
          <div class="note" style="margin-left:25px; margin-top:20px; width:415px;">
            1. Please enter all the (*) information.<br/>
            2. Your password should be more than 6 characters
            
            <div class="error"></div>
          </div>
            
            <form class='changePass' id='changePass' action='../process/changePasswordAction.php' method='POST'>
            <label class="l3">Old Password:</label><input type='password' name='oldpass' id='oldpass' class='passwordTxt'/>
          <div class="clearfloat" style="margin:10px;"></div>
            <label class="l3">New Password:</label><input type='password' name='newpass' id='newpass' class='passwordTxt'/>
          <div class="clearfloat" style="margin:10px;"></div>
            <label class="l3">Confirm Password:</label><input type='password' name='confirmpass' id='confirmpass' class='passwordTxt'/>
          <div class="clearfloat" style="margin:10px;"></div>
          <div class="userHR2"></div>
            <input type='submit' value='Change' id='changePasswordBtn' style="margin-right:123px;"/>
            <div class="clearfloat"></div>
            </form>

          </div>
<?php }
else echo "You donot have permission to access this information";
?>
          
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
<style>
label.l1, label.l2, label.l3 {float:left; margin-left:10px; font-size:1.2em;}
label.l1{width:100px;}
label.l2{font-weight:600;}
label.l3{width:200px; margin-left:5px;}
.userHR{border-bottom:1px dashed #6CF; clear:both; height:1px; margin:10px 20px 10px 10px;}
.userHR2{border-bottom:1px dashed #6CF; clear:both; height:1px; margin:10px 120px 10px 5px;}
input[type=text], input[type=password]{
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	width:200px;
	height:20px;	
	border:1px solid #6890d9;
	color:#06357c;
	padding:3px 5px;
}
input[type=button],input[type=submit]{
	background:#092c6c;	
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	border:0;
	padding:5px 12px;
	font-size:1.2em;
	color:white;
	font-family:"Century Gothic", Sans-Serif;
	cursor:pointer;
	float:right;
	margin-right:20px;
}

input[type=button]:hover,input[type=submit]:hover{
background:#0e3e97;
}
#changePassDiv{display:block; background:#ecf8fd; width:620px; margin:auto;
	margin-top:20px; 
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	border:2px solid #b2d3eb;
	padding-bottom:20px;
	 background:#ecf8fd url(../images2/cpBG.png) 540px no-repeat;
}
</style>

<script>

$('#editBtn').click(function(){
	$('#userInfo').hide();
	$('#changePassBtn').hide();
	$(this).hide();
	$('#editInfo').fadeIn(1000);
});

$('#finishBtn').click(function(){
	$('#editInfo').hide();
	$('#userInfo').fadeIn(1000);
	$('#changePassBtn').show();
	$('#editBtn').show();
});

$('#changePassBtn').click(function(){
	$('#changePassDiv').slideToggle(500);
});

</script>

    <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
    <script>
	$(function(){
    $('#changePass').validate({
        //rules
        rules: {
            
        oldpass: {
        required: true,
        },

        newpass: {
        required: true,
        minlength: 6
        },

        confirmpass: {
        required: true,
        equalTo: "#newpass"
        },		
        },
        
        //custom message
        messages: {

        oldpass: {
        required: "Please enter your old password",
        },

        newpass: {
        required: "Please enter new password",
        minlength: "Your password must be more than 6 characters"
        },

        confirmpass: {
        required: "Please confirm your password",
		equalTo: "The password confirmation does not match"
        },
        },
        
        //put messages into a box
        errorContainer: ".error",
        errorLabelContainer: ".error",
        wrapper: "li", debug:true,
        
        submitHandler: function(form) { 
		var info = $('#changePass').serialize();
		//alert(info);
		$.ajax({
			type: "POST",
			url: "../process/changePasswordAction.php",
			data: info,
			success: function(data, textStatus, jqXHR){
				if(data == "success")
				{
				alert('Password Changed');
				$('#changePass')[0].reset();
				}
				else alert(data);
			}
			});
		}
        
      });
	});

$("#finishBtn").click(function(){
		var uid = $('#hiddenID').val();
		var isValid = $('#editUserForm').valid();
		if(isValid==true && isExist==0){
		  var info = $('#editUserForm').serialize();
		  $.ajax({
		  type: "POST",
		  data: info,
		  url:"../process/editUserInfo.php",
		  success: function(msg){
			var result = msg.split(".");
			if(result[0]=="ok")
			{
				$('#editInfo').hide();
				$('#userInfo').load("userDetails.php?id="+uid+" #info");
			}
		  }
		  })			
		}
		});
		
	$("#userD").css("background-image","url(../images2/m2.png)");
	
		$('#deleteUserBtn').click(function(){
			  //Save the link in a variable called element
		var element = $(this);
		$( "#dialog" ).dialog({
			resizable: false,
			height:200,
			modal: true,
			buttons: {
				"Delete User": function() {
					
					
					//Find the id of the link that was clicked
					var del_id = $('#hiddenID').val();
					
					//Built a url to send
					var info = 'id=' + del_id;
					$.ajax({
					type: "GET",
					url: "../process/deleteUser.php",
					data: info,
					success: function(){
					alert("User deleted");
					window.location = '../layout/users.php';
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

    </script>
<div id="dialog" title="Delete User" style="display:none;">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:3px 10px 20px 0;"></span>Are you sure to delete this user and all the orders that are related to his/her?</p>
</div>