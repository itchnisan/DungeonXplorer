// script.js

// Récupérer les éléments du DOM
const profileBtn = document.getElementById('profile-btn');
const combatBtn = document.getElementById('combat-btn');
const detailsSection = document.getElementById('details');

// Afficher les détails du personnage lors du clic sur "Profil"
profileBtn.addEventListener('click', () => {
    detailsSection.style.display = 'block';
});

// Masquer les détails du personnage lors du clic sur "Combat"
combatBtn.addEventListener('click', () => {
    detailsSection.style.display = 'none';
});
