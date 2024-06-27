<?php
include 'db_connect.php';

// Verificăm dacă există un ID de produs în URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Interogăm baza de date pentru detalii despre produsul cu ID-ul specificat
    $stmt = $conn->prepare("SELECT * FROM rayon_produse WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificăm dacă există un rezultat
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        // Afișăm detaliile produsului
        echo "<h2>" . $product['name'] . "</h2>";
        echo "<p>Brand: " . $product['brand'] . "</p>";
        echo "<p>Descriere: " . $product['description'] . "</p>";
        echo "<p>Categorie: " . $product['category'] . "</p>";
        echo "<p>Subcategorie: " . $product['subcategory'] . "</p>";
        echo "<p>Preț: " . $product['price'] . " RON</p>";
    } else {
        echo "Produsul nu a fost găsit.";
    }
} else {
    echo "ID de produs lipsă în URL.";
}

$stmt->close();
$conn->close();
?>
