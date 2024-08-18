<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to add items to your cart";
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "purna_variety_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['productId'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = '$user_id' AND product_id = '$product_id'";
} else {
    $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', 1)";
}

if ($conn->query($sql) === TRUE) {
    echo "Product added to cart";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
