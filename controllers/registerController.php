<?php
require_once '../models/user.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new User();
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];
    $user->role = $_POST['role'];

    if($user->register()) {
        $message = "Registration successful!";
    } else {
        $message = "Registration failed.";
    }
    include '../views/register.php';
}
