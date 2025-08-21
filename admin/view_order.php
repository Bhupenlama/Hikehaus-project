<?php

$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}


$order_id = intval($_GET['order_id'] ?? 0);
if ($order_id <= 0) {
    die("<p class='text-red-600 font-semibold'>Invalid order ID.</p>");
}

$order_stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$order_stmt->bind_param("i", $order_id);
$order_stmt->execute();
$order_result = $order_stmt->get_result();

if ($order_result->num_rows === 0) {
    die("<p class='text-red-600 font-semibold'>Order not found.</p>");
}
$order = $order_result->fetch_assoc();
$order_stmt->close();


$items_stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
$items_stmt->bind_param("i", $order_id);
$items_stmt->execute();
$items_result = $items_stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Order #<?= htmlspecialchars($order['id']) ?> - Details</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 p-10">
  <div class="max-w-4xl mx-auto bg-white shadow p-8 rounded-lg">
    <h2 class="text-2xl font-bold mb-6">Order #<?= htmlspecialchars($order['id']) ?> Details</h2>

    <div class="mb-6">
      <h3 class="text-lg font-semibold mb-2">Customer Information</h3>
      <p><strong>Name:</strong> <?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></p>
      <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
      <p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?>, <?= htmlspecialchars($order['city']) ?></p>
    </div>

    <div class="mb-6">
      <h3 class="text-lg font-semibold mb-2">Order Summary</h3>
      <ul class="list-disc list-inside space-y-1">
        <li><strong>Subtotal:</strong> ₹<?= number_format($order['subtotal'], 2) ?></li>
        <li><strong>Shipping:</strong> ₹<?= number_format($order['shipping'], 2) ?></li>
        <li><strong>Total:</strong> ₹<?= number_format($order['total'], 2) ?></li>
        <li><strong>Order Date:</strong> <?= htmlspecialchars($order['created_at']) ?></li>
      </ul>
    </div>

    <div>
      <h3 class="text-lg font-semibold mb-2">Ordered Products</h3>
      <div class="overflow-x-auto">
        <table class="w-full text-left border border-gray-200">
          <thead class="bg-gray-100">
            <tr>
              <th class="p-2 border">Product Name</th>
              <th class="p-2 border">Qty</th>
              <th class="p-2 border">Size</th>
              <th class="p-2 border">Color</th>
              <th class="p-2 border">Price</th>
              <th class="p-2 border">Total</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($item = $items_result->fetch_assoc()): ?>
              <tr class="border-t">
                <td class="p-2 border"><?= htmlspecialchars($item['name']) ?></td>
                <td class="p-2 border"><?= intval($item['quantity']) ?></td>
                <td class="p-2 border"><?= htmlspecialchars($item['size']) ?></td>
                <td class="p-2 border"><?= htmlspecialchars($item['color']) ?></td>
                <td class="p-2 border">₹<?= number_format($item['price'], 2) ?></td>
                <td class="p-2 border">₹<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="mt-6">
      <a href="orders.php" class="inline-block text-blue-600 hover:underline">← Back to Orders</a>
    </div>
  </div>
</body>
</html>
