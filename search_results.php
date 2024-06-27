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
    <title>Rezultatele cautarii</title>
</head>
<body>
    <header></header>
    <div class="container">
    <?php
    // Include fișierul de conectare la baza de date
    include 'db_connect.php';

    // Verifică dacă a fost trimisă o cerere de căutare
    if(isset($_GET['q'])) {
        $searchQuery = $_GET['q'];

        // Interogare pentru a căuta produsele
        $sql = "SELECT * FROM rayon_produse WHERE name LIKE '%$searchQuery%' OR brand LIKE '%$searchQuery%'";
        $result = $conn->query($sql);

        // Verifică dacă există rezultate
        if ($result->num_rows > 0) {
            // Afisează rezultatele căutării într-un mod adecvat
            echo "<h2>Rezultatele căutării pentru: " . $searchQuery . "</h2>";
            echo "<div class='products'>"; // începutul containerului pentru produse

            // Loop prin fiecare rând de rezultate și afișarea produselor
            while($product = $result->fetch_assoc()) {
                echo "<div class='product-card'>";
                echo "<a href='product_detail_index.php?id=" . $product['id'] . "'>";
                echo "<img src='" . $product['image'] . "' alt='" . $product['name'] . "'>";
                echo "<h2>" . $product['name'] . "</h2>";
                echo "<p><strong>Preț: </strong>" . $product['price'] . " RON </p>";
                echo "</a>";
                // Buton pentru adăugarea în coș
                echo "<button class='add-to-cart' onclick='addToCart(" . $product['id'] . ", \"" . $product['name'] . "\", " . $product['price'] . ")'>Adaugă în coș</button>";
                echo "<button class='add-to-favorites' onclick='addToFavorites(" . $product['id'] . ", \"" . addslashes($product['name']) . "\", " . $product['price'] . ", \"" . addslashes($product['image']) . "\")'><i class='fas fa-heart'></i></button>";
                echo "</div>";
            }

            echo "</div>"; // sfârșitul containerului pentru produse
        } else {
            // Dacă nu s-au găsit rezultate, afișează un mesaj corespunzător
            echo "<p>Nu s-au găsit rezultate pentru căutarea '" . $searchQuery . "'.</p>";
        }
    } else {
        // Dacă nu a fost specificat un termen de căutare, afișează un mesaj corespunzător
        echo "<p>Vă rugăm să introduceți un termen de căutare.</p>";
    }
    
    // Închide conexiunea la baza de date
    $conn->close();
    ?>
    </div>
    <footer></footer>
</body>
</html>