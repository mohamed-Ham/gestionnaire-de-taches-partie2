<?php
// On inclut la connexion à la base de données
require 'connexion.php';

// Si le formulaire est envoyé on insère la tâche
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // On prépare la requête d'insertion
    $stmt = $pdo->prepare("
        INSERT INTO taches (titre, description, statut, priorite, date_limite)
        VALUES (?, ?, ?, ?, ?)
    ");

    // On exécute avec les valeurs du formulaire
    $stmt->execute([
        $_POST['titre'],
        $_POST['description'],
        $_POST['statut'],
        $_POST['priorite'],
        $_POST['date_limite']
    ]);
}

// On récupère toutes les tâches triées par priorité
$taches = $pdo->query("
    SELECT * FROM taches
    ORDER BY FIELD(priorite, 'haute', 'moyenne', 'basse')
");

?>