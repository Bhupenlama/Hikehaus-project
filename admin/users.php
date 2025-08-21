<?php
$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
$user_count = $conn->query("SELECT COUNT(*) as count FROM users")->fetch_assoc()['count'];
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" /><button
  onclick="history.back()"
  class="mb-4 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 text-gray-700"
>
  ← Back
</button>

  <title>HIKE HAUS Admin - Users</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #f9fafc;
      padding: 40px;
    }
    h2 {
      margin-bottom: 20px;
      color: #0a6847;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
    }
    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #eee;
    }
    th {
      background: #f3f4f6;
      font-weight: 600;
    }
    .actions button {
      padding: 6px 12px;
      margin-right: 5px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      background: #0a6847;
      color: #fff;
    }
    .actions button.delete {
      background: #d9534f;
    }
  </style>
</head>
<body>
  <h2>Users Management (Total: <?= $user_count ?>)</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Actions</th>
    </tr>
    <?php if ($users && $users->num_rows > 0): ?>
      <?php while($user = $users->fetch_assoc()): ?>
      <tr>
        <td>U<?= $user['id'] ?></td>
        <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
        <td><?= htmlspecialchars($user['email']) ?></td>
        <td><?= $user['is_admin'] ? 'Admin' : 'Customer' ?></td>
        <td class="actions">
          <a href="edituser.php?id=<?= $user['id'] ?>"><button>Edit</button></a>
          <form action="deleteuser.php" method="POST" style="display:inline;" onsubmit="return confirm('Delete this user?');">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <button type="submit" class="delete">Delete</button>
          </form>
        </td>
      </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr><td colspan="5">No users found.</td></tr>
    <?php endif; ?>
  </table>
</body>
</html>
