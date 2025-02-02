<?php
//cosa cazzo succede se email o password non vanno bene?
require_once 'start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = $db->login($_POST['email'], $_POST['password']);

    if($result != null){
        $_SESSION['user_id'] = $result["ID"];
        $_SESSION['user_name'] = $result['nome'];
        $_SESSION['user_email'] = $result['email'];
        $_SESSION['user_role'] = $_POST['role'];
        header("Location: ../pages/viewProfile.php");
        exit();
    }
}
?>

