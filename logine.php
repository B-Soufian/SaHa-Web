<?php
    session_start();
    include 'includes/functions.php';
    try{
        $conn = coonect(); 
        $req = "SELECT * FROM `users` WHERE email = :email and password = :pass";
        $op = $conn->prepare($req);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $pass = $_POST["pass"];
            $email = $_POST["email"];
            $op->execute([":email"=>$email,":pass"=>$pass]);
            $usere = $op->fetch(PDO::FETCH_OBJ);
            if($usere){
              if($usere->statu == "Active"){
                $user_id = $usere->id;
                if($usere->role == "admin"){
                  $_SESSION["admin_id"] = $user_id;
                  header("location:admin/dash.php");
                }
                else{
                  $_SESSION["user_id"] = $user_id;
                  header("location:index.php");
                }
              }
              else{
                echo "<script>alert('soory you are banede contact the admin')</script>";
              }
            }
            else{
                echo "<script>alert('invalide password or email')</script>";
            }
        }
    }
    catch(PDOException $e){
        echo "Problème de connexion ".$e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="en">
   <?php
    if (!empty($_SESSION['error'])) {
        echo "<script>alert('{$_SESSION['error']}')</script>";
        unset($_SESSION['error']);
    }
  ?>
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
<body class="blog">

  <div class="login-container">
    <div class="login-header">
      <i class="fa-solid fa-hat-chef fa-2x mb-2"></i>
      <h1>SaHa</h1>
      <p>Authentic Moroccan Cuisine</p>
    </div>
    <form method="post">
      <div class="mb-3 position-relative">
        <i class="fa-regular fa-envelope icon"></i>
        <input type="email" class="form-control form-icn" placeholder="Enter your email" name="email" required>
      </div>

      <div class="mb-3 position-relative">
        <i class="fa-regular fa-lock icon"></i>
        <input type="password" class="form-control form-icn" id="passinput" placeholder="Enter your password" name="pass" required>
        <span class="icon" id="show"> 
            <i class="fa fa-eye"></i>
        </span>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="rememberMe">
          <label class="form-check-label" for="rememberMe">Remember me</label>
        </div>
        <a href="#" class="text-success text-decoration-none">Forgot password?</a>
      </div>

      <button type="submit" class="btn btn-success w-100 mb-3">Sign In</button>

      <div class="divider"><span>Or</span></div>

      

      <p class="text-center text-muted">Don't have an account?
        <a href="signup.php" class="text-success fw-semibold text-decoration-none">Sign up for free</a>
      </p>
    </form>
  </div>

</body>
<script>
  const togglePassword = document.getElementById('show')
  const passwordInput = document.getElementById('passinput')

  togglePassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password'
    passwordInput.setAttribute('type', type)

    this.querySelector('i').classList.toggle('fa-eye')
    this.querySelector('i').classList.toggle('fa-eye-slash')
  });
</script>
</html>
