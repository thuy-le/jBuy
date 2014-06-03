<div class="top">
  <p>
<?php

if($isUser==1 || $isUser==2)
{
	$username = $_SESSION["username"];
	$userID = $_SESSION["userID"];
?>
    <a id="logout" style="float:right; font-size:1.1em;" href="../process/logout.php">Logout</a>
    <label class="divider">|</label>
    
    <?php if($isUser==2){ ?>
    <label class="welcome">Welcome, <a href="../layout/userDetails.php?id=<?php echo $userID ?>"><?php echo $username; ?></a></label>
    <?php } 
	else{
	?>
    <label class="welcome">Welcome, <?php echo $username; ?></label>
    <?php }?>
<?php
}
else{
?>
    <a href="#registerDialog" name="modal" style="float:right; margin-top:2px; font-size:1.1em;">Register</a>
    <label class="divider">|</label>
    <a id="loginF" onclick="loginF()" style="float:right;" href="#">Login</a>
<?php }?>

    </p>
<div class="clearfloat"></div>
</div>

<style>
		label, input { display:block; }
		input.text { margin-bottom:5px; width:250px; padding: .4em;  }
		fieldset { padding:0; border:0;}
		form{margin-top:-10px;}
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips {color:#7f0606; border: 1px solid transparent; margin-left:-5px; padding:0; padding: 0.3em; padding-bottom:5px; }
		a#loginF{background:none; font-size:1.1em; border:none;padding:0; margin-top:2px;}
	</style>
	<script>
	$(function() {
		var username = $("#lusername").val(),
			password = $("#lpassword").val();
		
		$( ".dialog-form" ).dialog({
			autoOpen: false,
			height: 280,
			width: 300,
			modal: true,
			resizable: false,
			buttons: {
				"Login": function() {
						 $.ajax({
            type: "POST",
            url: "../process/login.php",
            data: "username="+$("#lusername").val()+"&password="+$("#lpassword").val(),
            success: function(html){
                if(html=="2")
                {
					window.location.href = '../layout/index.php';

                }
				else if(html=="1")
					window.location.href = '../layout/deals.php';
					
                else
                {
                    $(".validateTips").html("Wrong username or password");
                }
            },
        });


				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				allFields.val( "" ).removeClass( "ui-state-error" );
			}
		});


	});

		function loginF() {
				$( ".dialog-form" ).dialog( "open" );
				return false;
			}

	</script>
    
   



<div class="demo"  style="display:none;">

<div class="dialog-form" title="Login">
	<p class="validateTips">Please enter username and password</p>

	<form>
	<fieldset>
		<label for="lusername">User name</label>
		<input type="text" name="lusername" id="lusername" class="text ui-widget-content ui-corner-all" />
		<label for="lpassword">Password</label>
		<input type="password" name="lpassword" id="lpassword" value="" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>



</div><!-- End demo -->

<!--Queeness - Simple jQuery Modal Window Tutorial
link: http://www.queness.com/post/77/simple-jquery-modal-window-tutorial
-->
<script>
$(document).ready(function() {	

	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		//Get the A tag
		var id = $(this).attr('href');

		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();

		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		


	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			

	$(window).resize(function () {

 		var box = $('#boxes .window');

        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
});
});
</script>

<style>
#mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background:url(../images2/modalBG.png);
  display:none;
}

#boxes .window {
  position:fixed;
  left:0;
  top:0;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:20px;
}

#boxes #registerDialog {
  width:370px; 
  height:490px;
  padding:15px;
  background-color:#f5fcff;
  -webkit-border-radius: 5px;
  -moz-border-radius: 5px;
  border-radius: 5px;
  font-size:1.3em;
  color:#06357c;
  border:6px solid #294f94;
}

#boxes #registerDialog label{
	font-weight:600;	
}

#boxes #registerDialog form, #boxes #registerDialog p{padding:0; margin:0;}

#boxes #registerDialog p{margin-top:8px;}


#boxes #registerDialog input[type=text], #boxes #registerDialog input[type=password]{
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

#boxes #registerDialog input[type=submit], #boxes #registerDialog input[type=button]{
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
	float:right;
}

#boxes #registerDialog input[type=submit]:hover, #boxes #registerDialog input[type=button]:hover{
background:#0e3e97;
}

#boxes #registerDialog h1{
	padding:0;
	margin:0;
	color:#003c97;
	font-size:1.5em;	
}

#boxes #registerDialog .hr{
	border-bottom: 2px dashed #436eae;
	height:1px;
	clear:both;
	margin:7px 0 10px 0;
}
#boxes #registerDialog p.error{font-weight:normal; font-size:12px; margin:0; padding:0;}
</style>
<!--End Queeness code-->


<div id="boxes">



<div id="registerDialog" class="window">
<h1>Register
<span style="float:right;"><a href="#" style="color:#920707; text-decoration:none; font-weight:normal; font-size:.8em;" class="close"/>Close</a></span>
</h1>

<div class="hr"></div>

<form autocomplete='off' method='post' action='../process/register.php' id='registerForm'>
<div id="d1">
<p><label>Username:</label> <input type='text' name='name' id='name'/>
<p id='error1' class="error"></p>
</p>

<p><label>Password:</label> <input type='password' name='password' id='password'/></p>

<p><label>Confirm Password:</label> <input type='password' name='rePassword' id='rePassword'/>
<p id='error2' class="error"></p>
</p>
</div>

<div id="d2" style="display:none;">
<p><label>Full Name:</label> <input type='text' name='fullname' id='fullname'/></p>
<p><label>E-mail:</label> <input type='text' name='email' id='email'/></p>
<p><label>Address:</label> <input type='text' name='address' id='address'/></p>
<p><label>Mobile phone:</label> <input type='text' name='mobile' id='mobile'/></p>
</div>

<div id="d3" style="display:none;">
<p id="notice"></p>
<input type='button' class="close" value='OK'/>
</div>


<p><span id="regNote" style="color:#8e0606; font-size:.9em;">All fields are required</span></p>
<div class="hr" id="hr" style="border-bottom:1px solid #724a4a; margin-top:20px;"></div>
<input type='button' id="goNext" value='Next Step'/>
<input type='button' id="registerBtn" value='Register' style="display:none"/>
</form>

</div>

<!-- Mask to cover the whole screen -->

  <div id="mask"></div>

</div>

<script type="text/javascript" src="http://jzaefferer.github.com/jquery-validation/jquery.validate.js"></script>
<script>
	var isExist = 0;
	$("#goNext").click(
		function(){
			var isValid = $('#registerForm').valid();
			if(isValid==true && isExist==0){
			$('#d1').hide();	
			$('#d2').show(1000);
			$(this).hide();
			$('#registerBtn').show();
			}
		}
	);
	
	$("#registerBtn").click(function(){
		var isValid = $('#registerForm').valid();
		if(isValid==true && isExist==0){
		  var info = $('#registerForm').serialize();
		  $.ajax({
		  type: "POST",
		  data: info,
		  url:"../process/register.php",
		  success: function(msg){
			var result = msg.split(".");
			if(result[0]=="ok")
			{
				$('#d2').hide();
				$('#registerBtn').hide();
				$('#hr').hide();
				$('#regNote').hide();
				$('#notice').html("Hi, "+result[1]+". You've registered successfully. Thank you!");
				$('#d3').show();	
			}
		  }
		  })			
		}
		});

	$("#name").blur(function(){
		var name=$('#name').val();
		$.ajax({
		url:"../process/checkUser.php?name="+name,
		success: function(msg){
			if(msg=="1"){
				$('#error1').html('Username has been used').css('color','red');
				isExist = 1;
			}else{ $('#error1').html('');
			isExist = 0;
			}
		}
		})
	});
	$('#rePassword').blur(function (){
		if($('#password').val()!=$('#rePassword').val()){
			$('#error2').html('Password does not match,Please type again').css('color','red');
		}else {	$('#error2').html('');}
	});
	$(document).ready(function (){
		 $.validator.addMethod("nameCheck",
								function(value,element){
									return /[0-9]+/.test(value)
								},"Must contain one number"
		);
		$.validator.addMethod("passwordCheck",
								function(value,element){
									return /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W])/.test(value)
								},"Password must contain lowercase and uppercase letters,number,special character" 			
		);
		$("#registerForm").validate({
			rules:{
				name:{
					required: true,
					nameCheck:true,
					minlength: 3
				},
				email:{
					required:true,
					email:true
				},password:{
					required:true,
					passwordCheck:true,
					minlength:5
				},mobile:{
					required:true,
					number:true
				},phone:{
					required:true,
					number:true
				},fullname:{
					required:true,
				},address:{
					required:true,
				}
			},
        errorPlacement: function(error, element) {
           element.after(error);
			error.css({'color':'red',"font-weight":"normal", "font-size":"12px"});
        }
		});
	})
</script>