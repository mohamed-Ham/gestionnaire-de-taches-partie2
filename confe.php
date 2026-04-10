<?php
// On inclut index.php qui gère la connexion et les données
require 'configuration/index.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des tâches</title>
    <!-- On charge le fichier JavaScript -->
    <script src="js/conf.js"></script>
</head>
<body>

<h1>Gestion des tâches</h1>

<!-- Formulaire pour ajouter une tâche -->
<!-- onsubmit appelle valider() avant d'envoyer -->
<form method="post" onsubmit="return valider()">

    <!-- id="t" permet à JavaScript de récupérer la valeur -->
    Titre : <input type="text" name="titre" id="t"><br>

    Description : <input type="text" name="description"><br>

    <!-- Liste déroulante pour le statut -->
    Statut :
    <select name="statut">
        <option value="a_faire">a faire</option>
        <option value="en_cours">en cours</option>
        <option value="termine">terminé</option>
    </select><br>

    <!-- Liste déroulante pour la priorité -->
    Priorité :
    <select name="priorite">
        <option value="haute">haute</option>
        <option value="moyenne">moyenne</option>
        <option value="basse">basse</option>
    </select><br>

    Date limite : <input type="date" name="date_limite"><br>

    <button type="submit">ajouter</button>
</form>

<!-- Boutons qui appellent la fonction filtrer() du fichier script.js -->
Filtre :
<button onclick="filtrer('tous')">toutes</button>
<button onclick="filtrer('a_faire')">a faire</button>
<button onclick="filtrer('termine')">terminées</button>

<!-- Tableau des tâches, id="tab" utilisé par le filtre JavaScript -->
<table border="1" id="tab">
    <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Statut</th>
        <th>Priorité</th>
        <th>Date limite</th>
    </tr>

    <!-- On boucle sur chaque tâche récupérée dans index.php -->
    <?php foreach ($taches as $t) : ?>
    <!-- La classe de chaque ligne = son statut, utilisé par filtrer() -->
    <tr class="<?= $t['statut'] ?>">
        <td><?= htmlspecialchars($t['titre']) ?></td>
        <td><?= htmlspecialchars($t['description']) ?></td>
        <td><?= $t['statut'] ?></td>
        <td><?= $t['priorite'] ?></td>
        <td><?= $t['date_limite'] ?></td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>