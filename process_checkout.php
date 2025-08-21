<?php
session_start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: checkout.php');
    exit();
}


if (empty($_SESSION['cart'])) {
    echo "Your cart is empty.";
    exit();
}


$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}


$phone_number = $conn->real_escape_string($_POST['phone_number'] ?? '');
$first_name   = $conn->real_escape_string($_POST['first_name'] ?? '');
$last_name    = $conn->real_escape_string($_POST['last_name'] ?? '');
$address      = $conn->real_escape_string($_POST['address'] ?? '');
$city         = $conn->real_escape_string($_POST['city'] ?? '');
$save_info    = isset($_POST['save_info']) ? 1 : 0;


if (empty($phone_number) || empty($first_name) || empty($last_name) || empty($address) || empty($city)) {
    echo "Please fill out all required fields.";
    exit();
}


$subtotal = 0;
foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}
$shipping = 40.00; 
$total = $subtotal + $shipping;


$order_stmt = $conn->prepare("
    INSERT INTO orders (first_name, last_name, phone, address, city, subtotal, shipping, total, created_at) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
");
if (!$order_stmt) {
    die("Order prepare failed: " . $conn->error);
}
$order_stmt->bind_param("sssssddd", $first_name, $last_name, $phone_number, $address, $city, $subtotal, $shipping, $total);

if (!$order_stmt->execute()) {
    die("Error inserting order: " . $order_stmt->error);
}
$order_id = $order_stmt->insert_id;
$order_stmt->close();


$item_stmt = $conn->prepare("
    INSERT INTO order_items (order_id, product_id, name, price, quantity, size, color) 
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
if (!$item_stmt) {
    die("Order items prepare failed: " . $conn->error);
}

foreach ($_SESSION['cart'] as $item) {
    $pid   = $item['id'];
    $name  = $item['name'];
    $price = $item['price'];
    $qty   = $item['quantity'];
    $size  = $item['size'] ?? '';
    $color = $item['color'] ?? '';

    $item_stmt->bind_param("issdiss", $order_id, $pid, $name, $price, $qty, $size, $color);

    if (!$item_stmt->execute()) {
        die("Error inserting item: " . $item_stmt->error);
    }
}
$item_stmt->close();
$conn->close();

unset($_SESSION['cart']);


header("Location: .khalti/checkout.php?order_id=" . $order_id);
exit();
?>
