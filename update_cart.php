<?php
session_start();
$action = $_GET['action'] ?? null;
$id = $_GET['id'] ?? null;

if ($id && isset($_SESSION['cart'][$id])) {
    if ($action === 'increase') {
        $_SESSION['cart'][$id]['quantity'] += 1;
    } 
    elseif ($action === 'decrease') {
        $_SESSION['cart'][$id]['quantity'] -= 1;

        if ($_SESSION['cart'][$id]['quantity'] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }
    elseif ($action === 'delet') {
        unset($_SESSION['cart'][$id]);
    }
}
header("Location: cart.php");
exit;
?>