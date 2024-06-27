document.addEventListener('DOMContentLoaded', function () {
    const carousel = document.querySelector('.carousel');
    const indicatorsContainer = document.querySelector('.indicators');
    let currentIndex = 0;
    let intervalId;

    function nextSlide() {
        currentIndex = (currentIndex + 1) % carousel.children.length;
        updateCarousel();
    }

    function updateCarousel() {
        const translateValue = -currentIndex * 100 + '%';
        carousel.style.transform = 'translateX(' + translateValue + ')';
        updateIndicators();
    }

    function updateIndicators() {
        const indicators = Array.from(indicatorsContainer.children);
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentIndex);
        });
    }

    function goToSlide(index) {
        currentIndex = index;
        updateCarousel();
    }

    // Adaugă indicatori pentru fiecare imagine
    for (let i = 0; i < carousel.children.length; i++) {
        const indicator = document.createElement('div');
        indicator.classList.add('indicator');
        indicator.addEventListener('click', () => {
            goToSlide(i);
        });
        indicatorsContainer.appendChild(indicator);
    }

    // Inițializează caruselul
    updateCarousel();

    // Setează schimbarea automată a imaginilor la fiecare 5 secunde
    intervalId = setInterval(nextSlide, 5000);

    // Oprește intervalul când utilizatorul interacționează cu caruselul
    carousel.addEventListener('mouseenter', () => clearInterval(intervalId));
    carousel.addEventListener('mouseleave', () => {
        intervalId = setInterval(nextSlide, 7000);
    });
});



const form = document.getElementById("newsletter-form");

form.addEventListener("submit", function(event) {
  event.preventDefault();

  const email = document.getElementById("email").value;

  // Send the email address to your email list
  // You can use an email marketing service like Mailchimp or Sendinblue

  // Display a success message
  alert("Thank you for subscribing!");

  // Clear the email input field
  document.getElementById("email").value = "";
});

fetch('/api/produse')
    .then(response => response.json())
    .then(produse => {
        // Iterăm prin lista de produse și le afișăm în interfața utilizatorului
        produse.forEach(produs => {
            // Creează elementele HTML pentru fiecare produs și adaugă-le în DOM
        });
    })
    .catch(error => console.error('Eroare la obținerea datelor despre produse:', error));

    const express = require('express');
const app = express();
const port = 3000;

// Definim rutele pentru API
app.get('/api/produse', (req, res) => {
    // Aici facem interogările către baza de date pentru a obține produsele
    res.json(produse); // Trimitem produsele ca răspuns JSON
});

app.listen(port, () => {
    console.log(`Serverul ascultă pe http://localhost:${port}`);
});


const mysql = require('mysql');

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: '',
    database: 'produse'
});

connection.connect(err => {
    if (err) {
        console.error('Eroare la conectarea la baza de date:', err);
        return;
    }
    console.log('Conectat la baza de date MySQL');
});

