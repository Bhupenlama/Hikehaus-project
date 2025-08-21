<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "root", "", "hike_haus");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $collection = $_POST['collection_name'] ?? '';
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $size = $_POST['size'] ?? '';
    $price = $_POST['price'] ?? '';

    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die("Image upload error.");
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($_FILES['image']['type'], $allowedTypes)) {
        die("Only JPG, PNG, GIF images allowed.");
    }

    $imageDir = 'image/product/uploads/';
    if (!file_exists($imageDir)) mkdir($imageDir, 0777, true);

    $imageName = time() . "_" . basename($_FILES["image"]["name"]);
    $imagePath = $imageDir . $imageName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
        $stmt = $conn->prepare("INSERT INTO featured_banners (collection_name, title, description, size, price, image_path)
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $collection, $title, $description, $size, $price, $imagePath);

        if ($stmt->execute()) {
            echo "<p class='success-msg'>Banner uploaded successfully!</p>";
        } else {
            echo "<p class='error-msg'>Database error: " . $stmt->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p class='error-msg'>Failed to move uploaded file.</p>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Featured Banner</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', sans-serif;
      background: #f1f5f9;
      min-height: 100vh;
      padding: 40px;
      position: relative;
    }

    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
      padding: 8px 16px;
      background: #e5e7eb;
      color: #374151;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: 500;
      transition: background 0.3s ease;
    }

    .back-button:hover {
      background: #d1d5db;
    }

    .container {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100%;
    }

    .upload-form {
      background: #ffffff;
      padding: 30px;
      width: 100%;
      max-width: 500px;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
    }

    .upload-form h2 {
      margin-bottom: 20px;
      font-size: 24px;
      color: #0a6847;
      text-align: center;
    }

    .upload-form label {
      display: block;
      margin-bottom: 15px;
      font-weight: 500;
      color: #374151;
    }

    .upload-form input[type="text"],
    .upload-form textarea,
    .upload-form input[type="file"] {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 14px;
      margin-top: 6px;
    }

    .upload-form textarea {
      resize: vertical;
      min-height: 80px;
    }

    .upload-form button[type="submit"] {
      margin-top: 20px;
      width: 100%;
      background: #0a6847;
      color: #ffffff;
      padding: 12px;
      font-size: 16px;
      font-weight: 600;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .upload-form button[type="submit"]:hover {
      background: #075c3b;
    }

    .success-msg {
      color: green;
      text-align: center;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .error-msg {
      color: red;
      text-align: center;
      font-weight: 600;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <!-- Back Button -->
  <button onclick="history.back()" class="back-button">← Back</button>

  <!-- Centered Form -->
  <div class="container">
    <form class="upload-form" action="" method="post" enctype="multipart/form-data">
      <h2>Upload Featured Banner</h2>

      <label>
        Collection:
        <input type="text" name="collection_name" required>
      </label>

      <label>
        Title:
        <input type="text" name="title" required>
      </label>

      <label>
        Description:
        <textarea name="description" required></textarea>
      </label>

      <label>
        Size:
        <input type="text" name="size" required>
      </label>

      <label>
        Price:
        <input type="text" name="price" required>
      </label>

      <label>
        Image:
        <input type="file" name="image" required>
      </label>

      <button type="submit">Upload Banner</button>
    </form>
  </div>

</body>
</html>
