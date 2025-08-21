<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hike_haus";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "<script>alert('Please fill in all fields.'); window.history.back();</script>";
        exit;
    }

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;

            echo "<script>alert('Login successful!'); window.location.href = 'home.php';</script>";
            exit;
        } else {
            echo "<script>alert('Incorrect password.'); window.history.back();</script>";
            exit;
        }
    } else {
        echo "<script>alert('Email not registered.'); window.history.back();</script>";
        exit;
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hike Haus - Sign In</title>
    <link rel="stylesheet" href="css/signup.css" />
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="logos/N.png" class="logo" alt="Logo" />
            <img src="logos/The Ultimate Uphill Training Guide — Backpacker.jpeg" class="main-img" alt="Hiking Image" />
        </div>
        <div class="right-section">
            <h2>Sign In</h2>
            <form action="signin.php" method="POST" onsubmit="return validateForm()">
                <div class="input-row">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email Address" required />
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <input type="password" name="password" placeholder="Password" required />
                    </div>
                </div>
                <button type="submit" class="btn">Sign In</button>
                <p class="signin-link">Don't have an account? <a href="signup.php">Create one</a></p>
            </form>
            <p class="terms">HIKE HAUS Terms & Conditions</p>
        </div>
    </div>

    <script>
    function validateForm() {
        const email = document.querySelector('input[name="email"]').value.trim();
        const password = document.querySelector('input[name="password"]').value;

        if (!email || !password) {
            alert("Please fill in all fields.");
            return false;
        }
        return true;
    }
    </script>
</body>
</html>
