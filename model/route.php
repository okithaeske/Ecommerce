<?php

$requestURL = trim($_SERVER['REQUEST_URI'], '/');

include "../controller/add_product.php";

if ($requestURL === 'ecommerce/adduser' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['category'])) {
        echo json_encode(addproduct($_POST));
        exit;
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Missing required fields"
        ]);
        exit;
    }

}
