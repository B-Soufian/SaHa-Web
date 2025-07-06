<?php
    function connect(){
        $host = 'DB_HOST';
        $db = 'DB_NAME';
        $user = 'DB_USER';
        $pass = 'DB_PASS';
        try {
            $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
            return $conn;
        } catch (PDOException $e) {
            echo "Err : " . $e->getMessage();
            exit;
        }
    }
    function check_admin(){
        if(empty($_SESSION["admin_id"])){
            $_SESSION['error'] = "You are not admin";
            header("location:../logine.php");
            exit;
        }
    }
    function check_user(){
    if(empty($_SESSION["user_id"])){
        echo "<script>
                if (confirm('You are not logged in. Do you want to log in now?')) {
                    window.location.href = 'logine.php'
                }
                else{
                    window.location.href = 'cart.php'
                }
            </script>";
        exit;
    }
}
?>
