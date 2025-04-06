<?php

$requestURL = trim($_SERVER['REQUEST_URI'], '/');

if ($requestURL === 'ecommerce/addproduct' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['name']) && isset($_POST['description']) &&
        isset($_POST['price']) && isset($_POST['category']) &&
        isset($_FILES['image'])
    ) {
        echo json_encode(addproduct($_POST));
        exit;
    } else {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        exit;
    }
}