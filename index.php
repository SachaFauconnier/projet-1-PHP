<?php
require 'header.php';
require 'bdd.php'; // contient la fonction connexion()

// Connexion à la base
$pdo = connexion();

// Récupération des œuvres
try {
    $stmt = $pdo->query("SELECT * FROM oeuvre"); 
    $oeuvres = $stmt->fetchAll(); // stocke toutes les œuvres dans $oeuvres
} catch (PDOException $e) {
    die("Erreur lors de la récupération des œuvres : " . $e->getMessage());
}
?>

<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= htmlspecialchars($oeuvre['id']) ?>">
                <img src="<?= htmlspecialchars($oeuvre['image']) ?>" alt="<?= htmlspecialchars($oeuvre['titre']) ?>">
                <h2><?= htmlspecialchars($oeuvre['titre']) ?></h2>
                <p class="description"><?= htmlspecialchars($oeuvre['artiste']) ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>

<?php require 'footer.php'; ?>