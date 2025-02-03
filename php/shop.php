<?php
require_once '../php/start.php';

$pageParams["nome"] = "../pages/viewProducts.php";

if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["search"] != null){
    echo $_GET["search"];
}
else{
    $pageParams["products"] = $db->getRandomProduct(9);
}

//require '../pages/base.php';
?>
