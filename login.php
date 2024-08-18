<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "purna_variety_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        echo "Login successful";
    } else {
        echo "Invalid password";
    }
} else {
    echo "No user found with this email";
}

$conn->close();
?>
