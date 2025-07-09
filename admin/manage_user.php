<?php
session_start();
  include '../includes/functions.php';
  check_admin();
        $conn = coonect();  
        $req = "UPDATE users
                set role = :role,
                statu =:statu
                WHERE id = :id ";
                
        $role=$_POST["role"];
        $statu=$_POST["statu"];
        $id = $_POST["id"];
            
        $op = $conn->prepare($req);
        $op->execute([":role"=>$role,
                    ":statu"=>$statu,
                    ":id"=>$id]);
        header("location:users.php");
        
   
?>