<?php
// AdminController.php

require_once 'models/UserModel.php';
require_once 'models/ProductModel.php';
require_once 'models/OrderModel.php';

class AdminController
{
    public function dashboard()
    {
        // Instantiate models
        $userModel = new User();
        $productModel = new ProductModel();
        $orderModel = new OrderModel();

        // Fetch data using model methods
        $totalUsers = $userModel->getTotalUsers();
        $totalOrders = $orderModel->getTotalOrders();
        $revenue = $orderModel->getRevenue();

        // Fetch lists for the admin sections (users, products, orders)
        $userList = $userModel->getUsers();
        $productList = $productModel->getProducts();
        $orderList = $orderModel->getOrders();
        

        // Include the view and pass the data
        include 'admin\admin_dashboard.php';
    }
    
  public function deleteUser()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $userId = $_POST['delete_id'];
        $userModel = new User();
        $userModel->deleteUser($userId);

        // Redirect back to the dashboard after deletion
        header('Location: admin_dashboard');
        exit();
    }
}
}
