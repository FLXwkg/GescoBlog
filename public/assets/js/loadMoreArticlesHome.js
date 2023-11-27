document.addEventListener("DOMContentLoaded", function () {
    const articleContainer = document.querySelector(".article-container");
    const loadMoreButton = document.getElementById("load-more");
    const reduceButton = document.getElementById("reduce");
    const articlesPerPage = 9;
    let visibleArticles = articlesPerPage;

    function loadMoreArticles() {
        const articles = articleContainer.querySelectorAll(".article-bloc");
        for (let i = visibleArticles; i < visibleArticles + articlesPerPage; i++) {
            if (articles[i]) {
                articles[i].style.display = "block";
            }
        }
        visibleArticles += articlesPerPage;

        if (visibleArticles >= articles.length) {
            loadMoreButton.style.display = "none";
        }
        if (visibleArticles > articlesPerPage) {
            reduceButton.style.display = "block"; // Afficher le bouton "Réduire" lorsque des articles sont visibles
        }
    }

    function reduceArticles() {
        visibleArticles -= articlesPerPage;
        loadMoreButton.style.display = "block";
        if (visibleArticles <= articlesPerPage) {
            visibleArticles = articlesPerPage;
            reduceButton.style.display = "none"; // Cacher le bouton "Réduire" lorsque le nombre d'articles visibles est revenu à la quantité initiale
        }
        const articles = articleContainer.querySelectorAll(".article-bloc");
        for (let i = visibleArticles; i < articles.length; i++) {
            articles[i].style.display = "none";
        }
    }

    const articles = articleContainer.querySelectorAll(".article-bloc");
    for (let i = articlesPerPage; i < articles.length; i++) {
        articles[i].style.display = "none";
    }

    loadMoreButton.addEventListener("click", loadMoreArticles);
    reduceButton.addEventListener("click", reduceArticles);

    if (articles.length <= articlesPerPage) {
        loadMoreButton.style.display = "none"; // Cacher le bouton "Afficher plus d'Articles" s'il y a des articles à afficher
    }
    if (articles.length <= articlesPerPage) {
        reduceButton.style.display = "none"; // Cacher le bouton "Réduire" s'il n'y a pas d'articles à réduire
    }
});
