<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
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

$user_id = $_SESSION['user_id'];

$sql = "SELECT cart.id, products.name, products.price, cart.quantity FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = '$user_id'";

$result = $conn->query($sql);

$cart = array();
while($row = $result->fetch_assoc()) {
    $cart[] = $row;
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($cart);
?>
