<?php 
session_start();
$_SESSION['menu']='adddeal';
$isUser = $_SESSION['isUser'];
if($isUser==1){
?>

<?php 
//connection
include("../connection/connection.php");
$adddeal_sql = "select * from category ORDER BY categoryid ASC";
$adddeal_result = $pdo->query($adddeal_sql);
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
        
        $('#description, #condition').markItUp(mySettings);
            
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
    </script>

	<script>
    
    $(function(){
      
	  $("#div2").hide();
      $("#adddealbtn").hide();
		  
      $("#resetbtn").click(function(){
		//$('#adddeal').reset();
		if($("#div2").css('display') == 'none'){
		  $('#dealnametxt').val('');	
		  $('#description').val('');	  
		  $('.pricetxt').val('');
		  $('#datepicker').val('');
		  $('#maxbuyers').val('');  
		  $('#categoryid option').eq(0).attr('selected', 'selected');
		}
		else{
		  $('#imagefile').val('');	  
		  $('#condition').val('');		
		}
      });
	  
	  $("#nextStep").click(function(e) {
		var a = $("#adddeal").valid();
		
		if($("#div2").css('display') == 'none'){
        if(a!=true)
    	e.preventDefault();
		else{
		$("#div1").hide();
        $("#div2").height($("#div1").height());
        $("#div2").fadeIn(1000);
        $("#nextStep").val("Go Back");
        $("#adddealbtn").show();
		}
        }
        else{
        $("#div2").hide();
        $("#div1").fadeIn(1000);	
        $("#nextStep").val("Next Step");
        $("#adddealbtn").hide();
        }
		
		});
    
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
        //image
        imagefile: {
        required: "Please choose an image",
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
        digits: "Group price should be integer",
        },
        //max buyers
        maxbuyers: {
        required: "Please input maximun number of buyers allowed",
        digits: "Maximum buyers number should be integer"	
        },
        
        },
        
        //put messages into a box
        errorContainer: ".error",
        errorLabelContainer: ".error",
        wrapper: "li", debug:true,
        
        submitHandler: function(form) { 
		var info = $('#adddeal').serialize();
		//alert(info);
		$.ajax({
			type: "POST",
			url: "../process/adddealaction.php",
			data: info,
			success: function(data, textStatus, jqXHR){
				var id = data.split("/");
				if(id[1] == "success")
				window.location = "../layout/dealdetails.php?id="+id[0];
				else alert(data);
			}
			});
		}
        
      });
    
    
    });
    </script>

<!-- Uploadify -->
    <script type="text/javascript" src="../uploadify/jquery.uploadify.v2.1.4.js"></script>
    <script type="text/javascript" src="../uploadify/swfobject.js"></script>

	<script type="text/javascript">
    $(document).ready(function() {
      $('#file_upload').uploadify({
        'uploader'  : '../uploadify/uploadify.swf',
        'script'    : '../uploadify/uploadify.php',
        'cancelImg' : '../uploadify/cancel.png',
        'folder'    : '../images/',
		'buttonImg' : '../images/browse.png',
		'width' : 140,
		'height' : 35,
		'fileExt'     : '*.jpg;*.gif;*.png',
		'fileDesc'    : 'Image Files',
		'queueSizeLimit' : 3,
		'queueID'        : 'queue',
        'auto'      : true,
		'simUploadLimit' : 2,
		'multi'     : true,
		'onComplete': function(event, ID, fileObj, response, data) {
			$('#queue').append('<div style="display:table-row; "><div style="display:table-cell;width:250px; overflow:hidden;color:#0a4895; font-size:1.1em; padding:5px 10px;">'+fileObj.name+'</div><div style="display:table-cell; padding:5px 10px;"><img align="bottom" src="../images/check.png"/></div></div>');
                $('#adddeal').append('<input style="display:none;" type="text" name="image[]" value="'+response+'"/>');
            }
      });
    });
    </script>

  </head>
  
  <body onLoad="heightdv()">
  
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
          <h1><a href="#" class="h1">Add deal</a></h1>
          
          <div class="ctop"></div>
          
          <!--deals-->
          <div class="deals">
          <div class="clearfloat2"></div>
          
          <div class="note">
          1. Please enter all the (*) information.<br/>
          2. You have to upload at least one image.<br />
          3. Upload image's size cannot be larger than 2MB.<br />
          4. Group price should not be largger than original price.
          
          <div class="error">
          </div>
          </div>
          
          
          <div class="clearfloat2"></div>
          <form class="adddeal" id="adddeal" name="adddeal" method="POST" action="../process/adddealaction.php" enctype="multipart/form-data">
          <div id="div1">
          <p>
          <label>Category:</label>
          <select name="categoryid" id="categoryid">
          <?php
          while($adddeal_row = $adddeal_result->fetch()){
			$adddeal_categoryid = $adddeal_row["categoryid"];
			$adddeal_categoryname = $adddeal_row["categoryname"];
		  ?>
            <option value="<?php echo $adddeal_categoryid ?>"><?php echo $adddeal_categoryname ?></option>
          <?php  
		  }
		  ?>
          </select>
          </p>
          <p>
          <label>Deal name:</label>
          <input type="text" name="dealname" id="dealnametxt"/>
          </p>
           <p>
          <label>Description:</label>
          <textarea style="resize:none;" name="description" class="required" id="description" cols="80" rows="20"></textarea>  
          </p>
          <p>
          <div class="divLeft">
          <label>Original price:</label>
          <input type="text" id="originalprice" name="originalprice" class="pricetxt"/>
          </div>
          <div class="divLeft">
          <label>Group price:</label>
          <input type="text" name="groupprice" class="pricetxt"/>
          </div>
          </p>
          <div class="clearfloat"></div>
          <p>
          <div class="divLeft">
          <label>Expired Date:</label>
          <input id="datepicker" name="datepicker" type="text">
          </div>
          <div class="divLeft">
          <label>Max Buyers:</label>
          <input type="text" name="maxbuyers" id="maxbuyers"/>
          </div>
          </p>
          </div>
          <!--div2-->
          <div id="div2">
          <p>
          <label>Images:</label>
          <input type="file" id="file_upload" name="file_upload" style="float:left; width:100px;"/>
          <div id="queue" style="width:300px; position:relative; left:300px; top:-70px;"></div>
          <div id="info"></div>

          </p>
          <div class="clearfloat"></div>         
          <p>
          <label>Condition:</label>
          <textarea name="condition" style="resize:none;" class="required" id="condition" cols="80" rows="20"></textarea>          
          </p>
          
          <p>
          <label>Is Active:</label>
          <input type="checkbox" name="status"/>
          </p>

          </div>
          
          <!--buttons-->
          <div class="clearfloat"></div>
          <div class="hr2"></div>
          <p>
          <div class="space"></div>
          <input type="submit" name="add" value="Add This Deal" class="buynowbtn" id="adddealbtn"/>
          <input type="button" name="nextStep" onClick="changeDiv()" id="nextStep" value="Next Step" class="buynowbtn"/>
          <input type="button" name="reset" value="Reset" class="buynowbtn" id="resetbtn"/>

          </p>
          <div class="clearfloat"></div>
          
          </form>
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
