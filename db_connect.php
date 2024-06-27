<?php
$servername = "localhost";
$username = "root"; // sau utilizatorul configurat în phpMyAdmin
$password = ""; // parola utilizatorului
$dbname = "produse";

// Creează conexiunea
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifică conexiunea
if ($conn->connect_error) {
    die("Conexiunea a eșuat: " . $conn->connect_error);
}
?>