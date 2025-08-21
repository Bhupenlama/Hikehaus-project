
<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin-login.php");
    exit();
}

// Rest of your admin dashboard code..

$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$products = $conn->query("SELECT * FROM products");
$product_count = $conn->query("SELECT COUNT(*) as count FROM products")->fetch_assoc()['count'];
$category_count = $conn->query("SELECT COUNT(DISTINCT category) as count FROM products")->fetch_assoc()['count'];
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>HIKE HAUS Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <style>* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Inter', sans-serif;
  display: flex;
  background: #f1f5f9;
  color: #333;
}

.sidebar {
  width: 220px;
  background: #ffffff;
  padding: 30px 20px;
  border-right: 1px solid #e5e7eb;
  height: 100vh;
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.03);
}

.sidebar h2 {
  font-size: 22px;
  margin-bottom: 30px;
  font-weight: 700;
  color: #0a6847;
}

.sidebar a {
  display: block;
  margin: 15px 0;
  text-decoration: none;
  color: #374151;
  font-weight: 500;
  padding: 8px 12px;
  border-radius: 6px;
  transition: background 0.2s ease;
}

.sidebar a:hover {
  background: #f0fdfa;
  color: #0a6847;
}

.main {
  flex-grow: 1;
  padding: 40px;
}

.stats {
  display: flex;
  gap: 30px;
  margin-bottom: 40px;
}

.stat-card {
  background: #ffffff;
  padding: 24px;
  flex: 1;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
  text-align: center;
  transition: transform 0.2s ease;
}

.stat-card:hover {
  transform: translateY(-4px);
}

.stat-card h3 {
  font-size: 30px;
  color: #0a6847;
  margin-bottom: 5px;
}

.stat-card p {
  font-size: 15px;
  color: #6b7280;
}

.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
}

.top-bar h2 {
  font-size: 22px;
  color: #111827;
}

.top-bar button {
  padding: 10px 20px;
  background: #0a6847;
  color: white;
  border: none;
  border-radius: 6px;
  cursor: pointer;
  font-weight: 600;
  transition: background 0.3s ease;
}

.top-bar button:hover {
  background: #075c3b;
}

.product-table {
  width: 100%;
  border-collapse: collapse;
  background: #ffffff;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
}

.product-table th,
.product-table td {
  padding: 16px;
  text-align: left;
  border-bottom: 1px solid #f3f4f6;
}

.product-table th {
  background: #f9fafb;
  font-weight: 600;
  font-size: 14px;
  color: #374151;
}

.product-table td {
  font-size: 14px;
  color: #4b5563;
}

.product-table img {
  width: 48px;
  height: 48px;
  object-fit: cover;
  border-radius: 8px;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.08);
}

.actions button {
  padding: 6px 12px;
  margin-right: 5px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  background: #0a6847;
  color: #fff;
  transition: background 0.3s ease;
  font-size: 13px;
}

.actions button:hover {
  background: #075c3b;
}

.actions form button {
  background: #dc3545;
}

.actions form button:hover {
  background: #b02a37;
}

/* Modal */
.modal {
  display: none;
  position: fixed;
  z-index: 100;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4);
  justify-content: center;
  align-items: center;
}

.modal-content {
  background: #ffffff;
  padding: 30px;
  width: 400px;
  border-radius: 10px;
  display: flex;
  flex-direction: column;
  gap: 15px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.modal-content h2 {
  font-size: 20px;
  color: #0a6847;
  margin-bottom: 10px;
}

.modal-content input,
.modal-content select {
  padding: 12px;
  border: 1px solid #d1d5db;
  border-radius: 6px;
  font-size: 14px;
}

.modal-content button {
  padding: 10px;
  font-weight: 600;
}

.modal-content button[type="submit"] {
  background: #0a6847;
  color: #fff;
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.modal-content button[type="submit"]:hover {
  background: #075c3b;
}

.modal-content button[type="button"] {
  background: #e5e7eb;
  border: none;
  color: #374151;
  border-radius: 6px;
  cursor: pointer;
}

.modal-content button[type="button"]:hover {
  background: #d1d5db;
}

/* Logo area */
.logo-area {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 30px;
}

.logo {
  width: 48px;
  height: 48px;
  object-fit: contain;
  border-radius: 6px;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.tagline {
  font-style: italic;
  font-weight: 600;
  color: #0a6847;
  font-size: 14px;
}

  </style>
</head>
<body>
  <div class="sidebar">
    <h2>HIKE HAUS</h2>
    <a href="users.php">Users</a>
    
   <a href="add_banner.php">Add New Banner</a>
       <a href="orders.php">View order</a>

    <a href="logout.php">Logout</a>
  </div>

  <div class="main">
    <div class="stats">
      <div class="stat-card">
        <h3><?= $product_count ?></h3>
        <p>Total Products</p>
      </div>
      <div class="stat-card">
        <h3><?= $category_count ?></h3>
        <p>Categories</p>
      </div>
      <div class="stat-card">
        <h3>1</h3>
        <p>Admin</p>
      </div>
    </div>

    <div class="top-bar">
      <h2>Manage Products</h2>
      <button onclick="document.getElementById('productModal').style.display='flex'">+ Add Product</button>
     

    </div>

    <table class="product-table">
      <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Actions</th>
      </tr>
      <?php foreach ($products as $row): ?>
<tr>
  <td>P<?= $row['id'] ?></td>
  <td><img src="../image/product/<?= htmlspecialchars($row['image']) ?>" alt="img"></td>
  <td><?= htmlspecialchars($row['name']) ?></td>
  <td><?= htmlspecialchars($row['category']) ?></td>
  <td>₹<?= htmlspecialchars($row['price']) ?></td>
  <td><?= htmlspecialchars($row['stock']) ?></td>
  <td class="actions">
    <a href="edit_product.php?id=<?= $row['id'] ?>"><button>Edit</button></a>
    <form action="delete_product.php" method="POST" style="display:inline;" onsubmit="return confirm('Delete this product?');">
      <input type="hidden" name="id" value="<?= $row['id'] ?>">
      <button type="submit" style="background:#d9534f; color:#fff; border:none; border-radius:5px; padding:6px 12px; cursor:pointer;">Delete</button>
    </form>
  </td>
</tr>
<?php endforeach; ?>

    </table>
  </div>

  <!-- Modal -->
  <div class="modal" id="productModal">
    <form action="add_product.php" method="POST" enctype="multipart/form-data" class="modal-content">
      <h2>Add Product</h2>
      <input type="text" name="name" placeholder="Product Name" required>
      <select name="category" required>
        <option value="" disabled selected>Select Category</option>
        <option value="Backpacks">Backpacks</option>
        <option value="Tents">Tents</option>
        <option value="Clothing">Clothing</option>
        <option value="Footwear">Footwear</option>
        <option value="Accessories">Accessories</option>
      </select>
      <input type="number" name="price" placeholder="Price" step="0.01" required>
      <input type="number" name="stock" placeholder="Stock" required>
      <input type="file" name="image" accept="image/*" required>
      <div style="display:flex; justify-content:space-between;">
        <button type="submit">Add</button>
        <button type="button" onclick="document.getElementById('productModal').style.display='none'">Cancel</button>
      </div>
    </form>
  </div>

  <script>
    window.onclick = function(event) {
      if (event.target == document.getElementById('productModal')) {
        document.getElementById('productModal').style.display = "none";
      }
    }
  </script>
</body>
</html>
 