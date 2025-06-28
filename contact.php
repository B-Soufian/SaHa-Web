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

    <section>
        <div class="backd"></div>
        <div class="container pt-4">
            <div class="row justify-content-center">
                <div class="left col-md-5 p-3 m-3 shadow border rounded-3">
                    <h3 class="fw-bold">Get In Touch</h3>
                    <form>
                        <div class="mb-3">
                          <label for="Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="Name" placeholder="Name" required>
                        </div>

                        <div class="mb-3">
                          <label for="Email" class="form-label">Email</label>
                          <div class="input-group">
                            <span class="input-group-text fw-bold text-success" id="inputGroupPrepend ">@</span>
                            <input type="email" class="form-control" id="Email" aria-describedby="inputGroupPrepend" required>
                          </div>
                        </div>

                        <div class="mb-3">
                          <label for="Subject" class="form-label">Subject</label>
                          <input type="text" class="form-control" placeholder="How Can We Help ?" id="Subject" required>
                        </div>

                        <div class="mb-3">
                            <label for="validationTextarea" class="form-label">Message</label>
                            <textarea class="form-control" id="validationTextarea" placeholder="Your message.." required></textarea>
                          </div>

                        <div>
                          <button class="btn btn-success" type="submit">Submit form</button>
                        </div>
                      </form>
                </div>

                <div class="right col-md-5 p-3 m-3">
                    <h3 class="fw-bold">Contact Info</h3>

                    <div class="d-flex gap-3 align-items-center">
                        <i class="fs-2 mb-3 text-success fa-regular fa-location-dot"></i>
                        <div>
                            <p class="fw-bold m-0">Address</p>
                            <p>12938 Hay l3awd <br> Morocco, JM 15/37</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 align-items-center ">
                        <i class="fs-2 mb-3 text-success fa-regular fa-phone"></i>
                        <div>
                            <p class="fw-bold m-0">Phone</p>
                            <p>+212 629-879964</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 align-items-center">
                        <i class="fs-2 mb-3 text-success fa-regular fa-envelope"></i>
                        <div>
                            <p class="fw-bold m-0">Address</p>
                            <p>Soufian@gmail.com</p>
                        </div>
                    </div>
                    <div class=" bch bg-body-tertiary border h-25 border-2 rounded-4  d-flex align-items-center justify-content-center">
                        <h1 class="text-success fw-bold">WELCOM</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>