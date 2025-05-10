<?php
$conn = new mysqli("localhost", "root", "", "bdg");

if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM livres ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des livres</title>
</head>
<body>
    <h1>Liste des livres</h1>
    <a href="index.html">Ajouter un autre livre</a>
    <ul>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <li><strong><?= htmlspecialchars($row['titre']) ?></strong> par <?= htmlspecialchars($row['auteur']) ?></li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
