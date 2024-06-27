<?php
// Conectare la baza de date sau includerea fișierului cu conexiunea la baza de date

// Verificăm dacă există un ID de produs în URL
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Realizăm interogarea pentru a obține informațiile despre produs
    // Aici trebuie să ai o interogare SQL pentru a obține detaliile produsului cu ID-ul specificat
    // Poți folosi parametrul $product_id pentru a filtra rezultatele

    // Exemplu de interogare SQL (asigură-te că o adaptezi la structura și denumirile tabelelor tale):
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $sql);
    $product = mysqli_fetch_assoc($result);

    // Afișăm informațiile despre produs
    // Asigură-te că afișezi fiecare detaliu despre produs (imagine, nume, brand, descriere, categorie, subcategorie, preț)
}
else {
    // Dacă nu există un ID de produs în URL, afișăm un mesaj de eroare sau redirecționăm către pagina principală
    echo "Produsul nu a fost găsit.";
}
?>
