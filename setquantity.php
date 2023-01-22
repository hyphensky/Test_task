<?php
require "header.php";
if(isset($_POST['id']) && is_numeric($_POST['id'])) {
    $products = new CProducts;
    $products->setQuantity($pdo, $_POST['id'], $_POST['quantity']);
}