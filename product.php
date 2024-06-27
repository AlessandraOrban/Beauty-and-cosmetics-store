<?php
include 'db_connect.php'; // Conexiunea la baza de date

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Obține detaliile produsului din baza de date
    $stmt = $conn->prepare("SELECT * FROM rayon_produse WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        $product_name = htmlspecialchars($product['name']);
        $product_image = htmlspecialchars($product['image']);
        $product_brand = htmlspecialchars($product['brand']);
        $product_description = htmlspecialchars($product['description']);
        $product_category = htmlspecialchars($product['category']);
        $product_subcategory = htmlspecialchars($product['subcategory']);
        $product_price = htmlspecialchars($product['price']);
        $max_length = 500; // Numărul maxim de caractere pentru descriere
        if (strlen($product_description) > $max_length) {
            $product_short_description = substr($product_description, 0, $max_length) . '...';
        } else {
            $product_short_description = $product_description;
        }
    } else {
        $error_message = "Produsul nu a fost găsit.";
    }

    $stmt->close();
} else {
    $error_message = "ID-ul produsului nu a fost specificat.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="script.js" defer></script>
    <script src="script_header.js" defer></script>
    <script src="script_footer.js" defer></script>
    <title><?php echo isset($product_name) ? $product_name : "Eroare"; ?></title>
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
/* Restul stilurilor specifice produsului */

    </style>
</head>
<body>
    <header></header>
    <div class="container">
    <div class="product-container">
            <?php if (isset($error_message)): ?>
                <p><?php echo $error_message; ?></p>
            <?php else: ?>
                <div class="product-details">
                    <div class="product-image">
                        <img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">
                    </div>
                    <div class="product-info">
                        <h1><?php echo $product_name; ?></h1>
                        <p class="price"><strong>Preț:</strong> <?php echo $product_price; ?> RON</p>
                        <!-- Afiseaza descrierea scurta -->
                        <p id="product-description"><strong>Descriere:</strong> <?php echo $product_short_description; ?></p>
                        <?php if (strlen($product_description) > $max_length): ?>
                            <!-- Adaugă un buton pentru a afișa descrierea completă -->
                            <button id="show-more">Vezi mai mult</button>
                            <p id="full-description" style="display: none;"><?php echo substr($product_description, $max_length); ?></p>
                        <?php endif; ?>
                        <!-- Afiseaza restul detaliilor -->
                        <p><strong>Brand:</strong> <?php echo $product_brand; ?></p>
                        <p><strong>Categorie:</strong> <?php echo $product_category; ?></p>
                        <p><strong>Subcategorie:</strong> <?php echo $product_subcategory; ?></p>
                        <button class="add-to-cart" onclick="addToCart('<?php echo $product['id']; ?>', '<?php echo addslashes($product['name']); ?>', '<?php echo $product['price']; ?>', '<?php echo addslashes($product['image']); ?>')">Adaugă în coș</button>
                        <button class="add-to-favorites" onclick="addToFavorites('<?php echo $product['id']; ?>', '<?php echo addslashes($product['name']); ?>', '<?php echo $product['price']; ?>', '<?php echo addslashes($product['image']); ?>')"><i class='fas fa-heart'></i></button>
                    </div>
                </div>
            <?php endif; ?>
     </div>
 </div>

    <script>
        document.getElementById('show-more').addEventListener('click', function() {
            // Adaugă restul descrierii la descrierea scurtă
            document.getElementById('product-description').innerHTML += document.getElementById('full-description').innerHTML;
            // Ascunde butonul "Vezi mai mult"
            this.style.display = 'none';
        });
    </script>
    <footer></footer>
</body>
</html>
