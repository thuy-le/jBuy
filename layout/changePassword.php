<?php 
session_start();
if(isset($_SESSION['userID']))
{
$_SESSION['menu']=-4;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--title-->
    <title>Just Buy</title>

	<?php include("../template/header.php"); ?>  
    <script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
    <script>
	$(function(){
	$("#passD").css("background-image","url(../images2/m2.png)");
		
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
          <h1><a href="#" class="h1">Change Password</a></h1>
          
          <div class="ctop"></div>
          
          <!--deals-->
          <div class="deals">
          <div class="clearfloat2"></div>
            <div class="note">
            1. Please enter all the (*) information.<br/>
            2. Your password should be more than 6 characters
            
            <div class="error">
            </div>
            </div>
            
            <form class='changePass' id='changePass' action='../process/changePasswordAction.php' method='POST'>
            <p><label>Old Password:</label><input type='password' name='oldpass' id='oldpass' class='passwordTxt'/></p>
            <p><label>New Password:</label><input type='password' name='newpass' id='newpass' class='passwordTxt'/></p>
            <p><label>Confirm Password:</label><input type='password' name='confirmpass' id='confirmpass' class='passwordTxt'/></p>
            <div class="clearfloat"></div>
            <input type='submit' value='Change' class="buynowbtn" id='changePassBtn'/>
            </form>
			<div class="clearfloat"></div>
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
<?php
}
else header('Location: ../layout/index.php');	
?>
