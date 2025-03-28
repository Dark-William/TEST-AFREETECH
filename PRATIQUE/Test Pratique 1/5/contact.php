<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Formulaire de contact</title>
</head>
<body>
    <h2>Contactez-nous</h2>
    <form action="traitement.php" method="POST">
        <label>Nom :</label>
        <input type="text" name="name" required><br><br>

        <label>Email :</label>
        <input type="email" name="email" required><br><br>

        <label>Message :</label><br>
        <textarea name="message" rows="5" required></textarea><br><br>

        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
