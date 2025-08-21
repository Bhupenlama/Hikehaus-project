<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$order_id = isset($_GET['order_id']) ? (int)$_GET['order_id'] : 0;
if ($order_id <= 0) {
    die("Invalid or missing order ID.");
}

$stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Order not found.");
}
$order = $result->fetch_assoc();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Thank You - HIKE HAUS</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .thankyou-box {
      background-color: #ffffff;
      padding: 40px;
      max-width: 500px;
      width: 90%;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.06);
      text-align: center;
    }

    .thankyou-box h1 {
      color: #0a6847;
      font-size: 28px;
      margin-bottom: 10px;
    }

    .thankyou-box p {
      color: #333;
      font-size: 16px;
      margin: 8px 0;
    }

    .order-details {
      margin: 25px 0;
      text-align: left;
      padding: 20px;
      background: #f8f9fa;
      border-radius: 8px;
    }

    .order-details p {
      margin: 6px 0;
      font-size: 15px;
    }

    .order-details span {
      font-weight: 600;
      color: #111;
    }

    .buttons {
      margin-top: 25px;
      display: flex;
      justify-content: center;
      gap: 15px;
    }

    .buttons a {
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 6px;
      font-size: 14px;
      font-weight: 500;
      color: white;
      background-color: #0a6847;
      transition: background 0.3s ease;
    }

    .buttons a.secondary {
      background-color: #2b63d9;
    }

    .buttons a:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>
  <div class="thankyou-box">
    <h1>🎉 Thank You!</h1>
    <p>Your order was placed successfully.</p>
    <p>We will process it shortly.</p>

    <div class="order-details">
      <p><span>Order ID:</span> #<?= htmlspecialchars($order['id']) ?></p>
      <p><span>Name:</span> <?= htmlspecialchars($order['first_name']) . ' ' . htmlspecialchars($order['last_name']) ?></p>
      <p><span>Contact:</span> <?= htmlspecialchars($order['phone']) ?></p>
    </div>

    <div class="buttons">
      <a href="shop.php">Continue Shopping</a>
      <a href="view_order.php?order_id=<?= $order['id'] ?>" class="secondary">View Order</a>
    </div>
  </div>
</body>
</html>
