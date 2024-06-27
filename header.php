<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_header.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Allura&display=swap">
    <script src="script_header.js" defer></script>
    <title>Header</title>
    <style>
        .favorites-slider h2 {
            margin-left: 20px;
        }

        .cart-slider h2{
            margin-left: 15px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="index.php"><img src="imagini/logo.jpg" alt="Logo" class="logo"></a>
        </div>
        <div class="slogan">
            <p>" Stralucirea ta, pasiunea noastră - Rayon de Beauté "</p>
        </div>
        <div class="buttons">
        <button id="searchBtn" onclick="toggleSearchBox()"><img src="imagini/cauta.jpg" alt="cauta"></button>
    <div id="searchBox" class="search-box">
        <input type="text" id="searchInput" placeholder="Caută produse..." onkeypress="handleSearch(event)">
        <button onclick="searchProducts()">Caută</button>
    </div>
            <div class="login-container">
                <button id="loginBtn" class="login-btn" onclick="window.location.href='login.html'"><img src="imagini/login.jpg" alt="login"></button>
                <div class="login-popup" id="loginPopup">
                    <h3>BUNA!</h3>
                    <p>Intra in cont pentru a te bucura de beneficiile contului tau.</p>
                    <button onclick="window.location.href='login.html'">Conecteaza-te / Inscrie-te</button>
                </div>
            </div>
            <button id="favoritesBtn" onclick="openFavorites()"><img src="imagini/produse_favorite.jpg" alt="Produse favorite"></button>
            <button id="cartBtn" onclick="openCart()"><img src="imagini/cos.jpg" alt="Cos de produse"></button>
        </div>
    <div class="login-popup" id="loginPopup">
        <h3>BUNA!</h3>
        <p>Intra in cont pentru a te bucura de beneficiile contului tau.</p>
        <button onclick="window.location.href='login.html'">Conecteaza-te / Inscrie-te</button>
    </div>

    <!-- Slidebar-ul pentru produsele favorite -->
<div id="favoritesSlider" class="favorites-slider">
    <a href="javascript:void(0)" class="closebtn" onclick="closeFavorites()">&times;</a> <!-- Buton pentru a închide slidebar-ul -->
    <h2>Produse favorite</h2>
    <div id="favoritesItems"></div> <!-- Aici vor fi afișate produsele favorite -->
</div>

<!-- Slidebar-ul pentru coșul de cumpărături -->
<div id="cartSlider" class="cart-slider">
    <a href="javascript:void(0)" class="closebtn" onclick="closeCart()">&times;</a> <!-- Buton pentru a închide slidebar-ul -->
    <h2>Coș de cumpărături</h2> <!-- Titlul pentru coșul de cumpărături -->
    <div id="cartItems"></div> <!-- Aici vor fi afișate numărul de produse din coș -->
    <div id="cartTotal"></div> <!-- Aici va fi afișat prețul total al produselor din coș -->
</div>

        <!-- Meniu -->
        <div class="menu-carousel">
            <ul>
                <li>
                    <a href="category.php?category=Îngrijire ten">Îngrijire ten</a>
                    <div class="submenu">
                        <a href="category.php?category=Îngrijire ten"><b>Vezi toate produsele</b></a>
                        <a href="category.php?category=Îngrijire ten&subcategory=Demachiere față">Demachiere față</a>
                        <a href="category.php?category=Îngrijire ten&subcategory=Tipul de tratament">Tipul de tratament</a>
                        <a href="category.php?category=Îngrijire ten&subcategory=Măști">Măști</a>
                    </div>
                </li>
                <li>
                    <a href="category.php?category=Machiaj">Machiaj</a>
                    <div class="submenu">
                        <a href="category.php?category=Machiaj"><b>Vezi toate produsele</b></a>
                        <a href="category.php?category=Machiaj&subcategory=Ten">Ten</a>
                        <a href="category.php?category=Machiaj&subcategory=Ochi">Ochi</a>
                        <a href="category.php?category=Machiaj&subcategory=Sprâncene">Sprâncene</a>
                        <a href="category.php?category=Machiaj&subcategory=Buze">Buze</a>
                </li>
                <li>
                    <a href="category.php?category=Parfumuri">Parfumuri</a>
                    <div class="submenu">
                        <a href="category.php?category=Parfumuri"><b>Vezi toate produsele</b></a>
                        <a href="category.php?category=Parfumuri&subcategory=Parfumuri unisex">Parfumuri unisex</a>
                        <a href="category.php?category=Parfumuri&subcategory=Parfumuri femei">Parfumuri femei</a>
                        <a href="category.php?category=Parfumuri&subcategory=Parfumuri bărbați">Parfumuri bărbați</a>
                        <a href="category.php?category=Parfumuri&subcategory=Parfumuri de nișă">Parfumuri de nișă</a>
                        <a href="category.php?category=Parfumuri&subcategory=Seturi parfum">Seturi parfum</a>
                    </div>
                </li>
                <li>
                    <a href="category.php?category=Baie-Corp">Baie & Corp</a>
                    <div class="submenu">
                        <a href="category.php?category=Baie-Corp"><b>Vezi toate produsele</b></a>
                        <a href="category.php?category=Baie-Corp&subcategory=Îngrijire corp">Îngrijire corp</a>
                        <a href="category.php?category=Baie-Corp&subcategory=Baie-dus">Baie & duș</a>
                    </div>
                </li>
                <li>
                    <a href="category.php?category=Păr">Păr</a>
                    <div class="submenu">
                        <a href="category.php?category=Păr"><b>Vezi toate produsele</b></a>
                        <a href="category.php?category=Păr&subcategory=Accesorii">Accesorii</a>
                        <a href="category.php?category=Păr&subcategory=Îngrijire păr">Îngrijire păr</a>
                        <a href="category.php?category=Păr&subcategory=Styling">Styling</a>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <!-- Adaugă un formular pentru produsele favorite -->
    <form id="favoritesForm" action="pagina-favorite.html" method="get" style="display: none;">
        <!-- poți adăuga elemente suplimentare aici, dacă este necesar -->
    </form>

    <!-- Adaugă un formular pentru coșul de cumpărături -->
    <form id="cartForm" action="pagina-cos.html" method="get" style="display: none;">
        <!-- poți adăuga elemente suplimentare aici, dacă este necesar -->
    </form>
</body>
</html>