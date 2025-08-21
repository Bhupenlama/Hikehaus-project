<?php
$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$banner = null;
$result = $conn->query("SELECT * FROM featured_banners ORDER BY id DESC LIMIT 1");
if ($result && $result->num_rows > 0) {
    $banner = $result->fetch_assoc();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Homepage Banner</title>
  <style>
    .banner-container {
      max-width: 1100px;
      margin: 40px auto;
      background: #f3f3f3;
      border-radius: 12px;
      overflow: hidden;
      display: flex;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .banner-left {
      flex: 1;
      padding: 20px;
      position: relative;
    }
    .banner-left img {
      width: 100%;
      height: auto;
      object-fit: contain;
    }
    .label {
      position: absolute;
      background: white;
      padding: 4px 8px;
      font-size: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      border-radius: 4px;
    }
    .banner-right {
      flex: 1;
      background: #e3e3e3;
      padding: 20px 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .banner-right h2 {
      margin: 0 0 10px;
    }
    .banner-right p {
      margin: 0 0 15px;
    }
    .banner-price {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .banner-size {
      font-size: 14px;
      color: #333;
      margin-bottom: 10px;
    }
    .banner-cta {
      background: black;
      color: white;
      padding: 10px 15px;
      border-radius: 4px;
      text-decoration: none;
      width: fit-content;
    }
  </style>
</head>
<body>
<?php if ($banner): ?>
  <div class="banner-container">
    <div class="banner-left">
      <?php
        // Encode each part of the path
        $parts = explode('/', $banner['image_path']);
        $encodedParts = array_map('rawurlencode', $parts);
        $imageSrc = implode('/', $encodedParts);
   
        // Decode labels from JSON, safely checking if 'labels' exists
$labels = [];
if (isset($banner['labels']) && !empty($banner['labels'])) {
    $labels = json_decode($banner['labels'], true);
}

      ?>
      <img src="<?= htmlspecialchars($imageSrc) ?>" alt="<?= htmlspecialchars($banner['title']) ?>">

      <?php if ($labels && is_array($labels)): ?>
        <?php foreach ($labels as $label): ?>
          <div class="label" style="top: <?= htmlspecialchars($label['top']) ?>; left: <?= htmlspecialchars($label['left']) ?>;">
            <?= htmlspecialchars($label['text']) ?>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="banner-right">
      <p style="font-size: 13px; color: #777; margin-bottom: 6px;">
        <?= htmlspecialchars($banner['collection_name']) ?>
      </p>
      <h2><?= htmlspecialchars($banner['title']) ?></h2>
      <p><?= htmlspecialchars($banner['description']) ?></p>
      <div class="banner-size"><strong>Size:</strong> <?= htmlspecialchars($banner['size']) ?></div>
      <div class="banner-price">₹<?= number_format((float)$banner['price'], 2) ?></div>
      <a href="checkout.php" class="banner-cta">Buy Now</a>
    </div>
  </div>
<?php else: ?>
  <p style="text-align:center;">No banner found.</p>
<?php endif; ?>
</body>
</html>
