<?php session_start();?>
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

    <section class="bg-success ">
        <div class="container p-4 ">
            <h1 class="display-5 text-white fw-bold left">About Us</h1>
            <p class="w-75 text-white left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse fugiat nostrum odio fuga dolorum non ipsam provident cupiditate dicta quisquam vitae repellendus quasi incidunt voluptatibus similique quo culpa nemo ullam quae, cum sunt praesentium modi consequuntur. Quibusdam libero cumque explicabo repellendus iure, autem debitis eos veniam quo officia obcaecati porro!</p>
        </div>
    </section>

    <section>
        <div class="container pt-4">
            <div class="row d-flex justify-content-center overflow-hidden">
                <div class="col-md-3">
                    <div class=" text-center p-3 m-2 feat move" style="animation-delay: 0s; opacity: 0;">
                        <i class="text-success p-2 fs-2 fa-solid fa-truck"></i>
                        <h4 class="m-2 fw-bold">Free Shipping</h4>
                        <p >Lorem ipsum dolor sit amet</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class=" text-center p-3 m-2 feat move" style="animation-delay: 0.2s; opacity: 0;">
                        <i class="text-success p-2 fs-2  fa-solid fa-clock"></i>
                        <h4 class="m-2 fw-bold">Fast Delivery</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class=" text-center p-3 m-2 feat move" style="animation-delay: 0.4s; opacity: 0;">
                        <i class="text-success p-2 fs-2  fa-solid fa-medal"></i>
                        <h4 class="m-2 fw-bold">Premium Quality</h4>
                        <p>Lorem ipsum dolor sit amet.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class=" text-center p-3 m-2 feat move" style="animation-delay: 0.6s; opacity: 0;">
                        <i class="text-success p-2 fs-2  fa-solid fa-users-medical"></i>
                        <h4 class="m-2 fw-bold w-100">Customer Support</h4>
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-body-tertiary pt-3">
        <div class="container d-flex justify-content-center pb-5">
            <div class="w-75 text-center">
                <h1 class="h1 text-center my-3 fw-bold pop">Story</h1>
                <p class="pop">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ratione, veritatis, et cupiditate fuga sunt perferendis iure facere eveniet, esse suscipit officiis amet sequi ipsa nisi rerum quos recusandae quas fugit quo possimus minus alias laboriosam laudantium odit. Ipsam, veritatis voluptatibus.</p>
                <p class="pop">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti mollitia blanditiis amet non earum minima totam, ad vitae? Possimus, dolor.</p>
            </div>
        </div>
    </section>

    <section>
        <div class="container ">
            <div class="row h-75 align-items-center">

                <div class="col-md-6 accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Do you offer vegetarian/vegan options?
                            </button>
                          </h2>
                          <div id="flush-collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Yes! Moroccan cuisine naturally includes many vegetarian and vegan dishes. We offer a wide selection of plant-based options like vegetable tagines, couscous with seven vegetables, zaalouk (eggplant dip), and various salads. Many of our dishes can also be modified to accommodate dietary preferences - just ask!</div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                What makes Moroccan cuisine unique?
                            </button>
                          </h2>
                          <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Moroccan cuisine is a rich blend of Berber, Arabic, Mediterranean, and French influences. Our dishes feature distinctive combinations of spices like saffron, cumin, coriander, and cinnamon, along with fresh herbs and unique cooking methods. The use of tagines (traditional clay cooking pots) helps create tender, flavorful dishes that are both healthy and delicious.</div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header">
                            <button class="accordion-button collapsed fw-bold text-success" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                What are your most popular dishes?                            </button>
                          </h2>
                          <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"> Our customers particularly love our traditional couscous royal, lamb tagine with prunes and almonds, chicken tagine with preserved lemon and olives, and our authentic Moroccan pastries. Our mint tea service is also a customer favorite!</div>
                          </div>
                        </div>
                </div>
                <div class="col-12 col-md-6 ">
                    <img src="images/res.jpg " class="rounded-4 w-100 h-75 object-fit-cover" alt="">
                </div>
            </div>
        </div>
    </section>
    

    <?php include 'includes/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>