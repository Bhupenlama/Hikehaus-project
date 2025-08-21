<?php
include 'header.php';

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    $username = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>HIKE HAUS</title>

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">

 
  <link rel="stylesheet" href="css/home.css">

  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
</head>
<body>

<!-- Header -->
<header>
  <?php if ($username): ?>
    <p>Welcome back, <?php echo htmlspecialchars($username); ?>!</p>
  <?php else: ?>
    <p>You are not logged in. Please <a href="signin.php">sign in</a> to access full features.</p>
  <?php endif; ?>
</header>

<!-- Hero Section -->
<section class="hero">
  <div class="hero-images">
    <img src="insta/noah beck.jpeg" alt="Adventure 1">
    <img src="insta/Lightweight hiking equipment_ maximize efficiency on the trail.jpeg" alt="Adventure 2">
    <img src="insta/Men Hiking Outfit Essentials_ Gear Up For The Trails 2024 67.jpeg" alt="Adventure 3">
  </div>
  <div class="hero-content">
    <h1>ULTIMATE <br> SALE</h1>
    <p>NEW COLLECTION</p>
    <a href="shop.php" class="btn">SHOP NOW</a>
  </div>
</section>

<!-- Animated Prompt Cards (Swiper) -->
<div class="swiper mySwiper" style="padding: 30px;">
  <div class="swiper-wrapper">

  <div class="swiper-slide">
  What should I pack for a weekend hike in the mountains?
</div>
<div class="swiper-slide">
  Recommend a super lightweight tent I can carry solo
</div>
<div class="swiper-slide">
  How do I break in new hiking boots without blisters?
</div>
<div class="swiper-slide">
  What's the best trail snack for all-day energy?
</div>
<div class="swiper-slide">
  How should I layer clothes for a chilly mountain hike?
</div>
<div class="swiper-slide">
  What’s better for hydration: water bottles or a CamelBak?
</div>
<div class="swiper-slide">
  How do I choose the right backpack for a 2-day trek?
</div>
<div class="swiper-slide">
  What safety gear do I need for hiking off the grid?
</div>
<div class="swiper-slide">
  Suggest a hiking outfit that’s comfy and Instagram-worthy
</div>

<div style="background-color: #121212; padding: 40px 0;">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <!-- Slides here -->
    </div>
  </div>
</div>

  </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script>
  const swiper = new Swiper('.mySwiper', {
    slidesPerView: 'auto',
    spaceBetween: 16,
    loop: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    speed: 800,
    grabCursor: true,
  });
</script>



<!-- Other Sections -->
<?php
include 'banner.php';
include 'insta.php';
include 'brand.php';
include 'footer.php';
?>

</body>
</html>