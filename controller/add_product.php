<?php
include("../config/db.php");

function addproduct($data){

    $pdo = getDBConn();

    $query = "INSERT INTO products (name, category , description, price, created_at ) VALUES (:name, :category, :description, :price , :NOW())"; 
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':category', $data['category']);
    $stmt->bindParam('description', $data['decription']);
    $stmt->bindParam(':price', $data['price']);


    if ($stmt->execute()){
        return ["status" => "success", "message" => "Product created successfully"];
    }else{
        return ["status" => "error", "message" => "Product not created"];
    }

    
}