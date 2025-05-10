<?php

$conn = new mysqli("localhost", "root", "", "bdg");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

  
    $sql = "DELETE FROM livres WHERE id=?";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Erreur de préparation : " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Livre supprimé avec succès. <a href='index.php'>Retour à la liste</a>";
    } else {
        echo "Erreur lors de la suppression : " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID de livre manquant.";
}

$conn->close();
?>
