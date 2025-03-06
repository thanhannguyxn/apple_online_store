<?php
include('db.php');

// Ensure the 'orders' table exists
$table_creation_query = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    product_name VARCHAR(255) NOT NULL,
    product_color VARCHAR(100) NOT NULL,
    product_storage VARCHAR(100) NOT NULL
)";
$conn->query($table_creation_query);

// Get the raw JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!$data || !isset($data['firstname'], $data['lastname'], $data['email'], $data['phone'], $data['address'], $data['product'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid input data. Missing required fields.'
    ]);
    http_response_code(400); 
    exit;
}

// Sanitize input data
$firstname = filter_var(trim($data['firstname']), FILTER_SANITIZE_STRING);
$lastname = filter_var(trim($data['lastname']), FILTER_SANITIZE_STRING);
$email = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
$phone = filter_var(trim($data['phone']), FILTER_SANITIZE_STRING);
$address = filter_var(trim($data['address']), FILTER_SANITIZE_STRING);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid email format.'
    ]);
    http_response_code(400); 
    exit;
}

// Validate phone number
if (!preg_match('/^\+?\d{10,15}$/', $phone)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid phone number format.'
    ]);
    http_response_code(400); 
    exit;
}

// Extract product details
$product = $data['product'];
if (!isset($product['name'], $product['color'], $product['storage'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid product data. Missing product details.'
    ]);
    http_response_code(400); 
    exit;
}

// Sanitize product data
$product_name = filter_var(trim($product['name']), FILTER_SANITIZE_STRING);
$product_color = filter_var(trim($product['color']), FILTER_SANITIZE_STRING);
$product_storage = filter_var(trim($product['storage']), FILTER_SANITIZE_STRING);

// Insert order into the database
$sql = "INSERT INTO orders (firstname, lastname, email, phone, address, product_name, product_color, product_storage)
        VALUES ('$firstname', '$lastname', '$email', '$phone', '$address', '$product_name', '$product_color', '$product_storage')";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Order placed successfully!'
    ]);
    http_response_code(200); 
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error: ' . $conn->error
    ]);
    http_response_code(500); 
}

// Close database connection
$conn->close();
?>






