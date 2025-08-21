<?php
include'header.php';


$subtotal = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
}


$shipping = 40.00;
$total = $subtotal + $shipping;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Hike Haus - Checkout</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800 font-sans">

 
    <div class="flex space-x-4 items-center">
      <a href="#"><i class="fas fa-user"></i></a>
      <a href="#"><i class="fas fa-heart"></i></a>
      <a href="#" class="relative">
        <i class="fas fa-shopping-cart"></i>
        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full px-1"><?= !empty($_SESSION['cart']) ? count($_SESSION['cart']) : '0' ?></span>
      </a>
    </div>
  </header>


  <main class="max-w-7xl mx-auto p-6 grid md:grid-cols-2 gap-8">
  
    <section>
      <h2 class="text-2xl font-semibold mb-4">Checkout</h2>

      <form action="khalti/checkout.php" method="POST" class="space-y-6">
       
        <div>
          <h3 class="font-bold text-xl mb-2">Contact</h3>
          <input type="tel" name="phone_number" placeholder="Phone number" required class="w-full border p-2 rounded" />
          <p class="text-sm mt-1">Have an account? <a href="signup.php" class="text-blue-500">Create Account</a></p>
        </div>

       
        <div>
          <h3 class="font-bold text-xl mb-2">Delivery</h3>
          <div class="grid grid-cols-2 gap-4 mb-2">
            <input type="text" name="first_name" placeholder="First Name" required class="border p-2 rounded" />
            <input type="text" name="last_name" placeholder="Last Name" required class="border p-2 rounded" />
          </div>
          <input type="text" name="address" placeholder="Address" required class="w-full border p-2 rounded mb-2" />
          <input type="text" name="city" placeholder="City" required class="w-full border p-2 rounded mb-2" />
          <label class="flex items-center mt-2 text-sm">
            <input type="checkbox" name="save_info" class="mr-2" /> Save this info for future
          </label>
        </div>

     
        <div>
  <form action="khalti/checkout.php" method="POST" class="space-y-6">
 

  <h3 class="font-bold text-xl mb-2">Payment</h3>

  <button type="submit" class="mt-4 w-full bg-black text-white p-3 rounded hover:bg-gray-900">
    Pay Now
  </button>
</form>



      

    </section>

    <aside class="bg-gray-50 p-6 rounded-lg shadow-md">
      <h3 class="font-bold text-2xl mb-6">Order Summary</h3>

      <?php if (!empty($_SESSION['cart'])): ?>
        <?php foreach ($_SESSION['cart'] as $item): ?>
          <div class="flex mb-4">
            <img src="image/product/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="w-20 h-24 rounded object-cover" />
            <div class="ml-4 flex flex-col justify-between">
              <div>
                <h4 class="font-semibold"><?= htmlspecialchars($item['name']) ?></h4>
                <?php if (!empty($item['size'])): ?>
                  <p class="text-sm text-gray-600">Size: <?= htmlspecialchars($item['size']) ?></p>
                <?php endif; ?>
                <?php if (!empty($item['color'])): ?>
                  <p class="text-sm text-gray-600">Color: <?= htmlspecialchars($item['color']) ?></p>
                <?php endif; ?>
                <p class="text-sm text-gray-600">Qty: <?= intval($item['quantity']) ?></p>
              </div>
              <p class="font-bold mt-1">₹<?= number_format($item['price'] * $item['quantity'], 2) ?></p>
            </div>
          </div>
        <?php endforeach; ?>

        <div class="text-sm border-t pt-4 space-y-2">
          <div class="flex justify-between">
            <span>Subtotal</span><span>₹<?= number_format($subtotal, 2) ?></span>
          </div>
          <div class="flex justify-between">
            <span>Shipping</span><span>₹<?= number_format($shipping, 2) ?></span>
          </div>
          <div class="flex justify-between font-bold text-lg">
            <span>Total</span><span>₹<?= number_format($total, 2) ?></span>
          </div>
        </div>
      <?php else: ?>
        <p>Your cart is empty. <a href="shop.php" class="text-blue-600 underline">Continue Shopping</a>.</p>
      <?php endif; ?>
    </aside>
  </main>

  <footer class="text-center text-sm py-6 border-t mt-8">
    © 2025 HIKE HAUS. All rights reserved.
  </footer>


  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
