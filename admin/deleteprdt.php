<?php
session_start();
  include '../includes/functions.php';
  check_admin();
        $conn = coonect();  
        $id = $_GET["id"];
        $req = "delete from products WHERE id = :id";
        $op = $conn->prepare($req);
        $op->execute([":id"=>$id]);
        header("location:products.php");
        
   
?>