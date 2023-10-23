function toggleCommentaryButton(id) {
    const button = document.querySelector(`.toggle-button[data-article-id="${id}"]`);
    const target = button.getAttribute('data-bs-target');
    const collapseCommentary = document.querySelector(target);

    let isCollapsed = true;

    button.addEventListener('click', function () {
        if (isCollapsed) {
            button.textContent = 'Cacher les commentaires';
        } else {
            button.textContent = 'Afficher les commentaires';
        }

        isCollapsed = !isCollapsed; // Inverse l'état
    });
}

// Appeler la fonction pour chaque article lorsque le DOM est chargé
document.addEventListener('DOMContentLoaded', function () {
    const articleButtons = document.querySelectorAll('.toggle-button');
    articleButtons.forEach(button => {
        const articleId = button.getAttribute('data-article-id');
        toggleCommentaryButton(articleId);
    });
});
