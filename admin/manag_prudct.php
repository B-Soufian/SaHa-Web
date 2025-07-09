<?php
session_start();
  include '../includes/functions.php';
  check_admin();
        $conn = coonect();  
        // echo"hello";
        if(isset($_POST["save"])){
            $req = "INSERT into products(name,price,quantity,category,image)
                    VALUES(:name,:price,:quantity,:category,:image);";
            $name=$_POST["name"];
            $price=$_POST["price"];
            $quantity=$_POST["quantity"];
            $category=$_POST["category"];
            $image=$_POST["image"];
            $op = $conn->prepare($req);
            $op->execute([":name"=>$name,
            ":price"=>$price,
            ":quantity"=>$quantity,
            ":category"=>$category,
            ":image"=>$image]);
        }
        elseif(isset($_POST["edite"])){
            $req = "UPDATE products
                    set name = :name,
                    price = :price,
                    quantity = :quantity,
                    category =:category ,
                    image = :image 
                    WHERE id = :id ";
                
            $name=$_POST["name"];
            $price=$_POST["price"];
            $quantity=$_POST["quantity"];
            $category=$_POST["category"];
            $image=$_POST["image"];
            $id = $_POST["id"];
            
            $op = $conn->prepare($req);
            $op->execute([":name"=>$name,
                        ":price"=>$price,
                        ":quantity"=>$quantity,
                        ":category"=>$category,
                        ":image"=>$image,
                        ":id"=>$id]);
        }
        header("location:products.php");
     echo "Problème de connexion ".$e->getMessage();
    
?>