<?php
include 'db_connect.php';

// Verifică conexiunea
if ($conn->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $conn->connect_error);
}

// Preia termenul de căutare din cerere
$searchQuery = $_GET['q'];

// Interogare pentru a căuta produsele
$sql = "SELECT * FROM rayon_produse WHERE name LIKE '%$searchQuery%' OR brand LIKE '%$searchQuery%'";

$result = $conn->query($sql);

// Verifică dacă există rezultate
if ($result->num_rows > 0) {
    // Afiseaza rezultatele
    while($row = $result->fetch_assoc()) {
        echo "Nume: " . $row["name"]. " - Brand: " . $row["brand"]. "<br>";
    }
} else {
    echo "Nu s-au găsit rezultate pentru căutarea '" . $searchQuery . "'.";
}

$conn->close();
?>
