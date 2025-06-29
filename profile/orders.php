<?php
include '../includes/functions.php';
session_start();
check_user();
    try{
        $conn = coonect();
        $user_id =$_SESSION["user_id"] ;
        $req = "select * from orders WHERE user_id = :uid order by created_at desc";
        $op = $conn->prepare($req);
        $op->execute([":uid"=>$user_id]);
        $order = $op->fetchAll(PDO::FETCH_OBJ);
        
        
        $reqp = "select p.name ,ot.order_id from orders o JOIN order_items ot on o.id = ot.order_id JOIN products p on p.id = ot.product_id WHERE o.user_id = :uid ;";
        $opp = $conn->prepare($reqp);
        $opp->execute([":uid"=>$user_id]);
        $products = $opp->fetchAll(PDO::FETCH_OBJ);


    }
    catch(PDOException $e){
        echo "Problème de connexion ".$e->getMessage();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaHA</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/duotone.css"/>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/brands.css"/>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="profile">
    <header class=" bg-light mb-3">
        <div class="container d-flex p-2 flex-wrap">
            <div class="d-flex align-items-center">
                <a href="../index.php" class="btn"><i class="fa-regular fa-arrow-left-to-line"></i> Back</a>
            </div>
            <div class="d-flex align-items-center">
                <a class="navbar-brand me-3 mb-1 text-success fw-bold fs-2" href="#">SaHa</a>
            </div>
            <div>
                <h5 class="m-0 mt-3 fw-bold ">My Profile</h5>
                <p class="text-muted small">Manage your account settings</p>
            </div>
            <div class="d-flex align-items-center ms-auto me-5" >
                <div class="dropdown">
                    <a class="profimg" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <h5 class="rounded-circle bg-success text-white fs-4 border p-2">SB</h5>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="nav-item "><a class="dropdown-item" href="profile.php"><i class="fa-light fa-user"></i> Profile</a></li>
                        <li class="nav-item "><a class="dropdown-item"  href="orders.php"><i class="fa-light fa-clock"></i> Orders</a>
                        <li class="nav-item "><a class="dropdown-item" href="../lougout.php"><i class="fa-regular fa-arrow-left-to-line"></i> Loug-out</a>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <section >
        <div class="row">
            <div class="col-12 shadow rounded-3 p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold">Order History</h4>
                </div>
                <div class="orders">
                    <?php foreach($order as $prodc){?>
                    <div class="order border rounded-2 p-4 my-2">
                        <div class="d-flex justify-content-between flex-wrap mb-2">
                            <div>
                                <p class="fw-bold m-0">Order #ORD-<?php echo  $prodc->id ?></p>
                                <p class="text-muted small m-0"><?php $dt = $prodc->created_at; echo date("d/m/y H:i" , strtotime($dt)) ?></p>
                            </div>
                            <div class="d-flex align-items-center flex-wrap gap-3">
                                <p class=" m-0 border rounded-4 <?php echo $prodc->status?> text-center px-3 py-1" style=" width: fit-content"><?php echo $prodc->status?></p>
                                <p class="fw-bold m-0">$<?php echo  $prodc->price ?></p>
                            </div>
                        </div>
                        <div>
                            <?php foreach($products as $n){
                                if ($n->order_id == $prodc->id) {
                                ?>
                            <span class="badge p-2 my-1 bg-opacity-75 rounded-pill text-bg-secondary "><?php echo $n->name; ?></span>
                            <?php }}?>
                        </div>
                    </div>
                     <?php }?>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</html>