<?php
    session_start();
    include 'includes/functions.php';
    $conn = coonect();      
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $id = $_GET['id'];
    if ($id) {
        $req = "SELECT * FROM products WHERE id = :id";
        $op = $conn->prepare($req);
        $op->execute([":id"=>$id]);
        $product = $op->fetch(PDO::FETCH_OBJ);
        if ($product) {
            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id]['quantity'] += 1;
            } else {
                $_SESSION['cart'][$id] = [
                    'id'       => $product->id,
                    'name'     => $product->name,
                    'price'    => $product->price,
                    'image'    => $product->image,
                    'quantity' => 1
                ];
            }
        }
    }
    header("Location: menu.php");
    exit;

?>
