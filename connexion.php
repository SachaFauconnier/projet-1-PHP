<?php
require 'bdd.php'; // on inclut la fonction de connexion

try {
    $pdo = connexion(); // on teste la connexion
    echo "<p style='color:green;'>Connexion réussie à la base de données !</p>";
} catch (Exception $e) {
    echo "<p style='color:red;'>Échec de la connexion : " . htmlspecialchars($e->getMessage()) . "</p>";
}