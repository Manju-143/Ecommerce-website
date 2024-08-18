<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to remove items from your cart";
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
$cart_item_id = $data['cartItemId'];

$sql = "DELETE FROM cart WHERE id = '$cart_item_id'";

if ($conn->query($sql) === TRUE) {
    echo "Product removed from cart";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
