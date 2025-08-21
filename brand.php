<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<style>
   .brands {
    text-align: center;
    padding: 30px 10px; 
    background-color: #020202;
}

.brands h2 {
    font-size: 1.6em; 
    color: #fffcfc;
    margin-bottom: 20px; 
}

.brand-logos {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px; 
    flex-wrap: wrap;
}

.brand-logos img {
    max-width: 100px; 
    height: auto;
    opacity: 0.7;
    transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
}

.brand-logos img:hover {
    opacity: 1;
    transform: scale(1.03);
}


@media (max-width: 768px) {
    .brands {
        padding: 20px 5px; 
    }

    .brands h2 {
        font-size: 1.4em; 
        margin-bottom: 15px;
    }

    .brand-logos {
        gap: 10px;
    }

    .brand-logos img {
        max-width: 80px;
    }
}

@media (max-width: 576px) {
    .brands {
        padding: 15px 5px; 
    }

    .brands h2 {
        font-size: 1.2em; 
        margin-bottom: 10px;
    }

    .brand-logos {
        gap: 8px; 
    }

    .brand-logos img {
        max-width: 60px; 
    }
}

</style>
<body>
<section class="brands">
  <h2>Brands We Have Collaborated With</h2>
  <div class="brand-logos">
    <img src="logos/arc’teryx.jpeg" alt="">
    <img src="logos/download (8).jpeg" alt="">
    <img src="logos/download (9).jpeg" alt="">
    <img src="logos/Gratis verzending vanaf €50 _ Zwerfkei_nl.jpeg" alt="">
    <img src="logos/The North Face logo vector download (1).jpeg" alt="">
    <img src="logos/SALEWA mit neuem Markenauftritt - Design Tagebuch.jpeg" alt="">
  </div>
</section>

</body>
</html>