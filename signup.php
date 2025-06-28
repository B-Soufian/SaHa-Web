<?php
session_start();
    include 'includes/functions.php';
    
$error = "";
function check_email($email) {
    $access_key = 'c4fe2113466d2bddc391c09e867c73a2';
    $url = "http://apilayer.net/api/check?access_key=$access_key&email=".urlencode($email)."&smtp=1&format=1";
    $response = file_get_contents($url);
    $result = json_decode($response, true);
    return ($result['format_valid'] && $result['smtp_check']);
}
try {
    $conn = coonect(); 
    if(($_SERVER['REQUEST_METHOD'] == 'POST')){
        $first_name = $_POST["first_name"];
        $last_name = $_POST["last_name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $password = $_POST["pass"];
        $passconf = $_POST["confpass"];
        if (!check_email($email)) {
            $error = "Invalid email address<br>";
        }
        $req = "SELECT * FROM `users` WHERE email = :email";
        $op = $conn->prepare($req);
        $op->execute([":email"=>$email]);
        $found = $op->fetch(PDO::FETCH_OBJ);
        if($found){
            $error .= "This email is already in use<br>";
        }
        if(!($password == $passconf)){
            $error .= "Passwords do not match<br>";
        }
        if (!is_numeric($phone)) {
            $error .= "Phone number must contain only numbers";
        } elseif (strlen($phone) < 8 || strlen($phone) > 15) {
            $error .= "Phone number must be between 8 and 15 digits";
        }
        if(empty($error)){
            $req = "INSERT into users(first_name,last_name,email,phone,address,password) VALUES(:first_name,:last_name,:email,:phone,:address,:pass)";
            $op = $conn->prepare($req);
            $op->execute([":first_name"=>$first_name,
                ":last_name"=>$last_name,
                ":email"=>$email,
                ":phone"=>$phone,
                ":address"=>$address,
                ":pass"=>$password]);
            $_SESSION["user_id"] = $conn->lastInsertId();;
            header("location:welcom.php?user=$first_name-$last_name");
        }
    }
} catch (PDOException $e) {
    echo "Problème de connexion " . $e->getMessage();
}
?>
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
<body class="blog">
    <div class="login-container">
        <div class="login-header">
            <i class="fa-solid fa-hat-chef fa-2x mb-2"></i>
            <h1>SaHa</h1>
            <p>Join us for authentic Moroccan flavors</p>
        </div>
        <form method="post">
            <div class="row">
                <div class="mb-3 position-relative col-6 pe-0">
                    <i class="fa-regular fa-user icon iconhaf"></i>
                    <input type="text" class="form-control form-icn" placeholder="Frist Name" name="first_name" required>
                </div>
                <div class="mb-3 position-relative col-6">
                    <i class="fa-regular fa-user icon iconhaf"></i>
                    <input type="text" class="form-control form-icn" placeholder="Last Name" name="last_name" required>
            </div>
            </div>

            <div class="mb-3 position-relative">
                <i class="fa-regular fa-envelope icon"></i>
                <input type="email" class="form-control form-icn" placeholder="Enter your email" name="email" required>
            </div>

            <div class="mb-3 position-relative">
                <i class="fa-regular fa-phone icon"></i>
                <input type="text" class="form-control form-icn" placeholder="Enter your phone" name="phone">
            </div>

            <div class="mb-3 position-relative">
                <i class="fa-regular fa-location-dot icon"></i>
                <input type="text" class="form-control form-icn" placeholder="Enter your address" name="address">
            </div>
            
            <div class="mb-3 position-relative">
            <i class="fa-regular fa-lock icon"></i>
            <input type="password" class="form-control form-icn" id="passinput" placeholder="Enter your password" name="pass" required>
            <span class="icon" id="show"> 
                <i class="fa fa-eye"></i>
            </span>
        </div>
        <div class="mb-3 position-relative">
            <i class="fa-regular fa-lock icon"></i>
            <input type="password" class="form-control form-icn" id="passcnfinput" placeholder="Confirme your password" name="confpass" required>
            <span class="icon" id="showcnf"> 
                <i class="fa fa-eye"></i>
            </span>
        </div>

            <div class="service-agre">
            <input class="form-check-input" type="checkbox" id="agree" required>
            <label class="form-check-label" for="agree">I agree to the <a href="">Terms of Service</a> and <a href="">Privacy Policy</a> </label>
            </div>

        <button type="submit" class="btn btn-success w-100 mb-3">Sign In</button>
        <?php if (!empty($error)): ?>
                <div style="color: red;"><?php echo $error; ?></div>
        <?php endif; ?>
        <div class="divider"><span>Or</span></div>

        

        <p class="text-center text-muted">Already have an account?
            <a href="logine.php" class="text-success fw-semibold text-decoration-none"> Sign in here</a>
        </p>
        </form>
  </div>

</body>
<script>
  const showPassword = document.getElementById('show')
  const passwordInput = document.getElementById('passinput')
  const showCnfPassword = document.getElementById('showcnf')
  const passwordCnfInput = document.getElementById('passcnfinput')

  showPassword.addEventListener('click', function () {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password'
    passwordInput.setAttribute('type', type)

    this.querySelector('i').classList.toggle('fa-eye')
    this.querySelector('i').classList.toggle('fa-eye-slash')
  })

  showCnfPassword.addEventListener('click', function () {
    const type = passwordCnfInput.getAttribute('type') === 'password' ? 'text' : 'password'
    passwordCnfInput.setAttribute('type', type)

    this.querySelector('i').classList.toggle('fa-eye')
    this.querySelector('i').classList.toggle('fa-eye-slash')
  })
</script>
</html>
