<?php
  session_start();
  include '../includes/functions.php';
  check_admin();
  $conn = coonect();  
  $op = $conn->query("SELECT COUNT(*) AS total FROM products");
  $row = $op->fetch(PDO::FETCH_OBJ);
  $op = $conn->query("SELECT COUNT(*) AS total FROM orders");
  $order = $op->fetch(PDO::FETCH_OBJ);
  $op = $conn->query("SELECT price FROM orders");
  $money = $op->fetchAll(PDO::FETCH_OBJ);
  $total = 0;
  foreach($money as $mor){
    $total += $mor->price;
  }
  $op = $conn->query("SELECT COUNT(*) AS total FROM users");
  $useres = $op->fetch(PDO::FETCH_OBJ);
  
  $op = $conn->query("SELECT o.* ,CONCAT(u.first_name,' ', u.last_name) AS username FROM orders o JOIN users u ON o.user_id = u.id ORDER BY o.created_at DESC limit 3");
  $orders = $op->fetchAll(PDO::FETCH_OBJ);
  
  $op =  $conn->query("SELECT sum(o.quantity) as total,p.name FROM order_items o INNER JOIN products p on o.product_id = p.id GROUP BY  p.name order by total desc LIMIT 3");
  $tops = $op->fetchAll(PDO::FETCH_OBJ);
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaHA Dashbord</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/duotone.css"/>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/brands.css"/>
    <link rel="stylesheet" href="../css/adminstyle.css">
    
</head>
<body>
  <div class="">
    <div class="d-flex ">
        <?php include '../includes/sidebar.php'; ?>

    <div class="content p-4 main">
        <div>
            <h1>Dashbord</h1>
            <p>Welcome to dashbord</p>            
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-3">
            <div class="card text-center">
              <div class="card-body">
                <div style="background-color: rgb(223, 130, 0);" class="icn mb-3 m-auto">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
                <h6 class="card-title">Total Sales</h6>
                <h4>$ <?php echo $total ?></h4>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center">
              <div class="card-body">
                <div style="background-color: rgb(129, 18, 203);" class="icn mb-3 m-auto">
                    <i class="fa-regular fa-cart-shopping"></i>
                </div>
                <h6 class="card-title">Total Orders</h6>
                <h4><?php echo $order->total ?></h4>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center">
              <div class="card-body">
                <div style="background-color: rgb(1, 160, 1);" class="icn mb-3 m-auto">
                    <i class="fa-regular fa-users"></i>
                </div>
                <h6 class="card-title">Total Users</h6>
                <h4><?php echo $useres->total ?></h4>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card text-center">
              <div class="card-body">
                <div style="background-color: rgb(34, 88, 204);" class="icn mb-3 m-auto">
                    <i class="fa-regular fa-box"></i>
                </div>
                <h6 class="card-title">Total Products</h6>
                <h4><?php echo $row->total ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div class="row g-3">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-light">Top Selling Products</div>
              <ul class="list-group list-group-flush">
                <?php foreach($tops as $top){ ?>
                  <li class="list-group-item"><?php echo $top->name ?> - <?php echo $top->total ?> units sold</li>
                <?php } ?>
              </ul>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-light">Recent Orders</div>
              <ul class="list-group list-group-flush">
                <?php foreach($orders as $order){ ?>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    Order #<?php echo $order->id?> - <?php echo $order->username?>
                    <span class="badge <?php echo $order->status?>"><?php echo $order->status?></span>
                  </li>
                <?php }?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
  const hide = ()=>{
    document.querySelector(".sidebar").classList.toggle('show');
  }
</script>
</html>
