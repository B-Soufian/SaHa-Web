<?php 
session_start();
    include 'includes/functions.php';

        $conn = coonect();      
        $req = "select * from products WHERE is_featured = 1";
        $op = $conn->prepare($req);
        $op->execute();
        $products=$op->fetchAll(PDO::FETCH_OBJ);

        $req = "SELECT COUNT(id) as total ,category FROM `products` GROUP by category  ORDER by total desc";
        $op = $conn->prepare($req);
        $op->execute();
        $stock=$op->fetchAll(PDO::FETCH_OBJ);
        $icones = [
            "Main Courses"=>"fa-light fa-turkey",
            "Moroccan Desserts"=>"fa-regular fa-cookie",
            "Salads"=>"fa-regular fa-salad",
            "Beverages"=>"fa-regular fa-glass"
        ];
        
    
    
?>
<!DOCTYPE html>
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
<body id="home">
    <?php include 'includes/header.php'; ?>

    <section class="position-relative hero overflow-hidden " id="Home">
        <video class="position-absolute w-100 h-100 object-fit-cover" autoplay loop muted>
            <source src="media/backdrop.mp4" type="video/mp4">
        </video>
        <div class="position-absolute w-100 h-100 bg-dark bg-opacity-25 d-flex justify-content-center align-items-center text-white">
            <div class="p-5 ">
                <h1 class="left  display-3 fw-bold">Taste the Magic of</h1>
                <h1 class="right display-3 fw-bold">Moroccan Dishes</h1>
                <p class=" lead pop ">Discover the authentic flavors of Morocco with our delicious dishes : <br>  tajine , couscous... Freshly prepared, full of spices, and delivered to your door!</p>
                <button class="left btn btn-success btn-lg  px-4">Order <span><i  class="ms-2 fa fa-arrow-right"></i></span> </button>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container ">
            <h1 class=" h1 text-center my-5 fw-bold">Categories</h1>
            <div class="row text-center gap-5 d-flex my-5 align-items-center justify-content-center"> 
                <?php foreach($stock as $s){ ?>
                <div class="shows col-md-2 shadow p-3 rounded-4 ">
                    <i class="<?php echo $icones[$s->category]?> fs-1 mb-2 text-success"></i>
                    <p class="mb-1 fw-bold"><?php echo $s->category?> </p>
                    <p><?php echo $s->total ?> itme</p>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section id="Dishes" class="py-5">
        <div class="container ">
            <h1 class=" h1 text-center my-5 fw-bold">Featured Dishes</h1>
            <div class="row gap-3 d-flex align-items-center justify-content-center my-5">

            <?php foreach($products as $prd){ ?>
                <div class="shows col-md-3">
                    <div class="card ">
                        <img src="<?php echo $prd->image ?>" style="height: 200px;" class="card-img-top object-fit-cover" alt="food">
                        <div class="card-body ">
                          <h5 class="card-title"><?php echo $prd->name ?></h5>
                          <p class="card-text fw-bold text-success fs-4 mb-2">$<?php echo $prd->price ?></p>
                          <a href="add_product.php?id=<?php echo $prd->id?>"  class="btn btn-success">Add To Cart</a>
                        </div>
                      </div>
                </div>
            <?php }?>

                

                
            </div>
        </div>

    </section>


   <section class="py-5">
        <h1 class="fw-bold text-center mb-5">Customers Review</h1>
        <div class="container my-5">

            <div id="testimonialCarousel" class="carousel slide carousel-dark w-75 mx-auto" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner ">
                    
                    <div class="carousel-item active  ">
                        <div class="card p-3 w-75 mx-auto border rounded-4 shadow">
                        <div class="text-center position-relative">
                            <i class="fa-solid fa-quote-right text-success qtsl"></i>
                            <img class="rounded-circle mb-2" src="images/revieww.jpeg" alt="" style="width: 80px; height: 80px; object-fit: cover;">
                            <p class="my-3 fs-5 text-secondary">"Lmakla bnina bzaaf w t9dim mezian. 9drt ndir commande b zarba w wslo lia l makan f lwaqt!"</p>
                            <div>
                            <h5 class="fw-bold">Sarah Dahbi</h5>
                            <div class="text-warning my-3">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            </div>
                            <i class="fa-solid fa-quote-right text-success qtsr" ></i>
                        </div>
                        </div>
                    </div>
                
                    <div class="carousel-item ">
                        <div class="card p-3 w-75 mx-auto border rounded-4 shadow">
                        <div class="text-center position-relative">
                            <i class="fa-solid fa-quote-right text-succes qtsl"></i>
                            <img class="rounded-circle mb-2" src="images/reviewma.jpeg" alt="" style="width: 80px; height: 80px; object-fit: cover;">
                            <p class="my-3 fs-5 text-secondary">"Tajine dialhoum khater! Rah b7al makla dyal ldar. Ghadi n3awd njarb"</p>
                            <div>
                            <h5 class="fw-bold">Lhaj Michael</h5>
                            <div class="text-warning my-3">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            </div>
                            <i class="fa-solid fa-quote-right text-success qtsr"></i>
                        </div>
                        </div>
                    </div>
                
                    <div class="carousel-item ">
                        <div class="card p-3 w-75 mx-auto border rounded-4 shadow">
                        <div class="text-center position-relative">
                            <i class="fa-solid fa-quote-right text-success qtsl"></i>
                            <img class="rounded-circle mb-2" src="images/review.jpeg" alt="Customer 3" style="width: 80px; height: 80px; object-fit: cover;">
                            <p class="my-3 fs-5 text-secondary">"Jrbt l couscous men 3ndkom w b9it mdawekh. ta3m original bzaaf!"</p>
                            <div>
                            <h5 class="fw-bold">Hamid Alawi</h5>
                            <div class="text-warning my-3">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                            </div>
                            <i class="fa-solid fa-quote-right text-success qtsr"></i>
                        </div>
                        </div>
                    </div>
                </div>
            
                <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>


    <!-- <footer class="text-center py-3 bg-success text-white fw-bold fs-5">
        <p class="mb-0">© 2024 Soufian. All rights reserved.</p>
    </footer> -->


    <?php include 'includes/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>

