

<?php 

//SESSION CHECKING

$isUser=0;
//get user session
if(isset($_SESSION["isUser"]))
$isUser=$_SESSION["isUser"];

$menu = -1;
//get menu session for highlight
if(isset($_SESSION["menu"]))
$menu = $_SESSION["menu"]; 
?>



    <!--css-->
    <link id="pageStyle" href="../style/style.css" rel="stylesheet" type="text/css" />
    
    
    <!--[if IE]>
    <link href="../style/ie_hacks.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    
    <!--[if IE 7]>
    <link href="../style/ie7_hacks.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    
    <!--[if IE 6]>
    <link href="../style/ie6_hacks.css" rel="stylesheet" type="text/css" />
    <![endif]-->
    
    
    <!--javascript-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>  
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <link type="text/css" href="../style/blitzer/jquery-ui-1.8.18.custom.css" rel="stylesheet" />	
    <script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery-ui-1.8.18.custom.min.js"></script>

    
    <script type="text/javascript" src="../js/cufon.js"></script>
    
    <script type="text/javascript" src="../js/Delius_Swash_Caps_400.font.js"></script>
    <script type="text/javascript">
    Cufon.replace('.discount h1');
    Cufon.replace('.discount2 p');
	Cufon.replace('#sidebar1 .desc');
	
    </script>
    
    <script type="text/javascript" src="../js/GardensC_400.font.js"></script>
    <script type="text/javascript">
    Cufon.replace('.content h2',{hover: true});
	Cufon.replace('.dealdescription .dright div.timetop, .dealdescription .dright div.price .ptop, .dealdescription .dright div.buyer .ptop');
	Cufon.replace('.dealdescription .dright div.buynow');
    </script>
    
    <script type="text/javascript">	  	  
    function slideSwitch() {
    var $active = $('.banner div.active');

    if ( $active.length == 0 ) $active = $('.banner div:last');
    
    var $next =  $active.next().length ? $active.next()
        : $('.banner div:first');	

    $active.addClass('last-active');

    $next.css({opacity: 0.0})
        .addClass('active')
        .animate({opacity: 1.0}, 1000, function() {
            $active.removeClass('active last-active');
        });
}

$(function() {
    setInterval( "slideSwitch()", 7000 );
});
</script>  

 <script type="text/javascript">
	
    function heightdv() {
	  var w =  $("#wrapper").height();
	  var s =  $("#sidebar1").height();
	  
	  if(w>s){
      var h =  $("#wrapper").height() -400 + "px";
	  s = $("#sidebar1").height(h);	  
	  }
	}
	</script>
    


