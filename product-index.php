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
    <script src="script_header.js" defer></script>
    <script src="script_footer.js" defer></script>
    <title><?php echo isset($product_name) ? $product_name : "Eroare"; ?></title>
    <style>
        .product-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .product-container img {
            max-width: 100%;
            height: auto;
            max-height: 300px;
        }
        .product-container h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .product-container p {
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .product-container .price {
            font-size: 1.5em;
            color: #000;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header></header>
    <div class="container">
        <div class="product-container">
            <?php if (isset($error_message)): ?>
                <p><?php echo $error_message; ?></p>
            <?php else: ?>
                <h1><?php echo $product_name; ?></h1>
                <img src="<?php echo $product_image; ?>" alt="<?php echo $product_name; ?>">
                <p><strong>Brand:</strong> <?php echo $product_brand; ?></p>
                <p><strong>Descriere:</strong> <?php echo $product_description; ?></p>
                <p><strong>Categorie:</strong> <?php echo $product_category; ?></p>
                <p><strong>Subcategorie:</strong> <?php echo $product_subcategory; ?></p>
                <p class="price"><strong>Preț:</strong> <?php echo $product_price; ?> RON</p>
            <?php endif; ?>
        </div>
    </div>
    <footer></footer>
</body>
</html>