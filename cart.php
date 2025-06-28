<?php
    session_start();
    $cart = $_SESSION['cart'] ?? [];
    $total = 0;
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
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>

    <?php if(!empty($cart)){ ?>
        <section>
        <div class="container my-3">
            <div class="row gap-2 ">
                <h1 class="fw-bold ">Shopping Cart</h1>
                
                <div class="col-md-8">
                    <?php
                        $total = 0;
                        foreach ($cart as $item){
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                    ?>
                    <div class="p-3 d-flex flex-1 gap-4 shadow-sm rounded-3 position-relative">
                        <img src="<?php echo $item["image"]?>" class="border rounded-3 mx-2" style="width:130px; height: 130px; object-fit: cover; " alt="">
                        <div class="mt-2">
                            <h4 class=" mb-1"><?php echo $item["name"];?></h4>
                            <span class="text-secondary fw-bold ">$<?php echo $subtotal?></span>
                            <div>
                                <td>
                                    <a href="update_cart.php?action=decrease&id=<?= $item['id'] ?>">
                                        <i class="text-danger fa-solid fa-square-minus"></i>
                                    </a>

                                    <span class="fw-bold mx-2 fs-5"><?= $item["quantity"]; ?></span>

                                    <a href="update_cart.php?action=increase&id=<?= $item['id'] ?>">
                                        <i class="text-success fa-solid fa-square-plus"></i>
                                    </a>
                                </td>
                            </div>
                        </div>
                        <a href="update_cart.php?action=delet&id=<?= $item['id'] ?>">
                            <i class="position-absolute fa-regular fa-trash-can fs-5 text-danger" style="right: 5%;bottom: 30%"></i>
                        </a>

                    </div>
                    <?php }; ?>
                </div>



                <div class="col-md-3 shadow-sm p-4 rounded-3">
                    <h3 class="fw-bold text-success">Orders Total</h3>
                    <div class="position-relative">
                        <span>Subtotal</span>
                        <span class="position-absolute" style="right: 0;">$<?php echo $total?></span>
                    </div>
                    <div class="position-relative mt-2">
                        <span>Tax</span>
                        <span class="position-absolute" style="right: 0;">$0</span>
                    </div>
                    <hr>
                    <div class="position-relative mt-2">
                        <span class="fw-bold">Total</span>
                        <span class="position-absolute fw-bold" style="right: 0;">$<?php echo $total?></span>
                    </div>
                    <div >
                        <a class="mt-3 text-white  fs-5 btn btn-success  rounded-3 w-100 " href="checkoute.php">Order Now</a>
                    </div>
                </div>
            </div>
        </div>
        </section>
    <?php } else{?>
        <section class="carts p-5">
            <div class="container my-3 p-5">
                <div class="cart">
                    <div style="width:50px ;height:50px;padding:30px" class="rounded-circle my-2 text-white bg-success d-flex justify-content-center align-items-center m-auto">

                        <i class=" fa-solid fa-cart-shopping fs-3" ></i>
                    </div>
                </div>
                <h1 class="text-center">Your Cart is Empty</h1>
                <p class="text-center">Looks like you haven't added any product to your cart yet.</p>
                <div class="p-3 d-flex align-items-center justify-content-center gap-3">
                    <a href="menu.php" class="btn btn-success  py-2 px-4"> Browse Menu</a>
                </div>
            </div>
        </section>
    <?php }?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

</body>
