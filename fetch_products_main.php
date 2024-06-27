<?php
include 'db_connect.php';

// Selectează doar primele 5 produse pentru pagina principală
$sql = "SELECT id, name, brand, price, category, subcategory, image FROM rayon_produse LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='product-card'>";
        if (!empty($row["image"])) {
            echo "<img src='" . $row["image"] . "' alt='" . $row["name"] . "' class='product-image'>";
        }
        echo "<h2>" . $row["name"] . "</h2>";
        echo "<p class='price'>Preț: " . $row["price"] . " RON</p>";
        echo "</div>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

