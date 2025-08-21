<?php


include 'header.php';
$conn = new mysqli("localhost", "root", "", "hike_haus");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = floatval($_POST['price']);
    $quantity = intval($_POST['quantity']);
    $size = $_POST['size'] ?? '';
    $color = $_POST['color'] ?? '';

    $stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($image);
    $stmt->fetch();
    $stmt->close();

    if (!$image) $image = 'default.jpg';

    $item = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $price,
        'image' => $image,
        'quantity' => $quantity,
        'size' => $size,
        'color' => $color
    ];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $exists = false;
    foreach ($_SESSION['cart'] as &$existing) {
        if (
            $existing['id'] == $product_id &&
            $existing['size'] == $size &&
            $existing['color'] == $color
        ) {
            $existing['quantity'] += $quantity;
            $exists = true;
            break;
        }
    }
    unset($existing);

    if (!$exists) {
        $_SESSION['cart'][] = $item;
    }

    header("Location: buy.php");
    exit();
}

// Remove item
if (isset($_GET['remove'])) {
    $index = $_GET['remove'];
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
    header("Location: buy.php");
    exit();
}

// Subtotal
$subtotal = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Shopping Cart</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 40px; }
    .container { max-width: 1000px; margin: auto; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { padding: 10px; border-bottom: 1px solid #ddd; }
    h1, .breadcrumb { text-align: center; }
    .cart-summary { text-align: right; margin-top: 20px; }
    .checkout-btn {
      display: inline-block; background: black; color: white; padding: 10px 20px;
      border-radius: 4px; text-decoration: none;
    }
  </style>
</head>
<body>
  <div style="margin-top: 20px;">
  <a href="shop.php" style="display: inline-block; background: #ccc; color: #000; padding: 10px 15px; border-radius: 4px; text-decoration: none;">← Back to Shop</a>
</div>


<div class="container">
  <h1>Your Shopping Cart</h1>
   <nav class="space-x-8 text-lg">
      <a href="home.php" class="hover:text-gray-500">Home</a>
      <a href="shop.php" class="hover:text-gray-500">Shop</a>
      
    </nav>
  <?php if (!empty($_SESSION['cart'])): ?>
    <table>
      <thead>
        <tr><th>Product</th><th>Price</th><th>Qty</th><th>Options</th><th>Total</th><th>Action</th></tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION['cart'] as $index => $item): ?>
        <tr>
          <td><img src="image/product/<?= htmlspecialchars($item['image']) ?>" alt="Product" width="80"> <?= htmlspecialchars($item['name']) ?></td>
          <td>₹<?= number_format($item['price'], 2) ?></td>
          <td><?= $item['quantity'] ?></td>
          <td>
           
          </td>
          <td>₹<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
          <td><a href="?remove=<?= $index ?>" style="color:red;">Remove</a></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    
<?php if (!empty($item['size'])): ?>
  Size: <?= htmlspecialchars($item['size']) ?><br>
<?php endif; ?>
<?php if (!empty($item['color'])): ?>
  Color: <?= htmlspecialchars($item['color']) ?>
<?php endif; ?>


    <div class="cart-summary">
      <p><strong>Subtotal:</strong> ₹<span id="subtotal"><?= number_format($subtotal, 2) ?></span></p>
      <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
    </div>
  <?php else: ?>
    <p>Your cart is empty. <a href="shop.php">Continue Shopping</a>.</p>
  <?php endif; ?>
</div>

</body>
</html>
