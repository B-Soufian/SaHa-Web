<?php 
    session_start();
    unset($_SESSION["user_id"]);
    unset($_SESSION["admin_id"]);
    header("location:logine.php");

?>