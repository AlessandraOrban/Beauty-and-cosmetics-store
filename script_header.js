document.addEventListener("DOMContentLoaded", function() {
    fetch("header.php")
        .then(response => response.text())
        .then(data => {
            document.querySelector("header").innerHTML = data;
        });
});

document.addEventListener('DOMContentLoaded', function () {
    const menuItems = document.querySelectorAll('.menu-carousel li');

    menuItems.forEach(item => {
        item.addEventListener('mouseenter', function () {
            this.classList.add('active');
        });

        item.addEventListener('mouseleave', function () {
            this.classList.remove('active');
        });
    });
});

function toggleSearchBox() {
    var searchBox = document.getElementById('searchBox');
    searchBox.style.display = (searchBox.style.display === 'block') ? 'none' : 'block';
}

function searchProducts() {
    var searchQuery = document.getElementById('searchInput').value.trim();

    if (searchQuery) {
        window.location.href = 'search_results.php?q=' + encodeURIComponent(searchQuery);
    }
}



// Funcția care gestionează apăsarea tastei Enter pentru a efectua căutarea
function handleSearch(event) {
    if (event.key === 'Enter') {
        searchProducts();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const favoritesBtn = document.getElementById('favoritesBtn');
    const favoritesForm = document.getElementById('favoritesForm');

    favoritesBtn.addEventListener('click', function () {
        favoritesForm.submit();
    });

    const cartBtn = document.getElementById('cartBtn');
    const cartForm = document.getElementById('cartForm');

    cartBtn.addEventListener('click', function () {
        cartForm.submit();
    });
});

function openFavorites() {
    var favoritesSlider = document.getElementById("favoritesSlider");
    favoritesSlider.style.width = "250px";
    updateFavoritesInfo();
}

function closeFavorites() {
    document.getElementById("favoritesSlider").style.width = "0";
}

function updateFavoritesInfo() {
    var favoritesList = JSON.parse(localStorage.getItem('favorites')) || [];
    var favoritesItemsDiv = document.getElementById("favoritesItems");
    favoritesItemsDiv.innerHTML = "";

    favoritesList.forEach(function(product) {
        var listItem = document.createElement("div");
        listItem.textContent = product.name;
        
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "Șterge";
        deleteButton.onclick = function() {
            removeFromFavorites(product.id);
        };

        var addToCartButton = document.createElement("button");
        addToCartButton.textContent = "Adaugă în coș";
        addToCartButton.onclick = function() {
            addToCart(product.id, product.name);
        };

        listItem.appendChild(deleteButton);
        listItem.appendChild(addToCartButton);
        favoritesItemsDiv.appendChild(listItem);
    });
}

function addToFavorites(productId, productName) {
    var favoriteItem = { id: productId, name: productName };
    var favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    favorites.push(favoriteItem);
    localStorage.setItem('favorites', JSON.stringify(favorites));
    updateFavoritesInfo();
    openFavorites();
}

function removeFromFavorites(productId) {
    var favorites = JSON.parse(localStorage.getItem('favorites')) || [];
    var updatedFavorites = favorites.filter(item => item.id !== productId);
    localStorage.setItem('favorites', JSON.stringify(updatedFavorites));
    updateFavoritesInfo();
}

function openCart() {
    var cartSlider = document.getElementById("cartSlider");
    cartSlider.style.width = "250px";
    updateCartInfo();
}

function closeCart() {
    document.getElementById("cartSlider").style.width = "0";
}

function updateCartInfo() {
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    var cartItemsDiv = document.getElementById("cartItems");
    cartItemsDiv.innerHTML = "";

    cart.forEach(function(item) {
        var listItem = document.createElement("div");
        listItem.classList.add("cart-product");

        var productImage = document.createElement("img");
        productImage.src = item.image;
        productImage.alt = item.name;
        productImage.classList.add("cart-product-image");

        var productDetails = document.createElement("div");
        productDetails.textContent = item.name + " - " + item.price + " RON";

        var deleteButton = document.createElement("button");
        deleteButton.innerHTML = '<i class="fa fa-trash"></i>';
        deleteButton.classList.add("delete-button");
        deleteButton.onclick = function() {
            removeFromCart(item.id);
        };

        listItem.appendChild(productImage);
        listItem.appendChild(productDetails);
        listItem.appendChild(deleteButton);
        cartItemsDiv.appendChild(listItem);
    });

    var totalPrice = cart.reduce((total, item) => total + parseFloat(item.price), 0);
    document.getElementById("cartTotal").innerHTML = "Preț total: " + totalPrice.toFixed(2) + " RON";

    var viewCartButton = document.createElement("button");
    viewCartButton.textContent = "Vezi coș";
    viewCartButton.onclick = function() {
        viewCart();
    };

    var cartFooter = document.createElement("div");
    cartFooter.appendChild(viewCartButton);
    cartItemsDiv.appendChild(cartFooter);
}

function viewCart() {
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    var form = document.createElement("form");
    form.method = "POST";
    form.action = "cosul-tau.php";

    var input = document.createElement("input");
    input.type = "hidden";
    input.name = "cart";
    input.value = JSON.stringify(cart);

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}

function addToCart(productId, productName, productPrice, productImage) {
    var cartItem = { id: productId, name: productName, price: productPrice, image: productImage };
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push(cartItem);
    localStorage.setItem('cart', JSON.stringify(cart));
    updateCartInfo();
    openCart();
}

function removeFromCart(productId) {
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    var updatedCart = cart.filter(item => item.id !== productId);
    localStorage.setItem('cart', JSON.stringify(updatedCart));
    updateCartInfo();
}