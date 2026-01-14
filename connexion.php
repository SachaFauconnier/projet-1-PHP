<?php
require 'bdd.php'; //inclusion la fonction de connexion

try {
    $pdo = connexion(); // teste de la connexion
    echo "<p style='color:green;'>Connexion réussie à la base de données !</p>";
} catch (Exception $e) {
    echo "<p style='color:red;'>Échec de la connexion : " . htmlspecialchars($e->getMessage()) . "</p>";
}