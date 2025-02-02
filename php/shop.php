<?php
require_once 'start.php';

$pageParams["nome"] = "../pages/viewProducts.php";
$pageParams["randProducts"] = $db->getRandomProduct(9);
require '../pages/base.php';
?>