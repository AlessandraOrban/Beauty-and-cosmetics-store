<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style_header.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="script.js" defer></script> <!-- Asigură-te că scriptul este încărcat după ce DOM-ul este gata -->
    <script src="script-cos.js" defer></script> <!-- Asigură-te că scriptul este încărcat după ce DOM-ul este gata -->
    <script src="script_header.js" defer></script>
    <script src="script_footer.js" defer></script>
    <title>Rayon de Beauté</title>
</head>
<body>
    <header></header>
    <div class="carousel-container">
        <div class="carousel">
            <img src="imagini/img318031.jpg" alt="Imagine 1">
            <img src="imagini/1338x491 Spring Deals 12-14 martie.avif" alt="Imagine 2">
            <img src="imagini/1338x491 Kylie Power Plush.avif" alt="Imagine 3">
            <img src="imagini/ich-bb-cushion-1920x692.jpg" alt="imagine 4">
            <img src="imagini/slide_hedison-1920x692.jpg" alt="imagine 5">
        </div>
        <div class="indicators"></div>    
    </div>
    <div class="container">
        <h1>Produse populare</h1>
        <div class="products">
            <?php
            include 'db_connect.php'; // Conexiunea la baza de date
            $sql = "SELECT * FROM rayon_produse LIMIT 5"; // Selectează doar primele 5 produse pentru pagina principală
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($product = $result->fetch_assoc()) {
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
            } else {
                echo "0 rezultate";
            }
            $conn->close();
            ?>
        </div>
    </div>
    <div class="newsletter">
        <h2>Newsletter-ul frumuseții</h2>
        <p>Primește noutățile și ofertele noastre direct pe e-mail! Înscrie-te la newsletter și beneficiezi de un voucher de 50 lei pentru următoarea ta comandă de minim 300 lei</p>
        <p style="color: rgb(139, 139, 139);">Prin înregistrare, sunt de acord să primesc prin email oferte și noutăți de la Rayon de Beauté și declar că am cel puțin 16 ani. Sunt de acord cu prelucrarea datelor mele personale și accept politica de confidențialitate.</p>
        <form id="newsletter-form">
            <label for="email">Introdu adresa ta de email*</label><br>
            <input type="email" id="email" name="email">
            <input type="submit" value="Ma abonez"><br>
            <small style="color: rgb(139, 139, 139);">*Câmpuri obligatorii</small>
        </form>
    </div>
    <div class="rayon-description">
        <div class="column">
            <p>Rayon de Beauté deschide uși către o lume magnifică, plină de idei de cadouri și produse de înfrumusețare esențiale. Descoperă cele mai noi tendințe și caută produsele ce nu trebuie să-ți lipsească niciodată: machiaj, fond de ten, ruj. Completează-ți look-ul cu un strop de parfum. Apa de parfum sau apa de toaletă, căutăm întotdeauna parfumul perfect pentru ea și esențe unice pentru el.</p>
        </div>
        <div class="column">
            <p>După o zi lungă, acordă-ți o binemeritată pauză de relaxare. Noi vom avea grijă de corpul tău, de păr și de perfectiunea feței tale. O rutină de frumusețe ideală împreună cu cele mai bune produse și tratamentele lor inovative: Clarins, Estée Lauder sau Clinique și multe alte branduri.</p>
        </div>
        <div class="column">
            <p>Poți avea părul perfect cu tratamentele de reparație, perfect adaptabile pentru nevoile tale, de la legendara Anastasia Beverly Hills, până la esențialul Olaplex.</p>
            <p>Cauți cadoul perfect? Încearcă un card-cadou. Cu Rayon de Beauté, puterea nelimitată a frumuseții se află în mâinile tale. Iar acesta este doar începutul.</p>
        </div>
    </div>
    <footer></footer>
</body>
</html>
