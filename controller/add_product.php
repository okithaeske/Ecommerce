<?php
include("../config/db.php");

function addproduct($data)
{
    $pdo = getDBConn();

    // Handle image upload
    $imagePath = "";
    if (!empty($_FILES['image']['name'])) {
        $targetDir = "../uploads/";
        $imagePath = $targetDir . basename($_FILES["image"]["name"]);

        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            return ["status" => "error", "message" => "Image upload failed"];
        }
    }

    $query = "INSERT INTO products (name, category, description, price, image, created_at) 
              VALUES (:name, :category, :description, :price, :image, NOW())";

    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':category', $data['category']);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':price', $data['price']);
    $stmt->bindParam(':image', $imagePath);

    if ($stmt->execute()) {
        return ["status" => "success", "message" => "Product created successfully"];
    } else {
        return ["status" => "error", "message" => "Product not created"];
    }
}
