<?php
$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process form submission (update product)
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['name']);
    $category = $conn->real_escape_string($_POST['category']);
    $price = floatval($_POST['price']);
    $stock = intval($_POST['stock']);
    
    $imageUpdated = false;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $targetDir = "../image/product/";
        $targetFile = $targetDir . $imageName;
        
        if (move_uploaded_file($imageTmp, $targetFile)) {
            $imageUpdated = true;
        }
    }

    if ($imageUpdated) {
        $sql = "UPDATE products SET name=?, category=?, price=?, stock=?, image=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdssi", $name, $category, $price, $stock, $imageName, $id);
    } else {
        $sql = "UPDATE products SET name=?, category=?, price=?, stock=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssdsi", $name, $category, $price, $stock, $id);
    }

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: admin-dashboard.php"); // Redirect after update
        exit;
    } else {
        echo "Error updating product: " . $stmt->error;
        $stmt->close();
    }
}

// For GET request: show the form with product info
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid or missing product ID.");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="edit_product.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($product['id']) ?>">
        
        <label>Product Name:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required><br><br>

        <label>Category:</label><br>
        <select name="category" required>
            <option value="Backpacks" <?= $product['category'] === 'Backpacks' ? 'selected' : '' ?>>Backpacks</option>
            <option value="Tents" <?= $product['category'] === 'Tents' ? 'selected' : '' ?>>Tents</option>
            <option value="Clothing" <?= $product['category'] === 'Clothing' ? 'selected' : '' ?>>Clothing</option>
            <option value="Footwear" <?= $product['category'] === 'Footwear' ? 'selected' : '' ?>>Footwear</option>
            <option value="Accessories" <?= $product['category'] === 'Accessories' ? 'selected' : '' ?>>Accessories</option>
        </select><br><br>

        <label>Price (₹):</label><br>
        <input type="number" name="price" value="<?= htmlspecialchars($product['price']) ?>" required step="0.01"><br><br>

        <label>Stock:</label><br>
        <input type="number" name="stock" value="<?= htmlspecialchars($product['stock']) ?>" required><br><br>

        <label>Change Image (optional):</label><br>
        <input type="file" name="image"><br><br>

        <button type="submit">Update Product</button>
    </form>
</body>
</html>
