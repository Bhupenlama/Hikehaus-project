<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $conn = new mysqli("localhost", "root", "", "hike_haus");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $id = intval($_POST['id']);
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}

header("Location: users.php"); // Adjust to your actual users page
exit();
