document.addEventListener('DOMContentLoaded', function() {
    var toggleButtons = document.querySelectorAll('.toggle-button');

    function formaterDateISO8601(ISO8601Date) {
        // Créer une instance de Date à partir de la chaîne ISO8601
        const date = new Date(ISO8601Date);

        // Obtenez les composants de la date
        const jour = date.getDate().toString().padStart(2, '0');
        const mois = (date.getMonth() + 1).toString().padStart(2, '0'); // Mois commence à 0, donc ajoutez 1
        const annee = date.getFullYear();

        // Concaténez les composants pour former la chaîne de date formatée
        const dateFormatee = `${jour}/${mois}/${annee}`;

        return dateFormatee;
    }

    toggleButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var articleId = this.getAttribute('data-article-id');
            var commentaryContainer = document.getElementById('collapseCommentary' + articleId);

            var articleSlug = document.querySelector('.articleSlug' + articleId).textContent;
            var host = document.location.host;
            var pathname = document.location.pathname
            var protocol = document.location.protocol;
            var url = protocol + '//' + host + pathname + '/' + articleSlug +'/commentaires'
            var urlArticle = protocol + '//' + host + pathname + '/' + articleSlug
            
            if (!commentaryContainer.classList.contains('comments-loaded')) {
                
                fetch(url, {headers:{'nbComments': '3'}})
                    .then(response => response.json())
                    .then(data => {
                        commentaryContainer.innerHTML = ''; 

                        data.forEach(comment => {
                            
                            var commentDiv = document.createElement('div');
                            var date = comment.dateCommentaire;
                            var dateFormatee = formaterDateISO8601(date);
                            if(comment.texteCommentaire.length > 100){
                                var text = comment.texteCommentaire.slice(0, 100) + '...'
                            }else{
                                var text = comment.texteCommentaire
                            };

                            commentDiv.innerHTML = '<div class="row">' +
                                '<div class="article-commentary col mx-2 px-0">' +
                                '<div class="article-commentary-author row pt-2 pb-2">' +
                                '<img class="author-commentary-picture col-2 px-0" src="https://picsum.photos/id/' +
                                                            Math.floor(Math.random() * 300)+'/1000" alt="Profile picture">' +
                                '<a class="article-link col-8" href="'+ urlArticle +'">' +
                                '<h6 class="py-1">' + comment.auteurCommentaire + '</h6>' +
                                '</a>' +
                                '<small class="col-2 px-0">' +
                                dateFormatee +
                                '</small>' +
                                '</div>' +
                                '<p class="article-commentary-text row mx-2">' +
                                '<a class="article-link col-12" href="' + urlArticle + '">' +
                                text + 
                                '</a>' +
                                '</p>' +
                                '</div>' +
                                '</div>';
                            commentaryContainer.appendChild(commentDiv);
                        });

                        commentaryContainer.classList.add('comments-loaded');
                    })
                    .catch(error => {
                        console.error('Error fetching comments:', error);
                    });
            };
        });
    });
});

