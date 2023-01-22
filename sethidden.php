<?php
require "header.php";
if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $products = new CProducts;
    $products->setHidden($pdo, $_GET['id']);
}