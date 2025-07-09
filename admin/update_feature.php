<?php
session_start();
  include '../includes/functions.php';
  check_admin();
        $conn = coonect();  
        $id = $_POST["id"];
        $featue = $_POST["featured"];
        $req = "UPDATE products SET is_featured = :is_featured WHERE id = :id";
        $op = $conn->prepare($req);
        $op->execute([
            ':is_featured' => $featue,
            ':id' => $id
        ]);
        echo "Updated successfully";

    
?>