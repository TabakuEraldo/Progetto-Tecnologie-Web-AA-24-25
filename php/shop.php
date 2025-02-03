<?php
require_once '../php/start.php';

$pageParams["nome"] = "../pages/viewProducts.php";
$pageParams["products"] = $db->getRandomProduct(9);

/*if ($_SERVER["REQUEST_METHOD"] == "GET" && $_GET["search"] != null){
    echo $_GET["search"];
}
else{
}*/

require '../pages/base.php';
?>
