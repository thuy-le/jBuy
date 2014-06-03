<script>
	$(function(){
		$('.divTable div.tableRow:odd').css("background-color", "#eaf2fb");
		
		$(".deleteCat").click(function(){
		//Save the link in a variable called element
		var element = $(this);
		$( "#dialog" ).dialog({
			resizable: false,
			height:200,
			modal: true,
			buttons: {
				"Yes": function() {
					
					
					//Find the id of the link that was clicked
					var del_id = element.attr("id");
					
					//Built a url to send
					var info = 'id=' + del_id;
					$.ajax({
					type: "GET",
					url: "../process/deleteOrder.php",
					data: info,
					success: function(){
					
					}
					});
					element.parents(".tableRow").animate({ backgroundColor: "#fbeaea" }, "fast")
					.animate({ opacity: "hide" }, "slow");
					$( this ).dialog( "close" );

					
				},
				"No": function() {
					$( this ).dialog( "close" );
				}
			}
		});
		});
		
		});
		
		
</script>

<?php
	//add connection
	include("../connection/connection.php");
	$sql="select * from `order`";
	$result=$pdo->query($sql);	
	
	echo "<div class='divTable'>";

	  echo "<div class='tableHead'>";
	  echo "<div class='divNameHead'>Order ID</div>";
	  echo "<div class='divNameHead'>Deal ID</div>";
	  echo "<div class='divNameHead'>Customer ID</div>";
	  echo "<div class='divNameHead'>Receiver ID</div>";
	  echo "<div class='divNameHead'>Quantity</div>";
	  echo "<div class='divNameHead'>Total Value</div>";
	  echo "<div class='divNameHead'>Order Date</div>";
	  echo "<div class='divNameHead'>Delete</div>";
	  echo "</div>";

	  echo "<div class='clearfloat' style='width:0px; margin:0; padding:0;'></div>";
	  while($row=$result->fetch()){
		  $id=$row[0]; 
		  echo "<div class='tableRow'>";
		  echo "<div class='divName'>".$row[0]."</div>";
		  echo "<div class='divName'><a href='dealdetails.php?id=".$row[1]."'>".$row[1]."</a></div>";
		  echo "<div class='divName'><a href='userDetails.php?id=".$row[2]."'>".$row[2]."</a></div>";
		  echo "<div class='divName'><a href='userDetails.php?id=".$row[3]."'>".$row[3]."</a></div>";
		  echo "<div class='divName'>".$row[4]."</div>";
		  echo "<div class='divName'>".$row[5]."</div>";
		  echo "<div class='divName'>".$row[6]."</div>";
		  echo "<div class='divName'><a class='deleteCat' id='".$id."'>Delete</a></div>";

		  echo "</div>";
		  
		  echo "<div class='clearfloat' style='width:0px; margin:0; padding:0;'></div>";
	  }
			
echo "</div>";
?>


<div id="dialog" title="Delete category" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:3px 10px 20px 0;"></span>Deleting this deal means deleting all the deals that are associated to it. Are you sure?</p>
</div>

<div id="dialog2" title="Update category" style="display:none;">
	<p class="validateTips">Please enter new category name</p>
  <form>
	<fieldset>
		<label for="categoryname">Category Name</label>
		<input type="text" name="categoryname" id="categoryname" class="text ui-widget-content ui-corner-all" />
	</fieldset>
	</form>
</div>

<style>
		label, input { display:block; }
		input.text { margin-bottom:5px; width:250px; padding: .4em;  }
		fieldset { padding:0; border:0;}
		form{margin-top:-10px;}
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips {color:#7f0606; border: 1px solid transparent; margin-left:-5px; padding:0; padding: 0.3em; padding-bottom:5px; }
		.divNameHead, .divName{width:56px; font-size:1em;}
		.divNameHead{height:50px;}
		.tableRow{width:617px;}
		.divTable,.tableHead{border-top:0;}
</style>