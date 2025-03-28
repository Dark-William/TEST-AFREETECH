<?php

$host = 'localhost';
$dbname = 'test_db';
$username = 'root';
$password = '';

// Connexion avec PDO
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion à '{$dbname}' réussie !";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
