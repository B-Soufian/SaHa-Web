<?php
    function coonect(){
        return $conn = new PDO("mysql:host=localhost;port=3308;dbname=maroccan", "root", "");
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