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
          	<div id="slideshowHolder">
       		<?php 
			$init = 0;
			while($init < count($images)-1)
			{
            ?> 
			<img src='<?php echo $images[$init]?>' style='width:641px; height:232px;'/>
			<a href="<?php echo $images[$init]?>"></a>
			<?php
            $init++;
			}?>
            </div>
            
            <div class="discount2" id="detailDiscount"><p><?php echo $saving; ?>%</p></div>
            <div class="dealdescription">
            <div class="dleft">
            <p><?php echo $description; ?></p>
            </div>
            <div class="dright">
                       
           <div class="price">           
           <div class="pbot"><h4>$<?php echo $groupprice; ?></h4></div>
           <div class="ptop">Price</div>
           </div>
           
           <div class="buyer">           
           <div class="pbot"><h4><?php echo $currentbuyers; ?> / <?php echo $maxbuyers; ?></h4></div>
           <div class="ptop">Buyers</div>
           </div>
           
           <div class="price">           
           <div class="pbot"><h4>$<?php echo $originalprice; ?></h4></div>
           <div class="ptop">Original Price</div>
           </div>
           
           <div class="buyer">           
           <div class="pbot"><h4><?php echo $saving; ?>%</h4></div>
           <div class="ptop">Discount</div>
           </div>
           
           <div class="clearfloat"></div>
           
           <div id="extime" class="time"></div>
           <div class="clearfloat"></div>
           <div class="timetop">Time left</div>
           
           <div class="clearfloat"></div>
            <?php if($isUser==1){ ?>
              <div class="avai"><img src="../images2/edit.png" width=40 height=40/></div>
              <div class="buynow">
              <input type="button" name="" id='deleteDeal' value="Delete Deal" class="buynowbtn"/>
              </div>
              <div class="avai"><img src="../images2/delete.png"  width=40 height=40/></div>
              <div class="buynow">
              <input type="button" name="" id='updateDeal' value="Update Deal" class="buynowbtn"/>
              </div>            
            <?php }
			else{
			?>            
              <div class="avai"><img src="../images2/available.png"/></div>
              <div class="buynow">
              <input type="button" name="" value="Buy This Deal" id="buyDeal" class="buynowbtn"/>
              </div>
            <?php }?>
                       
            </div>
            </div>
            <div class="clearfloat"></div>
            <div class="dealnote">
            <label>Conditions: </label>
            <p><?php echo $conditions ?></p>
            </div>
            <div class="clearfloat"></div>
            <div id='commentDiv'>
            <div class="commentLeft">
            <h1>Leave a comment</h1>
            <?php 
			if($isUser == 1 || $isUser == 2)
			{
			?>
            <input type="text" name="commentName" id="commentName" readonly="readonly" value="<?php echo $_SESSION["username"]; ?>"/>
            <?php
			}
			else{
			?>
            <input type="text" name="commentName" id="commentName" value="name..."/>
            <?php } ?>
            <textarea name="commentContent" id="commentContent">comment...</textarea>
            <p id="commentErr" class="err"></p>
            <input type="button" value="Send" id="sendComment"/>
            </div>

            <div class="replyLeft">
            <h1>Reply to Kat</h1>
            <?php 
			if($isUser == 1 || $isUser == 2)
			{
			?>
            <input type="text" name="replyName" id="replyName" readonly="readonly" value="<?php echo $_SESSION["username"]; ?>"/>
            <?php
			}
			else{
			?>
            <input type="text" name="replyName" id="replyName" value="name..."/>
            <?php } ?>
            <textarea name="replyContent" id="replyContent">comment...</textarea>
            <p id="commentErr2" class="err"></p>
            <input type="button" value="Send" id="sendReply"/><input type="button" value="Cancel" id="cancelReply"/>
            </div>

            
            <script>
            $('input[type=text]').focus(function(){
				var r = $(this).attr("readonly");
				if(r != "readonly")
				$(this).val("");	
			});
			$('textarea').focus(function(){
				$(this).html("");	
			});
			$('#sendComment').click(function(){
				var name = $.trim($("#commentName").val());
				var content = $.trim($("#commentContent").val());
				
				if(name!=""&&content!=""&&name!="name..."&&content!="comment...")	{
					$.ajax(
					{
						type:"POST",
						data: "sender="+name+"&comment="+content+"&dealID="+$('#hiddenID').val(),
						url: "../process/sendComment.php",
						success: function(msg){
							$('#commentErr').html(msg);
							var thisID = $('#hiddenID').val();
							$(".commentRight").load("dealdetails.php?id="+thisID+" #commentContainer");
							$('#commentContainer p.messageContent').expander({
								slicePoint: 150,
								expandText: 'more',
								userCollapseText: 'hide'
							});
						}
					}
					)
				}
				else{
					$('#commentErr').html("Please enter your name and your comment before send");
				}
			});
			
			$('#sendReply').click(function(){
				var name = $.trim($("#replyName").val());
				var content = $.trim($("#replyContent").val());
				
				if(name!=""&&content!=""&&name!="name..."&&content!="comment...")	{
					$.ajax(
					{
						type:"POST",
						data: "sender="+name+"&comment="+content+"&commentID="+$('#currentComment').val(),
						url: "../process/sendReply.php",
						success: function(msg){
							$('#commentErr').html(msg);
							var thisID = $('#hiddenID').val();
							$(".commentRight").load("dealdetails.php?id="+thisID+" #commentContainer");
							$('#commentContainer p.messageContent').expander({
								slicePoint: 150,
								expandText: 'more',
								userCollapseText: 'hide'
							});
						}
					}
					)
				}
				else{
					$('#commentErr2').html("Please enter your name and your comment before send");
				}
			});
            </script>
            
            
            <div class="commentRight">
            <h2>Comments</h2>
            <div id="commentContainer">
            <?php 
			$commentSql = "select * from comment where dealid=".$id;
			$commentResult = $pdo->query($commentSql);
			while($commentRow = $commentResult->fetch())
			{
				$commentID = $commentRow[0];
				$sender = $commentRow[1];
				$comment = $commentRow[2];
				$replySql = "select * from reply where commentid=".$commentID;
				$replyResult = $pdo->query($replySql);				
			?>
            <div class="record">
            <a class="reply" id="<?php echo $commentID ?>" href="<?php echo $sender ?>">Reply</a>
            <?php
            if($isUser == 1){
			?>
            
            <a class="delComment" id="<?php echo $commentID ?>" href="#">Delete | </a>
            
            <?php }?>
            <?php 
			$sqlSender = "select * from user where username='".$sender."' and isAdmin=1";
			$senderResult = $pdo->query($sqlSender);
			if($senderRow = $senderResult->fetch()){
			?>

            <label class="sender" style="font-weight:600; color:#9d0808;" ><?php echo $sender ?></label>            
                        
            <?php }
			
			else{ ?>
            
            <label style="font-weight:600;" class="sender"><?php echo $sender ?></label>            
            
            <?php } ?>
            <p style="margin-left:4px;" class="messageContent"><?php echo $comment ?></p>
			<?php
				while($replyRow = $replyResult->fetch())
				{
				$replier = $replyRow[1];
				$replyContent = $replyRow[2];

			?>
            <?php 
			$sqlReplier = "select * from user where username='".$replier."' and isAdmin=1";
			$replierResult = $pdo->query($sqlReplier);
			if($replierRow = $replierResult->fetch()){
			?>
            <label style="font-weight:600; color:#9d0808; font-size:.9em; margin-left: 15px;" class="sender"><?php echo $replier ?></label>            
            <?php }
			else{
			?>
			<label style="font-weight:600; font-size:.9em; margin-left: 15px;" class="sender"><?php echo $replier ?></label>
            <?php }?>
            
            <p style="margin-left:16px;  font-size:.9em;" class="messageContent"><?php echo $replyContent ?></p>
            
			<?php } 
            echo '<div style="border-bottom:1px solid #a6c4e7; height:1px; clear:both; margin-right:10px; margin-left:2px; margin-bottom:10px;"></div>';
			echo '</div>';
			}
			?>

            </div>
            </div>
            <div class="clearfloat"></div>
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

<input type='text' style="display:none;" id="hiddenID" value="<?php echo $id ?>"/>
<input type='text' style="display:none;" id="currentComment"/>

<!--readmore-->
<script type="text/javascript"
    src="http://plugins.learningjquery.com/expander/jquery.expander.js">
    </script>
    <script type="text/javascript">
        $(function () {
			$('.reply').click(function(e){
				var cmID = $(this).attr("id");
				var sender = $(this).attr("href");
				e.preventDefault();
				$('#currentComment').val(cmID);
				$('.replyLeft h1').html("Reply to "+sender);
			});
			
            $('p.messageContent').expander({
                slicePoint: 150,
                expandText: 'more',
                userCollapseText: 'hide'
            });
			
			$('.replyLeft').hide();
			$('.reply').click(function(){
					$('.commentLeft').hide();
					$('.replyLeft').show(300);
			});
			
			$('#cancelReply').click(function(){
				$('.replyLeft').hide();
				$('.commentLeft').show(300);
				});
        });
    </script>
    
    <style>
    .err{color:#8c0404;}
    </style>
    
        <script>
	$(function() {
	$(".delComment").click(function(e){
		//Save the link in a variable called element
		e.preventDefault();
		var element = $(this);
		$( "#dialog2" ).dialog({
			resizable: false,
			height:200,
			modal: true,
			buttons: {
				"Delete ": function() {
					
					
					//Find the id of the link that was clicked
					var del_id = element.attr("id");
					
					//Built a url to send
					var info = 'id=' + del_id;
					$.ajax({
					type: "GET",
					url: "../process/deleteComment.php",
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
	
	$('#buyDeal').click(function(){
	var id = $('#hiddenID').val();
	window.location.href = 'order.php?id='+id;	
	});
	</script>
    
    <div id="dialog2" title="Delete comment" style="display:none;">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:3px 10px 20px 0;"></span>This comment will be deleted permanently. Are you sure?</p>
    </div>
