<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "hike_haus");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name     = $_POST['name'] ?? '';
    $category = $_POST['category'] ?? '';
    $price    = $_POST['price'] ?? 0;
    $stock    = $_POST['stock'] ?? 0;
    $image    = $_FILES['image']['name'] ?? '';
    $tmp      = $_FILES['image']['tmp_name'] ?? '';

    if (empty($name) || empty($category) || $price <= 0 || $stock < 0 || empty($image)) {
        die("Please fill all fields and upload an image.");
    }

    if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die("Error uploading image: " . $_FILES['image']['error']);
    }

    // Sanitize image name and add timestamp prefix
    $image = preg_replace("/[^a-zA-Z0-9\._-]/", "", $image);
    $image = time() . "_" . $image;

    $targetDir = "../image/product/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    if (!move_uploaded_file($tmp, $targetDir . $image)) {
        die("Failed to move uploaded image.");
    }

    $stmt = $conn->prepare("INSERT INTO products (name, category, price, stock, image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $name, $category, $price, $stock, $image);

    if ($stmt->execute()) {
        header("Location: admin-dashboard.php");
        exit;
    } else {
        echo "DB error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Add Product</title>
</head>
<body>
<h1>Add New Product</h1>
<form action="add_product.php" method="post" enctype="multipart/form-data">
    <label>Name: <input type="text" name="name" required></label><br><br>
    <label>Category: <input type="text" name="category" required></label><br><br>
    <label>Price: <input type="number" name="price" step="0.01" min="0" required></label><br><br>
    <label>Stock: <input type="number" name="stock" min="0" required></label><br><br>
    <label>Image: <input type="file" name="image" accept="image/*" required></label><br><br>
    <button type="submit">Add Product</button>
</form>
</body>
</html>
