// Vérifie que le titre n'est pas vide avant d'envoyer le formulaire
function valider() {
    if (!document.getElementById('t').value) {
        alert('Le titre est obligatoire');
        return false; // bloque l'envoi du formulaire
    }
    return true; // autorise l'envoi
}

// Filtre les lignes du tableau selon le statut choisi
function filtrer(statut) {

    // On récupère toutes les lignes qui ont une classe CSS
    var lignes = document.querySelectorAll('#tab tr[class]');

    // On parcourt chaque ligne
    for (var i = 0; i < lignes.length; i++) {
        if (statut === 'tous') {
            lignes[i].style.display = ''; // on affiche tout
        } else if (lignes[i].className === statut) {
            lignes[i].style.display = ''; // on affiche si statut correspond
        } else {
            lignes[i].style.display = 'none'; // on cache sinon
        }
    }
}