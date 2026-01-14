<?php
    require 'bdd.php'; 

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ajouter.php');
    exit;
}

$postData = $_POST;

// Nettoyage
$titre       = trim($_POST['titre'] ?? '');
$artiste     = trim($_POST['artiste'] ?? '');
$image       = trim($_POST['image'] ?? '');
$description = trim($_POST['description'] ?? '');

// Validation
if (
    empty($titre) ||
    empty($artiste) ||
    empty($image) ||
    mb_strlen($description) <= 3
) {
    if (empty($titre) || empty($artiste) || empty($image) || mb_strlen($description) <= 3) {
    echo "<script>alert('Formulaire invalide ❌'); window.location.href='ajouter.php';</script>";
    exit;
}
}

// Connexion BDD
$pdo = connexion();

// Insertion SQL
$sql = "INSERT INTO oeuvre (titre, artiste, image, description)
        VALUES (:titre, :artiste, :image, :description)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'titre' => $titre,
    'artiste' => $artiste,
    'image' => $image,
    'description' => $description
]);

echo "Œuvre ajoutée avec succès ✅";

// Message et redirection
$message = "Œuvre ajoutée avec succès !";
$redirection = "ajouter.php"; // ou ajouter.php si tu veux rester sur le formulaire

echo "<script>
    alert('". addslashes($message) ."'); 
    window.location.href = '". addslashes($redirection) ."';
</script>";
exit;