<?php 
    require 'header.php'; 
?>

<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre *</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre *</label>
        <input type="text" name="artiste" id="artiste">
    </div>
    <div class="champ-formulaire">
        <label for="image">URL de l'image *</label>
        <input type="url" name="image" id="image">
    </div>
    <div class="champ-formulaire">
        <label for="description">Description *</label>
        <textarea name="description" id="description" placeholder="Saisir au moins trois caractères"></textarea>
    </div>

    <script>
    // Récupération du formulaire
    const form = document.querySelector('form');

    form.addEventListener('submit', function(e) {
        // On empêche l'envoi par défaut
        e.preventDefault();

        // On efface les messages d'erreur précédents
        document.querySelectorAll('.error-message').forEach(msg => msg.remove());

        // Récupération des champs
        const titre = document.getElementById('titre');
        const artiste = document.getElementById('artiste');
        const image = document.getElementById('image');
        const description = document.getElementById('description');

        let isValid = true; // pour savoir si tout est correct

        // Fonction pour afficher un message d'erreur
        function showError(field, message) {
            const error = document.createElement('div');
            error.className = 'error-message';
            error.style.color = 'red';
            error.style.fontSize = '0.9em';
            error.textContent = message;
            field.parentNode.appendChild(error);
            isValid = false;
        }

        // Validation des champs
        if (titre.value.trim() === '') {
            showError(titre, "Le titre est obligatoire");
        }

        if (artiste.value.trim() === '') {
            showError(artiste, "L'auteur est obligatoire");
        }

        if (image.value.trim() === '') {
            showError(image, "L'URL de l'image est obligatoire");
        } else {
            // vérification simple de format URL
            try {
                new URL(image.value);
            } catch (_) {
                showError(image, "L'URL n'est pas valide");
            }
        }

        if (description.value.trim() === '') {
            showError(description, "La description est obligatoire");
        } else if (description.value.trim().length < 3) {
            showError(description, "La description doit contenir au moins 3 caractères");
        }

        // Si tout est valide, on peut soumettre le formulaire
        if (isValid) {
            form.submit();
        }
    });
</script>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require 'footer.php'; ?>
