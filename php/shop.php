<?php
require_once 'start.php';

$pageParams["nome"] = "../html/viewProducts.php";
$pageParams["randProducts"] = $db->getRandomProduct(9);
require '../html/base.php';
?>