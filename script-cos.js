document.addEventListener("DOMContentLoaded", function() {
    var cartItemsDiv = document.getElementById("cartItems");

    // Verificăm dacă există produse în coș
    var cart = JSON.parse(localStorage.getItem('cart')) || [];
    
    if (cart.length === 0) {
        cartItemsDiv.innerHTML = "<p>Coșul tău este gol.</p>";
    } else {
        var subtotal = 0;

        // Parcurgem lista de produse din coș și generăm HTML pentru fiecare produs
        cart.forEach(function(item) {
            var productDiv = document.createElement("div");
            productDiv.classList.add("cart-product");

            var productImage = document.createElement("img");
            productImage.src = item.image; // Assume that item.image contains the URL of the product image
            productImage.alt = item.name; // Optional: set alt attribute for accessibility

            var productName = document.createElement("h3");
            productName.textContent = item.name;

            var productPrice = document.createElement("p");
            productPrice.textContent = item.price + " RON";

            subtotal += parseFloat(item.price);

            productDiv.appendChild(productImage); // Add image first
            productDiv.appendChild(productName); // Add name second
            productDiv.appendChild(productPrice); // Add price third

            cartItemsDiv.appendChild(productDiv);
        });

        // Actualizăm subtotalul și totalul
        document.getElementById("subtotal").textContent = subtotal.toFixed(2) + " Lei";
        document.getElementById("total").textContent = subtotal.toFixed(2) + " Lei";

        // Calculăm suma rămasă pentru transport gratuit
        var shippingCost = 10;
        var freeShippingThreshold = 180;
        var remaining = freeShippingThreshold - subtotal;

        document.getElementById("remaining").textContent = remaining.toFixed(2) + " Lei";
        document.getElementById("progressBar").value = subtotal;

        if (subtotal >= freeShippingThreshold) {
            shippingCost = 0;
            document.getElementById("shipping").textContent = "0,00 Lei";
        } else {
            document.getElementById("shipping").textContent = "10,00 Lei";
        }
    }
});
