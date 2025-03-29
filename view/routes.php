
<?php
// Purpose: This file is the main entry point for the API. It routes requests to the appropriate files.


$requestURL = trim($_SERVER['REQUEST_URI'], '/');

// If no route matches, return 404 error
http_response_code(404);
echo json_encode([
    "status" => "error",
    "message" => "Route not found"
]);

$routes = array(
    'ECOMMERCE/api' => 'index.php',
    'ECOMMERCE/api/about' => '/api/about.php',
    'ECOMMERCE/api/contact' => 'contact.php',
    'ECOMMERCE/api/products' => 'products.php' 
);
foreach ($routes as $rout) {
    if ($requestURL === $rout) {
        include $routes[$rout];
        exit;
    }
}