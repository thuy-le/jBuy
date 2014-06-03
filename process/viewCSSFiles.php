<script>
	$(function(){
		$('.divTable div.tableRow:odd').css("background-color", "#eaf2fb");
		
		$(".deleteCSS").click(function(){
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
					url: "../process/deleteCSSFile.php",
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
	$sql="select * from theme";
	$result=$pdo->query($sql);	
	
	echo "<div class='divTable'>";

	  echo "<div class='tableHead'>";
	  echo "<div class='divIDHead'>ID</div>";
	  echo "<div class='divNameHead'>Theme Name</div>";
	  echo "<div class='divDeleteHead'>Delete</div>";

	  echo "</div>";

	  echo "<div class='clearfloat' style='width:0px; margin:0; padding:0;'></div>";
	  while($row=$result->fetch()){
		  $id=$row[0]; 
		  echo "<div class='tableRow'>";
		  echo "<div class='divID'>".$row[0]."</div>";
		  echo "<div class='divName'>".$row[1]."</div>";
		  echo "<div class='divDelete'><a class='deleteCSS' id='".$id."'>Delete</a></div>";


		  echo "</div>";
		  
		  echo "<div class='clearfloat' style='width:0px; margin:0; padding:0;'></div>";
	  }
			
echo "</div>";
?>


<div id="dialog" title="Delete category" style="display:none;">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:3px 10px 20px 0;"></span>Are you sure to delete this CSS?</p>
</div>

<style>
		label, input { display:block; }
		input.text { margin-bottom:5px; width:250px; padding: .4em;  }
		fieldset { padding:0; border:0;}
		form{margin-top:-10px;}
		.ui-dialog .ui-state-error { padding: .3em; }
		.validateTips {color:#7f0606; border: 1px solid transparent; margin-left:-5px; padding:0; padding: 0.3em; padding-bottom:5px; }
		.divName, .divNameHead{width:410px;}
</style>