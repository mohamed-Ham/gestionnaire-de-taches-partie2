<?php
require 'connexion.php';

// Si le formulaire est envoyé, on insère la tâche
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("INSERT INTO taches (titre, description, statut, priorite, date_limite) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['titre'], $_POST['description'], $_POST['statut'], $_POST['priorite'], $_POST['date_limite']]);
}

// On récupère toutes les tâches triées par priorité
$taches = $pdo->query("SELECT * FROM taches ORDER BY FIELD(priorite, 'haute', 'moyenne', 'basse')");
?>

<h1>Gestion des tâches</h1>

<!-- Formulaire pour ajouter une tâche -->
<form method="post" onsubmit="return valider()">
    Titre : <input type="text" name="titre" id="t"><br>
    Description : <input type="text" name="description"><br>
    Statut :
    <select name="statut">
        <option value="a_faire">À faire</option>
        <option value="en_cours">En cours</option>
        <option value="termine">Terminé</option>
    </select><br>
    Priorité :
    <select name="priorite">
        <option value="haute">Haute</option>
        <option value="moyenne">Moyenne</option>
        <option value="basse">Basse</option>
    </select><br>
    Date limite : <input type="date" name="date_limite"><br>
    <button type="submit">Ajouter</button>
</form>

<!-- Tableau des tâches -->
<table border="1">
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Statut</th>
        <th>Priorité</th>
        <th>Date limite</th>
    </tr>
    <?php foreach ($taches as $t) : ?>
    <tr>
        <td><?= htmlspecialchars($t['titre']) ?></td>
        <td><?= htmlspecialchars($t['description']) ?></td>
        <td><?= $t['statut'] ?></td>
        <td><?= $t['priorite'] ?></td>
        <td><?= $t['date_limite'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<script>
    // Vérifie que le titre n'est pas vide avant d'envoyer
    function valider() {
        if (!document.getElementById('t').value) {
            alert('Le titre est obligatoire');
            return false;
        }
    }
</script>