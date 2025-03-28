<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    if (!$email) {
        die("Adresse email non valide !");
    }

    try {
        $pdo = new PDO("mysql:host=localhost;dbname=test_db;charset=utf8", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO contacts (name, email, message) VALUES (:name, :email, :message)");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':message' => $message
        ]);

        echo "Message envoyé avec succès !";
    } catch (PDOException $e) {
        die("Erreur : " . $e->getMessage());
    }
} else {
    echo "Accès non autorisé !";
}
