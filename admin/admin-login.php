<?php
session_start();
require_once '../db.php'; // adjust path if needed

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username && $password) {
        $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        if ($res->num_rows === 1) {
            $admin = $res->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $admin['username'];
                header("Location: admin-dashboard.php");
                exit();
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Admin not found.";
        }
    } else {
        $error = "Please enter username and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Login - HIKE HAUS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f1f5f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .logo-area {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            height: 60px;
            margin-bottom: 8px;
        }

        .tagline {
            font-size: 16px;
            color: #6b7280;
            font-weight: 500;
        }

        .login-container {
            background: #ffffff;
            padding: 30px;
            width: 100%;
            max-width: 400px;
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        h2 {
            font-size: 24px;
            color: #0a6847;
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            margin-bottom: 15px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #0a6847;
            color: white;
            font-size: 16px;
            font-weight: 600;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #075c3b;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px;
            border: 1px solid #fca5a5;
            border-radius: 6px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="logo-area">
        <img src="../logos/N.png" alt="Hike Haus Logo" class="logo">
        <div class="tagline">"Wander. Explore. Repeat."</div>
    </div>

    <div class="login-container">
        <h2>Admin Login</h2>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required autofocus />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
        </form>
    </div>

</body>
</html>
