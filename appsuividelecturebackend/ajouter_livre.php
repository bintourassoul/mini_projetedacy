<?php


$host = "localhost";
$dbname = "bdg";
$username = "root"; 
$password = "";     

$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST["titre"];
    $auteur = $_POST["auteur"];

   
    $stmt = $conn->prepare("INSERT INTO livres (titre, auteur) VALUES (?, ?)");
    $stmt->bind_param("ss", $titre, $auteur);

    if ($stmt->execute()) {
        echo "Livre ajouté avec succès.";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: liste_livres.php");
exit;
?>

