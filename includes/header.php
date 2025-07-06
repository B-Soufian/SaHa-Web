<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
        <div class="container py-4">
            <a class="navbar-brand me-5 mb-1 text-success fw-bold fs-2" href="#">SaHa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown" >
                        <a class="nav-link " href="menu.php" >
                            Menu
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>

                <div class="nav-icons d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center" >
                        <div class="dropdown">
                            <a class="h" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user text-success fs-4 "></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end ">
                                <?php if(isset($_SESSION["user_id"])){ ?>
                                    <li class="nav-item "><a class="dropdown-item" href="profile/profile.php"><i class="fa-light fa-user"></i> Profile</a></li>
                                    <li class="nav-item "><a class="dropdown-item"  href="profile/orders.php"><i class="fa-light fa-clock"></i> Orders</a>
                                    <li class="nav-item "><a class="dropdown-item" href="lougout.php"><i class="fa-regular fa-arrow-left-to-line"></i> Loug-out</a>
                                    <?php }else{?>
                                        <li class="nav-item "><a class="dropdown-item" href="logine.php"><i class="fa-light fa-user"></i> Login</a></li>
                                        <li class="nav-item "><a class="dropdown-item"  href="signup.php"><i class="fa-light fa-clock"></i> Signup</a>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <a href="cart.php" class="text-success fs-5 position-relative">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="position-absolute  translate-middle badge rounded-pill bg-danger" style="right: -110%; font-size: 0.7rem;">
                            <?php if(isset($_SESSION['cart'])){echo count($_SESSION['cart']);}else{echo "0";}  ?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </nav>