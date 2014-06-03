<script>
	$(function(){
		$('.divTable div.tableRow:odd').css("background-color", "#eaf2fb");
		
		$(".updateCat").click(function(){
			var element = $(this);
			var upt_id = element.attr("id");
			$( "#dialog2" ).dialog({
			resizable: false,
			height:250,
			modal: true,
			buttons: {
				"Update": function() {
					var theDia = $(this);
					//Built a url to send
					var info = 'categoryid=' + upt_id + '&categoryname=' + $('#categoryname').val();
					$.ajax({
					type: "POST",
					url: "../process/updateCategory.php",
					data: info,
					success: function(html){
					if(html == 'true') 
					{
					$('#catList').fadeIn(400).load('../process/viewcategories.php');
					theDia.dialog( "close" );
					}
					
					else $(".validateTips").html(html);
					
					}
					});
					

					
				},
				"No": function() {
					$( this ).dialog( "close" );
				}
			}
		});
			
		});
		
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
					url: "../process/deletecategory.php",
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
	$sql="select * from category";
	$result=$pdo->query($sql);	
	
	echo "<div class='divTable'>";

	  echo "<div class='tableHead'>";
	  echo "<div class='divIDHead'>ID</div>";
	  echo "<div class='divNameHead'>Name</div>";
	  echo "<div class='divDeleteHead'>Delete</div>";
	  echo "<div class='divUpdateHead'>Update</div>";
	  echo "</div>";

	  echo "<div class='clearfloat' style='width:0px; margin:0; padding:0;'></div>";
	  while($row=$result->fetch()){
		  $id=$row['categoryid']; 
		  echo "<div class='tableRow'>";
		  echo "<div class='divID'>".$row['categoryid']."</div>";
		  echo "<div class='divName'>".$row['categoryname']."</div>";
		  echo "<div class='divDelete'><a class='deleteCat' id='".$id."'>Delete</a></div>";
		  echo "<div class='divUpdate'><a class='updateCat' id='".$id."'>Update</a></div>";

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
</style>