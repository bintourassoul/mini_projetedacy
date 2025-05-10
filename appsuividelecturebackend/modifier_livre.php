<?php

$conn = new mysqli("localhost", "root", "", "bdg");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    

   
    $sql = "UPDATE livres SET titre=?, auteur=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
    die("Erreur de préparation : " . $conn->error);
}
    $stmt->bind_param("ssi", $titre, $auteur, $id);

    if ($stmt->execute()) {
        echo "Livre mis à jour avec succès. <a href='accueil.php'>Retour à la liste</a>";
    } else {
        echo "Erreur lors de la mise à jour : " . $conn->error;
    }

    $stmt->close();
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

       
        $sql = "SELECT * FROM livres WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $livre = $result->fetch_assoc();

        if (!$livre) {
            echo "Livre non trouvé.";
            exit;
        }
    } else {
        echo "ID de livre manquant.";
        exit;
    }
}
?>

<?php if ($_SERVER["REQUEST_METHOD"] !== "POST"): ?>
<h2>Modifier le livre</h2>
<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $livre['id'] ?>">

    <label for="titre">Titre :</label>
    <input type="text" name="titre" value="<?= htmlspecialchars($livre['titre']) ?>" required><br><br>

    <label for="auteur">Auteur :</label>
    <input type="text" name="auteur" value="<?= htmlspecialchars($livre['auteur']) ?>" required><br><br>

    

    <button type="submit">Mettre à jour</button>
</form>
<?php endif; ?>

<?php $conn->close(); ?>
