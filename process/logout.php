<?php 
session_start();
if (isset($_SESSION['isUser'])) {
    $_SESSION['isUser'] = "";
    $_SESSION['username'] = "";
}  
session_destroy();
header('Location: ../layout/index.php');
?>