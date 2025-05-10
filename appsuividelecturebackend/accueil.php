<?php
$conn = new mysqli("localhost", "root", "", "bdg");

if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

$livres = $conn->query("SELECT * FROM livres ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Application de suivi de lecture</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Biblio<span>Gest</span></h1>
        <nav class="menu">
            <ul>
                <li>Accueil</li>
                <li>Services</li>
                <li>Contact</li>
                <li><a href="connecter.html">Se connecter</a></li>
                <li><a href="formuINS.html">S'inscrire</a></li>
            </ul>
        </nav>
    </header>

    <section id="livre">
        <a href="ajouterlivre.html">Ajout nouveau livre</a>
        <h2>Nos Livres</h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php while ($livre = $livres->fetch_assoc()) : ?>
                <div class="col">
                    <div class="card">
                        <img src="R.jpg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($livre['titre']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($livre['auteur']) ?></p>
                            <td>
        <a href="modifier_livre.php?id=<?= $livre['id'] ?>">Modifier</a>
        <a href="supprimer_livre.php?id=<?= $livre['id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce livre ?')">Supprimer</a>

      </td>
                        </div>
                    </div>
                </div>
            <?php endwhile;?>
        </div>
    </section>

    <footer>copyright2024-RD-@production</footer>
</body>
</html>

<?php $conn->close(); ?>








