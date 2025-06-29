<?php 
include '../includes/functions.php';
session_start();
check_user();
$conn = coonect();
    if($_POST){
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $phone = $_POST["phone"] ;
        $password = $_POST["password"] ;
        $email = $_POST["email"] ; 
        $address = $_POST["address"];
        $id = $_SESSION["user_id"];
        $req = "UPDATE users set 
                                first_name = :first_name,
                                last_name = :last_name,
                                phone = :phone,
                                password = :password,
                                email = :email,
                                address = :address
                                WHERE id = :id";
        $op = $conn->prepare($req);
        $op->execute([  ":id"=>$id,
                        ":first_name"=>$first_name,
                        ":last_name"=>$last_name,
                        ":phone"=>$phone,
                        ":password"=>$password,
                        ":email"=>$email,
                        ":address"=>$address,
                        ]);

    }

?>