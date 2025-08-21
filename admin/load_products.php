<?php

$conn = new mysqli("localhost", "root", "", "hike_haus");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM products";
$result = $conn->query($sql);


if ($result) {
 
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>P{$row['id']}</td>
            <td><img src='../image/product/{$row['image']}' width='40'></td>
            <td>{$row['name']}</td>
            <td>{$row['category']}</td>
            <td>₹{$row['price']}</td>
            <td>{$row['stock']}</td>
            <td><button>Edit</button> <button>Delete</button></td>
        </tr>";
    }
} else {
  
    echo "Error fetching products: " . $conn->error;
}

$heroQuery = "SELECT * FROM hero_section WHERE id = 1"; 
$heroResult = $conn->query($heroQuery);

if ($heroResult) {
    $heroData = $heroResult->fetch_assoc();
} else {
    echo "Error fetching hero section: " . $conn->error;
}


$bannerQuery = "SELECT * FROM featured_banner WHERE id = 1"; 
$bannerResult = $conn->query($bannerQuery);

if ($bannerResult) {
    $bannerData = $bannerResult->fetch_assoc();
} else {
    echo "Error fetching featured banner: " . $conn->error;
}


$conn->close();
?>
