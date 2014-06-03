<div class="banner">

<?php 
$i=0;
//addconnection
include("../connection/connection.php");

$basql = "select * from deal order by rand()";

$baresult = $pdo->query($basql);

while($barow = $baresult->fetch()){
			$baid = $barow["dealid"];  
			$baname = $barow["dealname"];  
			$badescription = $barow["description"];
			$basaving = $barow["saving"];
			$baimages = $barow["images"];
?>
          
		
          <div class="active">       
          <?php
		   $baimgLink = explode("*", $baimages);
		   $baimg = $baimgLink[0];
		   ?>   
            <img src="<?php echo $baimg ?>" width="960" height="348" alt=""/>            
            <div class="discount"><h1><?php echo $basaving; ?>%</h1></div>
            <div class="description">            
            <h1><a class="bannerh1" href="../layout/dealdetails.php?id=<?php echo $baid ?>"><?php echo $baname; ?></a></h1>
            <p><?php echo substr($badescription, 0, 130); ?> ...</p>
            </div>
			<div class="next" onclick="slideSwitch()"></div>
          </div>
          
          
         <?php 
		 $i++;
		 if($i>=5) break;
		 
		 }?>
</div>

<?php 
if($isUser==1){
?>

<script>
$('.banner').hide();
</script>

<?php }?>