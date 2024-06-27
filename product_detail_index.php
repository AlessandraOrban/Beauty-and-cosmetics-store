<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_header.css">
    <script src="script.js" defer></script>
    <title>Produse populare</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
        }

        .product-container {
            width: 80%; /* sau orice altă lățime dorită */
            margin-top: 20px;
        }

        .product-details {
            display: flex;
            align-items: center;
        }

        .product-image {
            flex: 1;
            margin-right: 20px;
        }

        .product-image img {
            max-width: 100%;
            height: auto;
        }

        .product-info {
            flex: 1;
        }

        .product-info h1 {
            margin-top: 0;
        }

        .product-info p {
            margin: 25px;
        }

        .product-info .price {
            font-size: 22px;
        }

        #show-more {
            color: #c6ac8f; /* Text alb */
            padding: 10px 20px; /* Spațiere interioară */
            border: none; /* Fără margini */
            border-radius: 5px; /* Colțuri rotunjite */
            font-size: 13px; /* Dimensiunea textului */
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    include 'db_connect.php';
    include 'header.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Interogăm baza de date pentru detaliile produsului cu ID-ul specificat
        $stmt = $conn->prepare("SELECT * FROM rayon_produse WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
            // Afișăm detaliile produsului
            echo "<div class='container'>";
echo "<div class='product-container'>";
echo "<div class='product-details'>";
echo "<div class='product-image'>";
echo "<img src='" . $product['image'] . "' alt='" . $product['name'] . "'>";
echo "</div>";
echo "<div class='product-info'>";
echo "<h1>" . $product['name'] . "</h1>";
echo "<p class='price'><strong>Preț:</strong> " . $product['price'] . " RON</p>";
echo "<p id='product-description'><strong>Descriere:</strong> " . $product['description'] . "</p>";
if (strlen($product['description']) > 100) {
    echo "<button id='show-more' onclick='showFullDescription()'>Vezi mai mult</button>";
}
echo "<p><strong>Brand:</strong> " . $product['brand'] . "</p>";
echo "<p><strong>Categorie:</strong> " . $product['category'] . "</p>";
echo "<p><strong>Subcategorie:</strong> " . $product['subcategory'] . "</p>";
echo "<button class='add-to-cart' onclick='addToCart(" . $product['id'] . ", \"" . addslashes($product['name']) . "\", " . $product['price'] . "\"" . addslashes($product['image']) . "\")'>Adaugă în coș</button>";
echo "<button class='add-to-favorites' onclick='addToFavorites(" . $product['id'] . ", \"" . addslashes($product['name']) . "\", " . $product['price'] . ", \"" . addslashes($product['image']) . "\")'><i class='fas fa-heart'></i></button>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";

// JavaScript code for showing full description
echo "<script>";
echo "function showFullDescription() {";
echo "  var button = document.getElementById('show-more');";
echo "  var fullDescription = document.getElementById('product-description');";
echo "  fullDescription.innerHTML = '<strong>Descriere completă:</strong> " . addslashes($product['description']) . "';";
echo "  button.style.display = 'none';";
echo "}";
echo "</script>";
        } else {
            echo "Produsul nu a fost găsit.";
        }
    } else {
        echo "ID de produs lipsă în URL.";
    }

    // JavaScript code for showing full description
echo "<script>";
echo "function showFullDescription() {";
echo "  var button = document.getElementById('show-more');";
echo "  var fullDescription = document.getElementById('product-description');";
echo "  fullDescription.innerHTML = '<strong>Descriere completă:</strong> " . addslashes($product['description']) . "';";
echo "  button.style.display = 'none';";
echo "}";
echo "</script>";

    $stmt->close();
    $conn->close();
    include 'footer.html';
    ?>
</body>
</html>