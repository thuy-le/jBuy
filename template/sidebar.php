<div id="sidebar1">


<?php 
if($isUser == 1){	
?>
    <script>
		$(function(){
		
		$("#sidebar1").css({
			"background-image" : "none",
			"background-color" : "transparent"
		  });
		  
		  <?php if($menu=='adddeal'){ ?>
		  
		  
		  $("#addD").css("background-image","url(../images2/m2.png)");
		  <?php }?>
		});
	</script>
		<div class='sDiv' id='addD'>
        <a class='sidebarLink' href='../layout/adddeal.php'>Add New Deal</a>
        </div>	
        <div class='sDiv' id='allD'>
        <a class='sidebarLink' href='../layout/deals.php'>All Deals</a>
        </div>	
        <div class='sDiv' id='catD'>
        <a class='sidebarLink' href='../layout/categories.php'>Manage Category</a>
        </div>	
        <div class='sDiv' id='userD'>
        <a class='sidebarLink' href='../layout/users.php'>Manage Users</a>
        </div>
        <div class='sDiv' id='passD'>
        <a class='sidebarLink' href='../layout/changePassword.php'>Change Password</a>
        </div>
        <div class='sDiv' id='themeD'>
        <a class='sidebarLink' href='../layout/uploadCSS.php'>Theme</a>
        </div>	
	<?php }
	

else{
?>


<?php 
$i=0;

$pdo = new PDO("mysql:host=localhost; dbname=s3372751", "s3372751", "qwerty1234");

$sbsql = "select * from deal order by rand()";

$sbresult = $pdo->query($sbsql);

while($sbrow = $sbresult->fetch()){
			$sbid = $sbrow["dealid"];  
			$sbname = $sbrow["dealname"];  
			$sbdescription = $sbrow["description"];
			$sbsaving = $sbrow["saving"];
			$sbthumb = $sbrow["thumb"];
?>

          <!--content 1--> 
          <h1><?php echo substr($sbname,0,20); ?></h1>
          <img src="<?php echo $sbthumb ?>" width="220" height="159" alt=""/>
          <div class="desc"><?php echo $sbsaving; ?>%</div>
          <p class="myDiv"><?php echo substr($sbdescription, 0, 160); ?> ...</p>
          <a href="../layout/order.php?id=<?php echo $sbid ?>" class="buy">BUY</a><a href="../layout/dealdetails.php?id=<?php echo $sbid; ?>" class="details">DETAILS</a>
          <div class="clearfloat"></div>
          <div class="hr1"></div>
          
          
        <?php 
		$i++;
		if($i>=5) break;
		}?>
 
<?php }?>    
        <!-- end .sidebar1 --></div>