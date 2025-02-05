<?php
require_once 'start.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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