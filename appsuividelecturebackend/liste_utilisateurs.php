<?php

$conn = new mysqli("localhost", "root", "", "bdg");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}


$sql = "SELECT id, nom, email FROM utilisateurs";
$result = $conn->query($sql);
?>

<h2>Liste des utilisateurs inscrits</h2>
<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Email</th>
    </tr>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($user = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['nom']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="3">Aucun utilisateur trouvé.</td></tr>
    <?php endif; ?>
</table>

<?php $conn->close(); ?>
