<?php
$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$id = $_GET['id'] ?? 0;
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) die("User not found.");
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first = $_POST['first_name'];
    $last = $_POST['last_name'];
    $email = $_POST['email'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $update = $conn->prepare("UPDATE users SET first_name=?, last_name=?, email=?, is_admin=? WHERE id=?");
    $update->bind_param("sssii", $first, $last, $email, $is_admin, $id);
    $update->execute();
    header("Location: admin_users.php"); // Update with your users list filename
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit User - HIKE HAUS Admin</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }
    body {
      font-family: 'Inter', sans-serif;
      display: flex;
      background: #f9fafc;
    }
    .sidebar {
      width: 220px;
      background: #fff;
      padding: 30px 20px;
      border-right: 1px solid #eee;
      height: 100vh;
    }
    .sidebar h2 {
      font-size: 20px;
      margin-bottom: 30px;
    }
    .sidebar a {
      display: block;
      margin: 15px 0;
      text-decoration: none;
      color: #333;
      font-weight: 500;
    }
    .main {
      flex-grow: 1;
      padding: 40px;
    }
    .main h2 {
      color: #0a6847;
      margin-bottom: 20px;
    }
    form {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
      max-width: 500px;
    }
    label {
      display: block;
      margin-bottom: 15px;
      font-weight: 500;
    }
    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    input[type="checkbox"] {
      margin-right: 8px;
    }
    button {
      padding: 10px 20px;
      background: #0a6847;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 20px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <h2>HIKE HAUS Admin</h2>
    <a href="admin-dashboard.php">Dashboard</a>
    <a href="users.php">Users</a>
    <a href="products.php">Products</a>
    <a href="add_banner.php">Banners</a>
    <a href="orders.php">Orders</a>
  </div>

  <!-- Main Content -->
  <div class="main">
    <h2>Edit User</h2>
    <form method="POST">
      <label>
        First Name:
        <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
      </label>
      <label>
        Last Name:
        <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
      </label>
      <label>
        Email:
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
      </label>
      <label>
        <input type="checkbox" name="is_admin" <?= $user['is_admin'] ? 'checked' : '' ?>>
        Is Admin
      </label>
      <button type="submit">Update</button>
    </form>
  </div>

</body>
</html>
