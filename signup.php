<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hike_haus";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Password length check
    if (strlen($password) < 8) {
        echo "<script>alert('Password must be at least 8 characters long.'); window.history.back();</script>";
        exit;
    }

    // Password match check
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
        exit;
    }

    // Check if email exists
    $check_email = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($check_email);
    if ($result->num_rows > 0) {
        echo "<script>alert('Email is already registered.'); window.history.back();</script>";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $sql = "INSERT INTO users (username, first_name, last_name, email, phone, password) 
            VALUES ('$username', '$first_name', '$last_name', '$email', '$phone', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Registration successful!');
                window.location.href = 'home.php';
              </script>";
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Hike Haus - Signup</title>
    <link rel="stylesheet" href="css/signup.css" />
</head>
<body>
    <div class="container">
        <div class="left-section">
            <img src="logos/N.png" class="logo" alt="Logo">
            <img src="logos/The Ultimate Uphill Training Guide — Backpacker.jpeg" class="main-img" alt="Hiking Image">
        </div>
        <div class="right-section">
            <h2>Create Account</h2>
            <form action="signup.php" method="POST" onsubmit="return validatePasswords()">
                <div class="input-row">
                    <div class="input-group">
                        <input type="text" name="username" placeholder="Username" required>
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <input type="email" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="input-group">
                        <input type="tel" name="phone" placeholder="Phone Number" required>
                    </div>
                </div>
                <div class="input-row">
                    <div class="input-group">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-group">
                        <input type="password" id="confirm-password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                </div>
                <button type="submit" class="btn">Signup</button>
                <p class="signin-link">Already have an account? <a href="signin.php">Sign in</a></p>
            </form>
            <p class="terms">HIKE HAUS Terms & Conditions</p>
        </div>
    </div>

    <script>
        function validatePasswords() {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm-password").value;

            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
