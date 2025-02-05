<?php
require_once 'start.php';

$products = [];

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchTerm = $_GET['search'];
    $products = $db->searchProducts($searchTerm);
} else {
    $products = $db->getRandomProduct(9);
}

$pageParams["products"] = $products;
$pageParams["nome"] = "../pages/viewProducts.php";
require '../pages/base.php';
?>