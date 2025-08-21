<?php
$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, first_name, last_name, phone, city, total FROM orders ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Orders List</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #f1f5f9;
      padding: 40px 20px;
      display: flex;
      justify-content: center;
    }

    .container {
      max-width: 1100px;
      width: 100%;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
    }

    .back-btn {
      display: inline-block;
      margin-bottom: 20px;
      padding: 10px 16px;
      background: #e2e8f0;
      color: #374151;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.3s ease;
    }

    .back-btn:hover {
      background: #cbd5e1;
    }

    h1 {
      font-size: 28px;
      color: #0a6847;
      margin-bottom: 24px;
      border-bottom: 2px solid #e5e7eb;
      padding-bottom: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      font-size: 15px;
      background: #fff;
    }

    th, td {
      padding: 14px 16px;
      border-bottom: 1px solid #e5e7eb;
      text-align: left;
    }

    th {
      background-color: #f9fafb;
      color: #374151;
      font-weight: 600;
    }

    tr:hover {
      background-color: #f3f4f6;
    }

    .action-link {
      color: #2563eb;
      text-decoration: none;
      font-weight: 500;
    }

    .action-link:hover {
      text-decoration: underline;
    }

    .no-orders {
      color: #6b7280;
      font-style: italic;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="admin-dashboard.php" onclick="history.back()" class="back-btn">← Back</a>
    <h1>Orders List</h1>

    <?php if ($result && $result->num_rows > 0): ?>
      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Phone</th>
            <th>City</th>
            <th>Total (₹)</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($order = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($order['id']) ?></td>
              <td><?= htmlspecialchars($order['first_name'] . ' ' . $order['last_name']) ?></td>
              <td><?= htmlspecialchars($order['phone']) ?></td>
              <td><?= htmlspecialchars($order['city']) ?></td>
              <td>₹<?= number_format($order['total'], 2) ?></td>
              <td><a href="view_order.php?order_id=<?= $order['id'] ?>" class="action-link">View</a></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="no-orders">No orders found.</p>
    <?php endif; ?>
  </div>
</body>
</html>

<?php $conn->close(); ?>
