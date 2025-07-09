<?php
  session_start();
  include '../includes/functions.php';
  check_admin();
    
        $conn = coonect();  
        $id = $_GET["id"];
        $req = "delete from users WHERE id = :id";
        $op = $conn->prepare($req);
        $op->execute([":id"=>$id]);
        header("location:users.php");
    
?>