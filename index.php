<?php
require_once "header.php";

$limit = 20;
$products = new CProducts();
$result = $products->getProducts($pdo, $limit);

include "index.phtml";