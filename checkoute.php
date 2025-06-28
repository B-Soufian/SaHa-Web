<?php
    session_start();
    include 'includes/functions.php';

    $conn = coonect(); 
    check_user();
    $user_id = $_SESSION["user_id"];
    $cart = $_SESSION['cart'];
    
    $total = 0;
    foreach ($cart as $item){
        $total += $item['price'] * $item['quantity'];
    }
    $stmt = $conn->prepare("INSERT INTO orders (user_id,price) VALUES (:user,:price)");
    $stmt->execute([":user"=>$user_id,":price"=>$total]);

    $order_id = $conn->lastInsertId();

    $stmtItem = $conn->prepare("INSERT INTO order_items(order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");

    foreach ($cart as $item) {
        $stmtItem->execute([
            $order_id,
            $item['id'],
            $item['quantity'],
            $item['price']
        ]);
    }
    unset($_SESSION['cart']);
    header("Location: profile/orders.php");
    exit;

?>