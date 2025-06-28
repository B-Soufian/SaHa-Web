<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SaHa</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"href="https://site-assets.fontawesome.com/releases/v6.5.1/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/sharp-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/duotone.css"/>
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.1/css/brands.css"/>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class=" container">
  <div class="welocom shadow rounded-4 p-5 m-5 mx-auto" style="width: 40%;">
    <div class="d-flex flex-column  align-items-center ">
      <i class="fa-solid fa-badge-check text-success mb-3" style="font-size: 5rem;"></i>
      <h2 class="fw-bold">Welcom To Saha</h2>
      <p class="text-center text-muted fw-light"><?php echo $_GET["user"] ?> Your account has been created succssfully. Get ready to explore authentic Moroccan flavors!</p>
    </div>
    <div class="">
        <p class="text-success text-center my-1 fw-medium"><i class="fa-regular fa-check"></i> Account verfied</p>
        <p class="text-success text-center my-1 fw-medium"><i class="fa-regular fa-check"></i> Ready to order</p>
    </div>
    <div>
        <a href="menu.php" class="btn btn-success w-100 py-2 mt-3">Start Shopping</a>
        <a href="profile/profile.php" class="btn btn-outline-success w-100 py-2 mt-3">Go to Profile</a>
    </div>
  </div>

</body>
</html>