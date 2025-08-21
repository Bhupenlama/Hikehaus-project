<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>All Products - Viva La Vida</title>
  <link rel="stylesheet" href="css/shop.css" />
</head>
<body>

<main>
  <section class="product-grid">
    <h2>All Products</h2>
    <div class="grid-container">

      <?php
      $conn = new mysqli("localhost", "root", "", "hike_haus");
      if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

      // Get all products without limit
      $sql = "SELECT id, name, price, image FROM products ORDER BY id DESC";
      $result = $conn->query($sql);

      if ($result && $result->num_rows > 0):
        while ($product = $result->fetch_assoc()):
      ?>
          <article class="product-item">
            <figure>
              <img src="image/product/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" loading="lazy" />
              <figcaption class="product-details">
                <span class="product-name"><?= htmlspecialchars($product['name']) ?></span>
                <span class="product-price">₹<?= number_format($product['price'], 2) ?></span>
                <a href="detail.php?id=<?= $product['id'] ?>" class="buy-button">Buy</a>

              </figcaption>
            </figure>
          </article>
      <?php
        endwhile;
      else:
        echo "<p>No products found.</p>";
      endif;

      $conn->close();
      ?>

    </div>
  </section>
</main>

<?php
include 'banner.php';
include 'insta.php';
include 'brand.php';
include 'footer.php';
?>

</body>
</html>
