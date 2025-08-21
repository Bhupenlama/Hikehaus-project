<?php
session_start();
$username = $_SESSION['username'] ?? null;
$admin = $_SESSION['admin'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hike Haus Header</title>
  <link rel="stylesheet" href="css/header.css">
</head>
<body>

<header class="header">
  <div class="logo-area">
    <img src="logos/N.png" alt="Hike Haus Logo" class="logo">
    <div class="tagline">"Wander. Explore. Repeat."</div>
  </div>

  <nav class="nav">
    <a class="highlight" href="home.php">Home</a>
    <a href="aboutus.php">About us</a>
    <a class="highlight" href="shop.php">Shop</a>

    <?php if (!$username): ?>
      <a href="signin.php">Sign In</a>
      <a href="signup.php">Sign Up</a>
    <?php else: ?>
      
      <a href="signout.php" class="signout-btn">Sign Out</a>
      
    <?php endif; ?>

    <?php if (!$admin): ?>
      <a href="admin/admin-login.php" class="admin-login-btn">Admin Login</a>
    <?php else: ?>
     
      <a href="admin_logout.php" class="admin-login-btn">Sign Out</a>
    <?php endif; ?>
  </nav>
</header>
