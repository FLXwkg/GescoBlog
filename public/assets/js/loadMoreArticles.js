document.addEventListener("DOMContentLoaded", function () {
    const articleContainer = document.querySelector(".article-container");
    const loadMoreButton = document.getElementById("load-more");
    const articlesPerPage = 9;
    let visibleArticles = articlesPerPage;

    // Fonction pour charger 9 articles supplémentaires
    function loadMoreArticles() {
        const articles = articleContainer.querySelectorAll(".article-bloc");
        for (let i = visibleArticles; i < visibleArticles + articlesPerPage; i++) {
            if (articles[i]) {
                articles[i].style.display = "block";
            }
        }
        visibleArticles += articlesPerPage;

        // Masque le bouton s'il n'y a plus d'articles à charger
        if (visibleArticles >= articles.length) {
            loadMoreButton.style.display = "none";
        }
    }

    // Cacher initialement tous les articles sauf les 9 premiers
    const articles = articleContainer.querySelectorAll(".article-bloc");
    for (let i = articlesPerPage; i < articles.length; i++) {
        articles[i].style.display = "none";
    }

    // Écouteur d'événement pour le clic sur le bouton "Charger plus d'articles"
    loadMoreButton.addEventListener("click", loadMoreArticles);

    // Masque le bouton si le nombre total d'articles est inférieur ou égal à 9
    if (articles.length <= articlesPerPage) {
        loadMoreButton.style.display = "none";
    }
});
