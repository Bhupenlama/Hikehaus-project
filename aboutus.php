<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Hike Haus - Your Adventure Starts Here</title>
    <link rel="stylesheet" href="css/aboutus.css">
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>

    <div class="about-hero">
        <div class="about-hero-image">
            <img src="insta/The Val Fex near Sils in the Engadin.jpeg" alt="Inspiring Hiking Landscape of Ama Dablam Mountain in Nepal">
        </div>
        <div class="about-hero-content">
            <h1>Our Story</h1>
            <p>Quality Gear, Real Passion.</p>
        </div>
    </div>

    <div class="container">
        <section class="our-story">
            <h2>Our Journey to the Trail</h2>
            <p>At Hike Haus, our story began with a shared love for the great outdoors and the transformative power of hiking. Founded by Bhupen lama in year 2023, we recognized the need for a curated space where fellow adventurers could discover reliable, high-quality gear and connect with a community that understands the profound connection to the trail.</p>
            <p>Driven by experience, we envisioned Hike Haus as more than just a shop. We wanted to create a hub of expertise and inspiration, a place where both seasoned trekkers and enthusiastic beginners could find the perfect equipment and the guidance they need to embark on unforgettable journeys. We believe that the right gear not only enhances safety and comfort but also deepens the appreciation for the natural world.</p>

        </section>

        <section class="gear-philosophy">
            <h2>Our Gear Philosophy</h2>
            <div class="philosophy-grid">
                <div class="philosophy-item">
                    <h3>Quality First</h3>
                    <p>Rigorously vetted gear for safety and enjoyment.</p>
                </div>
                <div class="philosophy-item">
                    <h3>Curated Selection</h3>
                    <p>Tailored to diverse hiker needs and adventures.</p>
                </div>
                <div class="philosophy-item">
                    <h3>Passionate Expertise</h3>
                    <p>Firsthand experience informs our recommendations.</p>
                </div>
            </div>
        </section>

        <section class="team-section">
            <h2>Meet the Crew</h2>
            <p>A team united by a love for the outdoors and supporting your adventures.</p>
            <div class="team-members">
                <div class="team-member">
                    <img src="insta/WhatsApp Image 2023-04-28 at 18.33.59.jpg" alt="Bhupen Lama">
                    <h4>Bhupen Lama</h4>
                    <p>Founder</p>
                </div>
                <div class="team-member">
                <img src="insta/owner.jpg" alt="MC">
                    <h4>Mr. Manish Rai</h4>
                    <p>Owner</p>
                    </div>
                    <div class="team-member">
                    <img src="insta/4.jpg" alt="Team Member 2">
                    <h4>[Team Member]</h4>
                    <p>Specialist</p>
                </div>
            </div>
        </section>

        <section class="our-commitment">
            <h2>Our Promise</h2>
            <p>Exceptional gear, expert advice, and a supportive community for your journey.</p>
        </section>
    </div>

    <?php
    include 'footer.php';
    ?>
</body>
<style>  /* Enhanced Image CSS for Smaller and Perfect Images */
  :root {
    --primary-color: #333;
    --secondary-color: #f9f9f9;
    --accent-color: #5cb85c;
    --text-dark: var(--primary-color);
    --text-light: #777;
    --heading-font: 'Merriweather', serif;
    --body-font: 'Open Sans', sans-serif;
}

body {
    font-family: var(--body-font);
    line-height: 1.7;
    margin: 0;
    padding: 0;
    background-color: var(--secondary-color);
    color: var(--text-dark);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 40px;
    background-color: #fff;
    border-radius: 8px;
    
}

h1, h2, h3, h4 {
    font-family: var(--heading-font);
    color: var(--primary-color);
    line-height: 1.3;
    margin-bottom: 0.75em;
}

/* --- Hero Section --- */
.about-hero {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    margin-bottom: 30px;
   
    height: 300px; /* Fixed height for a controlled size */
}

.about-hero-image {
    width: 100%;
    height: 100%; /* Make image fill the hero container */
}

.about-hero-image img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover; /* Maintain aspect ratio and cover the area */
    filter: brightness(0.9);
    border-radius: 8px;
}

.about-hero-content {
    text-align: center;
    padding: 20px; /* Adjust padding for smaller container */
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    width: 80%;
    max-width: 400px; /* Smaller max width for text */
}

.about-hero h1 {
    font-size: 2em; /* Smaller heading */
    margin-bottom: 10px;
    letter-spacing: 0.5px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
}

.about-hero p {
    font-size: 1em; /* Smaller paragraph */
    max-width: none; /* Adjust to container width */
    margin: 0 auto;
    line-height: 1.6;
    color: white;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
}

/* --- Our Story Section --- */
.our-story {
    padding: 40px 0;
    text-align: left;
    border-bottom: 1px solid #eee;
    margin-bottom: 30px;
}

.our-story h2 {
    font-size: 2.2em;
    color: var(--accent-color);
    margin-bottom: 20px;
}

.our-story p {
    font-size: 1.1em;
    line-height: 1.8;
    color: var(--text-light);
    margin-bottom: 1.5em;
}

/* --- Gear Philosophy Section --- */
.gear-philosophy {
    padding: 40px 0;
    background-color: #f4f4f4;
    border-radius: 8px;
    padding: 30px;
    margin-bottom: 30px;
}

.gear-philosophy h2 {
    font-size: 2.2em;
    color: var(--accent-color);
    margin-bottom: 25px;
}

.philosophy-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Smaller min width for items */
    gap: 20px; /* Smaller gap */
    margin-top: 20px;
}

.philosophy-item {
    padding: 20px; /* Smaller padding */
    background-color: white;
    border-radius: 6px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.philosophy-item h3 {
    font-size: 1.3em; /* Smaller heading */
    color: var(--primary-color);
    margin-bottom: 8px;
}

.philosophy-item p {
    font-size: 0.9em; /* Smaller paragraph */
    line-height: 1.6;
    color: var(--text-light);
}

/* --- Meet the Team Section --- */
.team-section {
    padding: 40px 0;
    text-align: center;
    border-bottom: 1px solid #eee;
    margin-bottom: 30px;
}

.team-section h2 {
    font-size: 2.2em;
    color: var(--accent-color);
    margin-bottom: 25px;
}

.team-members {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); /* Much smaller min width */
    gap: 15px; /* Smaller gap */
    margin-top: 20px;
}

.team-member {
    text-align: center;
}

.team-member img {
    width: 80px; /* Smaller image width */
    height: 80px; /* Smaller image height */
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 8px;
   
    transition: transform 0.3s ease-in-out;
}

.team-member img:hover {
    transform: scale(1.1);
}

.team-member h4 {
    font-size: 1em; /* Smaller heading */
    color: var(--primary-color);
    margin-bottom: 3px;
}

.team-member p {
    font-size: 0.85em; /* Smaller paragraph */
    color: var(--text-light);
}

/* --- Our Commitment Section --- */
.our-commitment {
    padding: 40px 20px; /* Adjust padding */
    background-color: var(--accent-color);
    color: white;
    text-align: center;
    border-radius: 8px;
    margin-bottom: 30px;
}

.our-commitment h2 {
    font-size: 1.8em; /* Smaller heading */
    margin-bottom: 12px;
    letter-spacing: 0.5px;
}

.our-commitment p {
    font-size: 1em; /* Smaller paragraph */
    line-height: 1.6;
    max-width: 600px; /* Smaller max width */
    margin: 0 auto;
}

/* --- Footer --- */
.about-footer {
    text-align: center;
    padding: 20px; /* Adjust padding */
    color: var(--text-light);
    font-size: 0.8em; /* Smaller font size */
    border-top: 1px solid #eee;
}

.about-footer a {
    color: var(--accent-color);
    text-decoration: none;
    transition: color 0.3s ease-in-out;
}

.about-footer a:hover {
    color: var(--primary-color);
}</style>
</html>