<?php
include '../includes/functions.php';
session_start();
check_user();
        $conn = coonect();
        $req = "select * from users WHERE id = :id";
        $id = $_SESSION["user_id"];
        $op = $conn->prepare($req);
        $op->execute([":id"=>$id]);
        $user=$op->fetch(PDO::FETCH_OBJ);
 
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
            <div class="image d-flex align-items-center ms-auto me-5" >
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
        <div class="row gap-4">
            <div class="col-12 shadow rounded-3 p-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold">Personal Information </h4>
                    <button class="btn btn-secondary mt-3"  id="editeprof" name="edite"><i class="fa-light fa-pen-line"></i> Edit Profile</button>
                </div>
                <form  method="">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="">First Name</label>
                            <input class="form-control" id="first_name" type="text" value="<?php echo $user->first_name ?>" disabled>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="">Last Name</label>
                            <input class="form-control"  id="last_name" type="text" value="<?php echo $user->last_name ?>" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="">Phone</label>
                            <input class="form-control"  id="phone" type="text" value="<?php echo $user->phone ?>" disabled>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="">Passowrd</label>
                            <input class="form-control"  id="password" type="password" value="<?php echo $user->password ?>" disabled>
                        </div>
                    </div>
                    <div class="">
                        <label class="form-label" for="">Email</label>
                        <input class="form-control"  id="email" type="email" value="<?php echo $user->email ?>" disabled>
                    </div>
                    <div>
                        <label class="form-label" for="">Address</label>
                        <input class="form-control"  id="address" type="text" value="<?php echo $user->address ?>" disabled>
                    </div>
                </form>
            </div>
            
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
    let actbtn = document.querySelector("#editeprof")
    let inputs = document.querySelectorAll("form input")
    isEditMode = false
    actbtn.addEventListener("click", function(){
        if(!isEditMode) {
            inputs.forEach(input => input.removeAttribute("disabled"))
            actbtn.innerHTML = '<i class="fa-light fa-floppy-disk"></i> Save'
            isEditMode = true
        } else {
            inputs.forEach(input => input.setAttribute("disabled", "disabled"))
            actbtn.innerHTML = '<i class="fa-light fa-pen-line"></i> Edit'
            isEditMode = false
            first_name = $("#first_name").val()
            last_name = $("#last_name").val()
            phone = $("#phone").val()
            password = $("#password").val()
            email = $("#email").val()
            address = $("#address").val()
            $.ajax({
                url: 'update_profile.php',
                type: 'POST',
                data: {
                    first_name: first_name,
                    last_name:last_name,
                    phone:phone,
                    password:password,
                    email:email,
                    address:address
                },
                success: function (response) {
                    console.log(response)
                },
                error: function () {
                    console.log('err')
                }
            })
        }
    })
</script>
</html>
