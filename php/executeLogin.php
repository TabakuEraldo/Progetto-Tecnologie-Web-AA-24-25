<?php
//cosa cazzo succede se email o password non vanno bene?
require_once 'start.php';
$dove = "'fuori primo";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = $db->login($_POST['email']);
    $dove = "dopo login";
    if ($result->num_rows > 0){
        $dove = "dentro 2";
        $row = $result->fetch_assoc();
        if (password_verify($_POST['password'], $row['password'])) {
            $dove = "dentro 3";
            $_SESSION['user_id'] = $row["ID"];
            $_SESSION['user_name'] = $row['nome'];
            $_SESSION['user_cognome'] = $row['cognome'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_role'] = $_POST['role'];
            header("Location: ../pages/viewProfile.php");
            exit();
        }
    }
}
?>

<h1><?php echo $dove;?></h1>

