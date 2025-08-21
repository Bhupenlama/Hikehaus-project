<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Product Detail - Viva La Vida</title>
  <link rel="stylesheet" href="css/shop.css" />
  <style>
    .product-detail {
      max-width: 800px;
      margin: 40px auto;
      display: flex;
      gap: 40px;
      align-items: flex-start;
    }
    .product-detail img {
      max-width: 400px;
      width: 100%;
      border-radius: 8px;
    }
    .product-info {
      flex: 1;
    }
    .product-info h1 {
      margin-bottom: 15px;
      font-size: 2rem;
    }
    .product-info .price {
      font-size: 1.5rem;
      color: #d9534f;
      margin-bottom: 20px;
    }
    .product-info p.description {
      font-size: 1rem;
      margin-bottom: 25px;
      line-height: 1.5;
    }
    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
    }
    select, input[type=number] {
      padding: 8px;
      font-size: 1rem;
      margin-top: 5px;
      width: 150px;
    }
    .btn-buy {
      background-color: black;
      color: white;
      padding: 12px 25px;
      border: none;
      border-radius: 6px;
      font-size: 1.1rem;
      cursor: pointer;
      margin-top: 25px;
    }
  </style>
</head>
<body>

<main>
  <?php
  $conn = new mysqli("localhost", "root", "", "hike_haus");
  if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

  if (isset($_GET['id']) && is_numeric($_GET['id'])) {
      $id = intval($_GET['id']);
      $stmt = $conn->prepare("SELECT id, name, price, description, image, sizes, colors FROM products WHERE id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          $product = $result->fetch_assoc();
          $sizes = !empty($product['sizes']) ? explode(',', $product['sizes']) : [];
          $colors = !empty($product['colors']) ? explode(',', $product['colors']) : [];
  ?>
      <section class="product-detail">
        <img src="image/product/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
        <div class="product-info">
          <h1><?= htmlspecialchars($product['name']) ?></h1>
          <div class="price">₹<?= number_format($product['price'], 2) ?></div>
          <p class="description"><?= nl2br(htmlspecialchars($product['description'] ?: 'No description available.')) ?></p>

          <form action="buy.php" method="post">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            <input type="hidden" name="product_name" value="<?= htmlspecialchars($product['name']) ?>">
            <input type="hidden" name="price" value="<?= $product['price'] ?>">

            <?php if ($sizes): ?>
              <label for="size">Size (optional):</label>
              <select name="size" id="size">
                <option value="">Select size</option>
                <?php foreach ($sizes as $size): ?>
                  <option value="<?= htmlspecialchars(trim($size)) ?>"><?= htmlspecialchars(trim($size)) ?></option>
                <?php endforeach; ?>
              </select>
            <?php endif; ?>

            <?php if ($colors): ?>
              <label for="color">Color (optional):</label>
              <select name="color" id="color">
                <option value="">Select color</option>
                <?php foreach ($colors as $color): ?>
                  <option value="<?= htmlspecialchars(trim($color)) ?>"><?= htmlspecialchars(trim($color)) ?></option>
                <?php endforeach; ?>
              </select>
            <?php endif; ?>

            <label for="quantity">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" required>

            <button type="submit" class="btn-buy">Confirm Buy</button>
          </form>
        </div>
      </section>
  <?php
      } else {
          echo "<p>Product not found.</p>";
      }
      $stmt->close();
  } else {
      echo "<p>Invalid product ID.</p>";
  }
  $conn->close();
  ?>
</main>

<?php include 'banner.php'; include 'insta.php'; include 'brand.php'; include 'footer.php'; ?>
</body>
</html>
