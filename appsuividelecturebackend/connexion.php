<?php
session_start();
$conn = new mysqli("localhost", "root", "", "bdg");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    $stmt = $conn->prepare("SELECT id, nom, mot_de_passe FROM utilisateurs WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $nom, $hash);
        $stmt->fetch();

        if (password_verify($mot_de_passe, $hash)) {
            $_SESSION['utilisateur_id'] = $id;
            $_SESSION['utilisateur_nom'] = $nom;
            header("Location: dashboard.php");
            exit;
        } else {
            $message = "Mot de passe incorrect.";
        }
    } else {
        $message = "Aucun compte trouvé avec cet e-mail.";
    }

    $stmt->close();
}
$conn->close();
?>

<h2>Connexion</h2>
<form method="POST">
    <label>Email :</label>
    <input type="email" name="email" required><br><br>
    
    <label>Mot de passe :</label>
    <input type="password" name="mot_de_passe" required><br><br>
    
    <button type="submit">Se connecter</button>
</form>

<p style="color:red"><?= $message ?></p>
