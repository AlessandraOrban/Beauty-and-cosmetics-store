<?php
include 'db_connect.php'; // Conexiunea la baza de date

$category = isset($_GET['category']) ? $_GET['category'] : '';
$subcategory = isset($_GET['subcategory']) ? $_GET['subcategory'] : '';

// Verificăm dacă există o subcategorie specificată în URL
if (!empty($subcategory)) {
    // Interogare pregătită pentru a selecta produsele din categoria și subcategoria specificată
    $stmt = $conn->prepare("SELECT * FROM rayon_produse WHERE category = ? AND subcategory = ?");
    $stmt->bind_param("ss", $category, $subcategory);
} else {
    // Dacă nu există o subcategorie specificată, selectăm doar produsele din categoria specificată
    $stmt = $conn->prepare("SELECT * FROM rayon_produse WHERE category = ?");
    $stmt->bind_param("s", $category);
}

$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="script.js" defer></script>
    <script src="script_header.js" defer></script>
    <script src="script_footer.js" defer></script>
    <title><?php echo htmlspecialchars($category); ?></title>
</head>
<body>
    <header></header>
    <div class="container">
        <h1><?php echo htmlspecialchars($category); ?></h1>
        <?php if (!empty($subcategory)) : ?>
            <h2><?php echo htmlspecialchars($subcategory); ?></h2>
        <?php endif; ?>
        <div class="products">
            <?php while ($product = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <a href="product.php?id=<?php echo htmlspecialchars($product['id']); ?>">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class='price'><strong>Preț:</strong> <?php echo htmlspecialchars($product['price']); ?> RON</p>
                    </a>
                    <button class="add-to-cart" onclick="addToCart('<?php echo $product['id']; ?>', '<?php echo addslashes($product['name']); ?>', '<?php echo $product['price']; ?>', '<?php echo addslashes($product['image']); ?>')">Adaugă în coș</button>
                    <button class="add-to-favorites" onclick="addToFavorites('<?php echo $product['id']; ?>', '<?php echo addslashes($product['name']); ?>', '<?php echo $product['price']; ?>', '<?php echo addslashes($product['image']); ?>')"><i class='fas fa-heart'></i></button>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <footer></footer>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
