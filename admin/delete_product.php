<?php
$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Get current product image to delete the file
    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        $stmt->close();
        $conn->close();
        die("Product not found.");
    }
    $product = $result->fetch_assoc();
    $stmt->close();

    // Delete the product record
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Delete the image file
        $imagePath = __DIR__ . '/../image/product/' . $product['image'];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $stmt->close();
        $conn->close();

        header("Location: admin-dashboard.php");
        exit;
    } else {
        echo "Error deleting product: " . $stmt->error;
    }
    $stmt->close();
} else {
    die("Invalid request.");
}
$conn->close();
?>
