<?php
session_start();
  include '../includes/functions.php';
  check_admin();
if (!isset($_GET['order_id'])) {
    echo "<p>id order dosent founde/p>";
    exit;
}

$order_id = $_GET['order_id'];

    $conn = coonect();  

    $req = $conn->prepare("SELECT o.*,  CONCAT(u.first_name,' ', u.last_name) AS username FROM orders o 
                       JOIN users u ON o.user_id = u.id 
                       WHERE o.id = :order_id");
    
    $req->execute(['order_id' => $order_id]);
    $order = $req->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        echo "<p>order dosent found/p>";
        exit;
    }

    $reqitm = $conn->prepare("SELECT o.product_id, o.price, o.quantity , p.name
                                 FROM order_items o JOIN products p
                                 ON o.product_id = p.id
                                 WHERE o.order_id = :order_id");

    $reqitm->execute(['order_id' => $order_id]);
    $items = $reqitm->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <div class="modal-header mb-3">
        <h4 class="mb-3">Order Details</h4>
        <button type="button" class="btn-close closeModal"></button>
    </div>
    <div class="row justify-content-between align-items-start">
        <div class="col-md-6 col-12">
            <div class="mb-2"><strong>Order ID:</strong> ORD-<?php echo $order['id'] ?></div>
            <div class="mb-2"><strong>Customer:</strong> <?php echo$order['username'] ?></div>
            <div class="mb-2" id="statures"><strong>Status:</strong> <?php echo $order['status'] ?></div>
            <div class="mb-2"><strong>Date:</strong> <?php echo $order['created_at'] ?></div>
            <div class="mb-3"><strong>Total:</strong> $<?php echo $order['price'] ?></div>
        </div>
        <div class="action-buttons col-md-6 col-12">
            <select id="statu">
                <option value="pending" <?php if($order['status'] == 'pending') echo 'selected'; ?>>pending</option>
                <option value="cancelled" <?php if($order['status'] == 'cancelled') echo 'selected'; ?>>cancelled</option>
                <option value="delivered" <?php if($order['status'] == 'delivered') echo 'selected'; ?>>delivered</option>
            </select>
        </div>
    </div>
    <hr>
    <h6 class="mt-4">Order Items</h6>
    <table class="table order-table">
        <thead>
            <tr>
                <th>PRODUC</th>
                <th>QUANTITY</th>
                <th>PRICE</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item){ ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= $item['price'] ?> $</td>
                    <td><?= $item['price'] * $item['quantity'] ?> $</td>
                </tr>
            <?php }; ?>
        </tbody>
    </table>
    <div class="d-flex justify-content-end gap-2">
        <form method="get">
            <input type="hidden" name="order_id" value="<?php echo $order_id ?>">
            <input type="hidden" name="statu" id="statinput" value="<?php echo $order['status'] ?>">
            <button type="submit" class="btn btn-primary" id="actn" name="edite">Edit</button>
        </form>
    </div>
<?php

?>
