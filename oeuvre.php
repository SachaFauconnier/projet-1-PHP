<?php
    require 'header.php';
    require 'bdd.php';

    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if(empty($_GET['id'])) {
        header('Location: index.php');
    }

    // Sécurisation de l'id
    $id = intval($_GET['id']); 


    // Connexion à la base
    $pdo = connexion();

    // Requête préparée pour récupérer l'oeuvre correspondant à l'id
    $stmt = $pdo->prepare("SELECT * FROM oeuvre WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $oeuvre = $stmt->fetch(); // fetch renvoie false si aucune oeuvre

   // Gestion d'un id inexistant
    if (!$oeuvre) {

        // redirection vers l'accueil
         header('Location: index.php');
         exit;
         }
?>
 
<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= htmlspecialchars($oeuvre['image']) ?>" alt="<?= htmlspecialchars($oeuvre['titre']) ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= htmlspecialchars($oeuvre['titre']) ?></h1>
        <p class="description"><?= htmlspecialchars($oeuvre['artiste']) ?></p>
        <p class="description-complete">
            <?= htmlspecialchars($oeuvre['description']) ?>
        </p>
    </div>
</article>


<?php require 'footer.php'; ?>
