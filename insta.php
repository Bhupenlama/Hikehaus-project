<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<style>
.instagram {
    text-align: center;
    padding: 40px 15px; /* Slightly smaller padding */
    background-color: var(--bg-light);
}

.instagram h2 {
    font-size: 1.8em; /* Slightly smaller heading */
    color: var(--text-dark);
    margin-bottom: 12px; /* Slightly smaller margin */
}

.instagram h3 {
    font-size: 0.9em; /* Slightly smaller sub-heading */
    color: var(--text-light);
    margin-bottom: 25px; /* Slightly smaller margin */
}

.insta-gallery {
    display: flex;
    justify-content: center;
    gap: 10px; /* Smaller gap */
    overflow-x: auto;
    padding: 10px 0; /* Smaller padding */
    scrollbar-width: thin; /* For Firefox */
    scrollbar-color: var(--text-light) var(--bg-light); /* For Firefox */
}

/* Chrome, Edge, and Safari */
.insta-gallery::-webkit-scrollbar {
    height: 6px; /* Smaller scrollbar height */
}

.insta-gallery::-webkit-scrollbar-track {
    background: var(--bg-light);
}

.insta-gallery::-webkit-scrollbar-thumb {
    background-color: var(--text-light);
    border-radius: 3px; /* Smaller border radius */
}

.insta-gallery img {
    width: 150px; /* Smaller thumbnails */
    height: auto;
    border-radius: 6px; /* Smaller border radius */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); /* Smaller shadow */
    flex-shrink: 0;
    transition: transform 0.3s ease-in-out;
}

.insta-gallery img:hover {
    transform: scale(1.05); /* Slightly less zoom */
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero {
        height: 55vh; /* Slightly smaller hero */
    }

    .hero-content h1 {
        font-size: 2rem; /* Smaller hero heading */
    }

    .hero-content p {
        font-size: 0.85rem; /* Smaller hero paragraph */
    }

    .hero-images img {
        width: 90%; /* Slightly smaller stacked images */
    }

    .product-grid {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); /* Smaller product grid items */
        gap: 12px; /* Smaller gap */
    }

    .insta-gallery {
        gap: 8px; /* Smaller gallery gap */
    }

    .insta-gallery img {
        width: 100px; /* Smaller gallery thumbnails */
    }
}

@media (max-width: 576px) {
    .hero-content h1 {
        font-size: 1.6rem; /* Even smaller hero heading */
    }

    .hero-content p {
        font-size: 0.75rem; /* Even smaller hero paragraph */
    }

    .tab-navigation {
        gap: 6px; /* Smaller tab gap */
    }

    .tab-button {
        font-size: 0.75em; /* Smaller tab button text */
        padding: 6px 10px; /* Smaller tab button padding */
    }
}
</style>
    
<body>
<section class="instagram">
  <h2>Follow Us On Instagram</h2>
  <h3>For more upcoming exclusive gears and clothes.<a href="https://www.instagram.com/bhupen_lama1?igsh=MTZnYXd1NnNobDY4aQ%3D%3D&utm_source=qr">Hike haus</a></h3>
  <div class="insta-gallery">
    <img src="insta/_Mountain Trails & Nature Getaways_ Discover Your Next Adventure_ (1).jpeg" alt="">
    <img src="insta/_Mountain Trails & Nature Getaways_ Discover Your Next Adventure_.jpeg" alt="">
    <img src="insta/download (10).jpeg" alt="">
    <img src="insta/download (11).jpeg" alt="">
    <img src="insta/download (15).jpeg" alt="">
    <img src="insta/download (16).jpeg" alt=""> 
    <img src="insta/download (17).jpeg" alt="">
  </div>
</section>

</body>
</html>