<?php
$conn = new mysqli("localhost", "root", "", "bdg");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); 

  
    $verif = $conn->prepare("SELECT id FROM utilisateurs WHERE email = ?");
    $verif->bind_param("s", $email);
    $verif->execute();
    $verif->store_result();

    if ($verif->num_rows > 0) {
        $message = "Cet e-mail est déjà utilisé.";
    } else {
        $stmt = $conn->prepare("INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nom, $email, $mot_de_passe);
        if ($stmt->execute()) {
            $message = "Inscription réussie ! <a href='connexion.php'>Se connecter</a>";
        } else {
            $message = "Erreur : " . $conn->error;
        }
        $stmt->close();
    }

    $verif->close();
}
$conn->close();
?>

<h2>Inscription</h2>
<form method="POST">
    <label>Nom :</label>
    <input type="text" name="nom" required><br><br>
    
    <label>Email :</label>
    <input type="email" name="email" required><br><br>
    
    <label>Mot de passe :</label>
    <input type="password" name="mot_de_passe" required><br><br>
    
    <button type="submit">S'inscrire</button>
</form>

<p style="color:red"><?= $message ?></p>
